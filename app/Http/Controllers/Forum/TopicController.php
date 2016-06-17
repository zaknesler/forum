<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Models\Post;
use Forum\Models\Topic;
use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Events\Forum\Topic\TopicWasHidden;
use Forum\Events\Forum\Topic\TopicWasViewed;
use Forum\Events\Forum\Topic\TopicWasCreated;
use Forum\Events\Forum\Topic\TopicWasDeleted;
use Forum\Events\Forum\Topic\TopicWasReported;
use Forum\Events\Forum\Topic\TopicWasUnhidden;
use Forum\Events\Forum\Topic\TopicReportsWereCleared;
use Forum\Http\Requests\Forum\Topic\CreateTopicFormRequest;
use Forum\Http\Requests\Forum\Topic\EditTopicFormRequest;

class TopicController extends Controller
{
    /**
     * Report topic.
     *
     * @param  integer                  $id
     * @param  Illuminate\Http\Request  $request
     * @param  Forum\Models\Topic       $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function report($id, Request $request, Topic $topic)
    {
        $topic = $topic->findOrFail($id);
        $user = $request->user();

        if ($user->id !== $topic->user->id) {
            event(new TopicWasReported($topic, $user));
        }

        notify()->flash('Success', 'success', [
            'text' => 'Thank you for reporting.',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }

    /**
     * Clear reports on topic.
     *
     * @param  integer                  $id
     * @param  Illuminate\Http\Request  $request
     * @param  Forum\Models\Topic       $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearReports($id, Request $request, Topic $topic)
    {
        $topic = $topic->findOrFail($id);

        event(new TopicReportsWereCleared($topic, $request->user()));

        notify()->flash('Success', 'success', [
            'text' => 'Reports have been cleared.',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }

    /**
     * Get the view to create a new topic.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  Forum\Models\Topic       $topic
     * @param  Forum\Models\Section     $section
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Topic $topic, Section $section)
    {
        $sections = $section->get();

        if (!$sections->count()) {
            notify()->flash('Oops..', 'error', [
                'text' => 'No sections available.',
                'timer' => 2000,
            ]);

            return redirect()->route('home');
        }

        return view('forum.topic.create')
            ->with('sections', $sections)
            ->with('id', $request->id);
    }

    /**
     * Get the view that displays all of the topics.
     *
     * @param  Forum\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function all(Topic $topic)
    {
        $topics = $topic->latestFirst()->paginate(10);

        return view('moderation.topic.all')
            ->with('topics', $topics);
    }

    /**
     * Get the view that displays a single topic with its replies.
     *
     * @param  string              $slug
     * @param  integer             $id
     * @param  Forum\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id, Topic $topic)
    {
        $topic = $topic->findOrFail($id);

        if ($topic->hide && !auth()->user()->hasRole(['moderator', 'admin', 'owner'])) {
            return abort(404);
        }

        event(new TopicWasViewed($topic));

        $posts = $topic->posts()->latestLast()->get();

        return view('forum.topic.show')
            ->with('topic', $topic)
            ->with('posts', $posts);
    }

    /**
     * Store the new topic in database.
     *
     * @param  CreateTopicFormRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTopicFormRequest $request)
    {
        $user = $request->user();

        $topic = $user->topics()->create([
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'body' => $request->input('body'),
            'section_id' => $request->input('id'),
        ]);

        event(new TopicWasCreated($topic, $topic->section, $user));

        notify()->flash('Success', 'success', [
            'text' => 'Your topic has been added.',
            'timer' => 2000,
        ]);

        return redirect()->route('forum.topic.show', [
            'slug' => $topic->slug,
            'id' => $topic->id,
        ]);
    }

    /**
     * Mark topic as hidden.
     * @param  integer                  $id
     * @param  Illuminate\Http\Request  $request
     * @param  Forum\Models\Topic       $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hide($id, Request $request, Topic $topic)
    {
        $topic = $topic->findOrFail($id);

        $topic->hide = true;

        $topic->update();

        event(new TopicWasHidden($topic, $topic->section, $request->user()));

        notify()->flash('Success', 'success', [
            'text' => 'Topic has been hidden.',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }

    /**
     * Mark topic as unhidden.
     * @param  integer                  $id
     * @param  Illuminate\Http\Request  $request
     * @param  Forum\Models\Topic       $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unhide($id, Request $request, Topic $topic)
    {
        $topic = $topic->findOrFail($id);

        $topic->hide = false;

        $topic->update();

        event(new TopicWasUnhidden($topic, $topic->section, $request->user()));

        notify()->flash('Success', 'success', [
            'text' => 'Topic has been hidden.',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }

    /**
     * Mark topic as deleted.
     * @param  integer                  $id
     * @param  Illuminate\Http\Request  $request
     * @param  Forum\Models\Topic       $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Request $request, Topic $topic)
    {
        $topic = $topic->findOrFail($id);

        event(new TopicWasDeleted($topic, $request->user()));

        $topic->delete();

        notify()->flash('Success', 'success', [
            'text' => 'Topic has been deleted.',
            'timer' => 2000,
        ]);

        return redirect()->route('home');
    }
}
