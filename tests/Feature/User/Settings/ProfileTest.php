<?php

namespace Tests\Feature\User\Settings;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_update_profile()
    {
        $user = $this->authenticate(null, [
            'name' => 'Test User',
            'email' => 'text@example.com',
        ]);

        $response = $this->json('PATCH', '/settings/profile', [
            'name' => 'Updated Name',
            'email' => 'updated-email@example.com',
        ]);

        $response->assertRedirect('/settings');
        $this->assertEquals('Updated Name', $user->fresh()->name);
        $this->assertEquals('updated-email@example.com', $user->fresh()->email);
    }
}
