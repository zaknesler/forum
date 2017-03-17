<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Transformers\TopicTransformer;
use App\Http\Requests\Topic\StoreTopic;
use App\Http\Requests\Topic\UpdateTopic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::latest()->paginate(15);

        return fractal($topics, new TopicTransformer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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

        return fractal($topic, new TopicTransformer)->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $topic = Topic::where('slug', $slug)->first();

        return fractal($topic, new TopicTransformer)->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Topic\UpdateTopic  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopic $request, Topic $topic)
    {
        $topic->update($request->only([
            'title',
            'body',
        ]));

        return fractal($topic, new TopicTransformer)->toArray();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
    }
}
