<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_topic_can_be_replied_to()
    {
        $this->actingAs(factory(User::class)->create());
        $topic = factory(Topic::class)->create();

        $response = $this->json('POST', '/topics/' . $topic->id . '/posts', [
            'body' => 'This is the body of the post.',
        ]);

        $response->assertStatus(302);
        $this->assertEquals(1, Post::count());
        $this->assertSame('This is the body of the post.', Post::first()->body);
    }
}
