<?php

use Forum\Models\Post;
use Forum\Models\Topic;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewPostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_view_a_topic_with_a_reply()
    {
        $topic = factory(Topic::class)->create();
        $post = factory(Post::class)->create([
            'topic_id' => $topic->id,
            'body' => 'This is the body of the test post.',
        ]);

        $this->visit('topics/' . $topic->slug . '/' . $topic->id);

        $this->see($post->created_at->diffForHumans());
        $this->see('This is the body of the test post.');
        $this->seeText('You must be signed in to post a reply.');
    }
}
