<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Models\Post;
use Forum\Models\Topic;
use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Models\TopicReport;
use Forum\Http\Controllers\Controller;
use GrahamCampbell\Markdown\Facades\Markdown;
use Forum\Http\Requests\Forum\Topic\CreateTopicFormRequest;
use Forum\Http\Requests\Forum\Topic\EditTopicFormRequest;

class TopicController extends Controller
{
    /**
     * Report topic.
     * @param  integer  $id     Topic identifier.
     * @param  Topic    $topic  Topic model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function report($id, Topic $topic)
    {
        $topic = $topic->findOrFail($id);

        $topic->increment('reports');

        $topic->reindex();

        notify()->flash('Success', 'success', [
            'text' => 'Thank you for reporting.',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }

    /**
     * Clear reports on topic.
     * @param  integer  $id     Topic identifier.
     * @param  Topic    $topic  Topic model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearReports($id, Topic $topic)
    {
        $topic = $topic->findOrFail($id);

        $topic->update([
            'reports' => 0,
        ]);

        $topic->reindex();

        notify()->flash('Success', 'success', [
            'text' => 'Reports have been cleared.',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }

    /**
     * Get the view to create a new topic.
     * @param  Topic    $topic    Topic model injection.
     * @param  Section  $section  Section model injection.
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

        return view('forum.topic.create', [
            'sections' => $sections,
            'id' => $request['section_id'],
        ]);
    }
    
    /**
     * Get the view that displays all of the topics.
     * @param  Topic  $topic  Topic model injection.
     * @return \Illuminate\Http\Response
     */
    public function all(Topic $topic)
    {
        $topics = $topic->latestFirst()->paginate(10);

        return view('moderation.topic.all', [
            'topics' => $topics,    
        ]);
    }

    /**
     * Get the view that displays a single topic with its replies.
     * @param  string   $slug   Topic slug.
     * @param  integer  $id     Topic identifier.
     * @param  Topic    $topic  Topic model injection.
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id, Topic $topic)
    {
        $show = $topic->findOrFail($id);

        $show->increment('views_count');

        $posts = $show->posts()->latestLast()->get();

        return view('forum.topic.show', [
            'topic' => $show,
            'posts' => $posts,
        ]);
    }

    /**
     * Store the new topic in database.
     * @param  CreateTopicFormRequest  $request  Form request for validation.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTopicFormRequest $request)
    {
        $topic = $request->user()->topics()->create([
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'body' => $request->input('body'),
            'section_id' => $request->input('section_id'),
        ]);

        $section = $topic->section();

        $section->increment('topics_count');

        $section->reindex();

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
     * Mark topic as deleted.
     * @param  integer  $id     Topic identifier.
     * @param  Topic    $topic  Topic model injection.
     * @param  Post     $post   Post model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Topic $topic, Post $post)
    {
        $destroy = $topic->findOrFail($id);

        $section = $destroy->section();

        $section->decrement('topics_count');

        /**
         * When the database is migrated, the tables
         * are inter-connected with an option to
         * 'cascade' when deleted. This means that if
         * we delete the parent row value, Eloquent will
         * go through and delete all of its children automatically.
         */
        $destroy->delete();

        $section->reindex();
        $topic->reindex();
        $post->reindex();

        notify()->flash('Success', 'success', [
            'text' => 'Topic has been deleted.',
            'timer' => 2000,
        ]);

        return redirect()->route('home');
    }
}
