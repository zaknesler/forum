<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\Topic\StoreTopic;
use App\Http\Requests\Topic\UpdateTopic;

class TopicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only([
            'create',
            'store',
            'edit',
            'update',
            'destroy',
        ]);
    }

    /**
     * Display a listing of all of the topics.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::latest('updated_at')->with('user', 'posts')->paginate(15);

        return view('topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created topic.
     *
     * @param  App\Http\Requests\Topic\StoreTopic  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopic $request)
    {
        $topic = $request->user()->topics()->create($request->only([
            'title',
            'body',
        ]));

        flash('Topic has been created.');

        return redirect()->route('topics.show', $topic->slug);
    }

    /**
     * Display the topic with its replies.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $topic = Topic::where('slug', $slug)->with(['user', 'posts.user'])->firstOrFail();

        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified topic.
     *
     * @param  App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);

        return view('topics.edit', compact('topic'));
    }

    /**
     * Update the specified topic.
     *
     * @param  App\Http\Requests\Topic\UpdateTopic  $request
     * @param  App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopic $request, Topic $topic)
    {
        $topic->update($request->only([
            'title',
            'body',
        ]));

        flash('Topic has been updated.');

        return redirect()->route('topics.show', $topic->slug);
    }

    /**
     * Remove the specified topic.
     *
     * @param  App\Models\Topic  $topic
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);

        $topic->delete();

        flash('Topic has been removed.');

        return response()->json([
            'redirect_url' => route('home'),
        ]);
    }
}
