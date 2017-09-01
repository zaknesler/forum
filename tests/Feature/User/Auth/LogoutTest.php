<?php

namespace Tests\Feature\User\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_logout()
    {
        $this->authenticate();

        $this->assertEquals(true, auth()->check());

        $response = $this->json('POST', '/logout');

        $response->assertJsonStructure(['redirect_url']);
        $this->assertEquals(false, auth()->check());
    }

    /** @test */
    function cannot_logout_via_get_request()
    {
        $this->authenticate();

        $this->assertEquals(true, auth()->check());

        $response = $this->json('GET', '/logout');

        $response->assertStatus(404);
        $this->assertEquals(true, auth()->check());
    }
}
