<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Models\Topic;
use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use GrahamCampbell\Markdown\Facades\Markdown;
use Forum\Http\Requests\Forum\GetTopicsFormRequest;
use Forum\Http\Requests\Forum\CreateTopicFormRequest;

class TopicController extends Controller
{
    public function index(Topic $topic, Section $section)
    {
        $sections = $section->get();

        return view('forum.topic.new')->withSections($sections);
    }
    
    public function all(Topic $topic)
    {
        $topics = $topic->get();

        return view('forum.topic.all')->withTopics($topics);
    }

    public function show($id, Topic $topic)
    {
        $show = $topic->find($id);

        if (!$show) {
            notify()->flash('That topic was not found.', 'error', [
                'timer' => 2000,
            ]);

            return redirect()->route('forum.topic.all');
        }

        return view('forum.topic.show')->withTopic($show);
    }

    public function store(CreateTopicFormRequest $request)
    {
        $topic = $request->user()->topics()->create([
            'title' => $request->input('title'),
            'slug' => str_slug($request->input('title')),
            'body' => Markdown::convertToHtml($request->input('body')),
            'section_id' => $request->input('section_id'),
        ]);

        return redirect()->route('forum.topic.show', [
            'id' => $topic->id,
        ]);
    }
}
