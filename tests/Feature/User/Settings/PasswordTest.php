<?php

namespace Tests\Feature\User\Settings;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PasswordTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_update_password()
    {
        $user = $this->authenticate(null, [
            'password' => Hash::make('secret'),
        ]);

        $response = $this->json('PATCH', '/settings/password', [
            'old_password' => 'secret',
            'password' => 'updated-password',
            'password_confirmation' => 'updated-password',
        ]);

        $response->assertRedirect('/settings');
        $this->assertTrue(Hash::check('updated-password', $user->fresh()->password));
    }
}
