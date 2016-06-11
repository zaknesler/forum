<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Models\Topic;
use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Models\TopicReport;
use Forum\Http\Controllers\Controller;
use GrahamCampbell\Markdown\Facades\Markdown;
use Forum\Http\Requests\Forum\Topic\CreateTopicFormRequest;
use Forum\Http\Requests\Forum\Topic\EditTopicFormRequest;

class EditTopicController extends Controller
{
    /**
     * Get the view to edit an existing topic.
     * @param  integer  $id       Topic identifier.
     * @param  Topic    $topic    Topic model identifier.
     * @param  Section  $section  Section model identifier.
     * @return \Illuminate\Http\Response
     */
    public function index($id, Topic $topic, Section $section)
    {
        $edit = $topic->findOrFail($id);
        $user = auth()->user();

        if (($user->id == $edit->user->id) || ($user->hasRole(['admin', 'owner']))) {
            $sections = $section->get();

            return view('forum.topic.edit', [
                'topic' => $edit,
                'sections' => $sections,
            ]);
        } else {
            return redirect()->route('home');
        }        
    }

    /**
     * Post section edit.
     * @param  integer  $id     Topic identifier.
     * @param  Topic    $topic  Topic model identifier.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, EditTopicFormRequest $request, Topic $topic)
    {
        $current = $topic->findOrFail($id);

        $current->update([
            'section_id' => $request->input('section_id'),
            'title' => $request->input('title'),
            'slug' => str_slug($request->input('title')),
            'body' => Markdown::convertToHtml($request->input('body')),
            'raw_body' => $request->input('body'),
        ]);

        notify()->flash('Success', 'success', [
            'text' => 'Topic has been updated.',
            'timer' => 2000,
        ]);

        $topic->reindex();

        return redirect()->route('forum.topic.show', [
            'slug' => $current->slug,
            'id' => $current->id
        ]);
    }    
}
