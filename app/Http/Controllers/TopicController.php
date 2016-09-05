<?php

namespace Forum\Http\Controllers;

use Forum\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Requests\Topic\CreateTopicFormRequest;

class TopicController extends Controller
{
    /**
     * Display all topics.
     *
     * @param  Forum\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function index(Topic $topic)
    {
        $topics = $topic->with('user')->latestFirst()->paginate(25);

        return view('topics.index')
            ->with('topics', $topics);
    }

    /**
     * Show the form for creating a new topic.
     *
     * @param  Forum\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function create(Topic $topic)
    {
        $this->authorize('create', $topic);

        return view('topics.create');
    }

    /**
     * Store a newly created topic in the database.
     *
     * @param  Forum\Http\Requests\Topic\CreateTopicFormRequest  $request
     * @param  Forum\Topic  $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTopicFormRequest $request, Topic $topic)
    {
        $this->authorize('create', $topic);

        $user = $request->user();

        $topic = $user->topics()->create([
            'title' => $request->input('title'),
            'slug' => str_slug($request->input('title')),
            'body' => $request->input('body'),
        ]);

        return redirect()->route('topics.show', $topic->id);
    }

    /**
     * Display the topic.
     *
     * @param  Forum\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        $this->authorize('view', $topic);

        return view('topics.show')
            ->with('topic', $topic);
    }

    /**
     * Show the form for editing the topic.
     *
     * @param  Forum\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $this->authorize('edit', $topic);
    }

    /**
     * Update the topic in the database.
     *
     * @param  Forum\Topic  $topic
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Topic $topic, Request $request)
    {
        $this->authorize('edit', $topic);
    }

    /**
     * Remove the topic from the database.
     *
     * @param  Forum\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);
    }
}
