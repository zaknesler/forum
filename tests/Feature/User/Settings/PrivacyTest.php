<?php

namespace Tests\Feature\User\Settings;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserPrivacy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrivacyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_enable_email_visibility()
    {
        $user = $this->authenticate(null);

        $response = $this->json('PATCH', '/settings/privacy', [
            'show_email' => 'checked',
        ]);

        $response->assertRedirect('/settings');
        $this->assertEquals(1, UserPrivacy::count());
        $this->assertTrue($user->fresh()->privacy->show_email);
    }

    /** @test */
    function can_disable_email_visibility()
    {
        $user = $this->authenticate(null);

        $response = $this->json('PATCH', '/settings/privacy', [
            'show_email' => null,
        ]);

        $response->assertRedirect('/settings');
        $this->assertEquals(1, UserPrivacy::count());
        $this->assertFalse($user->fresh()->privacy->show_email);
    }

    /** @test */
    function privacy_rows_do_not_duplicate()
    {
        $user = $this->authenticate(null);

        $response = $this->json('PATCH', '/settings/privacy', [
            'show_email' => null,
        ]);

        $response->assertRedirect('/settings');
        $this->assertEquals(1, UserPrivacy::count());

        $response = $this->json('PATCH', '/settings/privacy', [
            'show_email' => 'checked',
        ]);

        $response->assertRedirect('/settings');
        $this->assertEquals(1, UserPrivacy::count());
    }
}
