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

        $response = $this->post('/topics', [
            'title' => 'Such a cool topic!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response->assertStatus(200);
    }
}
