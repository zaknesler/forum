<?php

namespace Forum\Http\Controllers;

use Forum\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Requests\Topic\CreateTopicFormRequest;
use Forum\Http\Requests\Topic\UpdateTopicFormRequest;

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

        $user->topics()->create([
            'title' => $request->input('title'),
            'slug' => str_slug($request->input('title')),
            'body' => $request->input('body'),
        ]);

        flash('Topic has been created.');

        return redirect()->route('topics.show', [$topic->slug, $topic->id]);
    }

    /**
     * Display the topic.
     *
     * @param  string  $slug
     * @param  Forum\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Topic $topic)
    {
        if ($topic->slug !== $slug) {
            abort(404);
        }

        $posts = $topic->posts()->with('user')->get();

        return view('topics.show')
            ->with('topic', $topic)
            ->with('posts', $posts);
    }

    /**
     * Show the form for editing the topic.
     *
     * @param  Forum\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);

        return view('topics.edit')
            ->with('topic', $topic);
    }

    /**
     * Update the topic in the database.
     *
     * @param  Forum\Topic  $topic
     * @param  Forum\Http\Requests\Topic\UpdateTopicFormRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Topic $topic, UpdateTopicFormRequest $request)
    {
        $this->authorize('update', $topic);

        $topic->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        flash('Topic has been updated.');

        return redirect()->route('topics.show', [$topic->slug, $topic->id]);
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

        $topic->delete();

        flash('Topic has been deleted.');

        return redirect()->route('topics.index');
    }
}
