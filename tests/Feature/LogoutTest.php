<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LogoutTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_logout()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->assertEquals(true, auth()->check());

        $response = $this->json('POST', '/logout');

        $response->assertJsonStructure(['redirect_url']);
        $this->assertEquals(false, auth()->check());
    }
}
