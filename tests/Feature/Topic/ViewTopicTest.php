<?php

use Forum\Models\Post;
use Forum\Models\Topic;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewTopicTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_view_a_topic()
    {
        $topic = factory(Topic::class)->create([
            'title' => 'A Simple Example Topic',
            'slug' => str_slug('A Simple Example Topic'),
            'body' => 'This is the body of the test topic.',
        ]);

        $this->visit('topics/' . $topic->slug . '/' . $topic->id);

        $this->see('A Simple Example Topic');
        $this->see($topic->created_at->diffForHumans());
        $this->see('This is the body of the test topic.');

        $this->seeText('You must be signed in to post a reply.');
    }
}
