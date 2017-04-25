<?php

namespace Tests\Feature\User\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LogoutTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_logout()
    {
        $this->authenticate();

        $this->assertEquals(true, auth()->check());

        $response = $this->json('POST', '/logout');

        $response->assertJsonStructure(['redirect_url']);
        $this->assertEquals(false, auth()->check());
    }
}
