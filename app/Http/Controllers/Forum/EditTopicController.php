<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Models\Topic;
use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Events\Forum\Topic\TopicWasEdited;
use Forum\Http\Requests\Forum\Topic\EditTopicFormRequest;

class EditTopicController extends Controller
{
    /**
     * Get the view to edit an existing topic.
     *
     * @param  integer               $id
     * @param  Forum\Models\Topic    $topic
     * @param  Forum\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function index($id, Topic $topic, Section $section)
    {
        $topic = $topic->findOrFail($id);
        $user = auth()->user();

        if (($user->id == $topic->user->id) || ($user->hasRole(['moderator', 'admin', 'owner']))) {
            $sections = $section->get();

            return view('forum.topic.edit')
                ->with('topic', $topic)
                ->with('sections', $sections);
        } else {
            return redirect()->route('home');
        }
    }

    // brb (:
    //
    // you can leave if you want i am doing boring stuff.

    /**
     * Post section edit.
     *
     * @param  integer             $id
     * @param  Forum\Models\Topic  $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, EditTopicFormRequest $request, Topic $topic)
    {
        $topic = $topic->findOrFail($id);

        $topic->update([
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'body' => $request->input('body'),
        ]);

        notify()->flash('Success', 'success', [
            'text' => 'Topic has been updated.',
            'timer' => 2000,
        ]);

        event(new TopicWasEdited($topic, $request->user()));

        return redirect()->route('forum.topic.show', [
            'slug' => $topic->slug,
            'id' => $topic->id
        ]);
    }
}
