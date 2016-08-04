<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Events\Forum\Topic\TopicWasEdited;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Forum\Topic\EditTopicFormRequest;
use Forum\Models\Section;
use Forum\Models\Topic;
use Illuminate\Http\Request;

class EditTopicController extends Controller
{
    /**
     * Get the view to edit an existing topic.
     *
     * @param int                     $id
     * @param Illuminate\Http\Request $request
     * @param Forum\Models\Topic      $topic
     * @param Forum\Models\Section    $section
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request, Topic $topic, Section $section)
    {
        $topic = $topic->findOrFail($id);
        $user = $request->user();
        $userIsStaff = $user->hasRole(['moderator', 'admin', 'owner']);

        if (((!$topic->is_hidden && !$topic->is_locked) || $userIsStaff) && (($user->id == $topic->user->id) || ($userIsStaff))) {
            $sections = $section->get();

            return view('forum.topic.edit')
                    ->with('topic', $topic)
                    ->with('sections', $sections);
        }

        return redirect()->route('home');
    }

    /**
     * Post section edit.
     *
     * @param int                  $id
     * @param EditTopicFormRequest $request
     * @param Forum\Models\Topic   $topic
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, EditTopicFormRequest $request, Topic $topic)
    {
        $topic = $topic->findOrFail($id);
        $user = $request->user();
        $userIsStaff = $user->hasRole(['moderator', 'admin', 'owner']);

        if (((!$topic->is_hidden && !$topic->is_locked) || $userIsStaff) && (($user->id == $topic->user->id) || ($userIsStaff))) {
            $topic->update([
                'name' => $request->input('name'),
                'slug' => str_slug($request->input('name')),
                'body' => $request->input('body'),
            ]);

            event(new TopicWasEdited($topic, $request->user()));

            notify()->flash('Success', 'success', [
                'text'  => 'Topic has been updated.',
                'timer' => 2000,
            ]);
        }

        return redirect()->route('forum.topic.show', [
            'slug' => $topic->slug,
            'id'   => $topic->id,
        ]);
    }
}
