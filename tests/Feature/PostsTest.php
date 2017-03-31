<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_create_post()
    {
        $this->actingAs(factory(User::class)->create());
        $topic = factory(Topic::class)->create();

        $response = $this->json('POST', '/topics/1/posts', [
            'body' => 'This is the body of the post.',
        ]);

        $response->assertStatus(302);
        $this->assertEquals(1, Post::count());
        $this->assertSame('This is the body of the post.', Post::first()->body);
    }

    /** @test */
    function can_update_post()
    {
        $this->actingAs(factory(User::class)->create());
        $post = factory(Post::class)->create([
            'body' => 'This is the original body of the post.',
        ]);

        $this->assertEquals(1, Post::count());

        $response = $this->json('PATCH', '/topics/1/posts/1', [
            'body' => 'This is the updated body of the post.',
        ]);

        $response->assertStatus(302);
        $this->assertSame('This is the updated body of the post.', Post::first()->body);
    }

    /** @test */
    function can_delete_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['user_id' => $user->id]);

        $this->actingAs($user);
        $response = $this->json('DELETE', '/topics/1/posts/1');

        $response->assertStatus(200);
        $this->assertEquals(0, Post::count());
    }
}
