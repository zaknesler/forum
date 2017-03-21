<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateTopicsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    function can_create_topic()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/api/topics', [
            'title' => 'Such a cool topic!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'slug',
                    'body',
                    'uri',
                    'created_at',
                    'created_at_human',
                    'user',
                ],
            ]);
    }

    /** @test */
    function can_update_topic()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/api/topics', [
            'title' => 'Such a cool topic!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'body' => 'This topic is not about anything important.',
            ]);

        $response = $this->json('PATCH', '/api/topics/1', [
            'title' => 'Such a cool topic!!',
            'body' => 'This is the updated body.'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'body' => 'This is the updated body.'
            ]);
    }

    /** @test */
    function can_delete_topic()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/api/topics', [
            'title' => 'Such a cool topic!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response->assertStatus(200);

        $response = $this->json('DELETE', '/api/topics/1');

        $response->assertStatus(200);
    }

    /** @test */
    function when_a_topic_title_is_updated_the_slug_stays_the_same()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/api/topics', [
            'title' => 'Such a cool topic!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'body' => 'This topic is not about anything important.',
            ]);

        $response = $this->json('PATCH', '/api/topics/1', [
            'title' => 'a different title woah!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'a different title woah!!',
                'slug' => 'such-a-cool-topic',
            ]);
    }

    /** @test */
    function user_can_view_topic()
    {
        $this->actingAs(factory(User::class)->create([
            'name' => 'Test User',
        ]));

        $response = $this->json('POST', '/api/topics', [
            'title' => 'Such a cool topic!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response->assertStatus(200);

        $response = $this->get('/topics/such-a-cool-topic');

        $response->assertStatus(200);
        $response->assertSee('Such a cool topic!!');
        $response->assertSee('Test User');
        $response->assertSee('This topic is not about anything important.');
    }
}
