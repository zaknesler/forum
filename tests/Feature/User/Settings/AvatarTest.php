<?php

namespace Tests\Feature\User\Settings;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AvatarTest extends TestCase
{
    use RefreshDatabase;

    public function prepareAvatar()
    {
        Storage::fake('avatars');
        Storage::fake('avatars-temp');

        return $this->authenticate();
    }

    /** @test */
    function can_upload_avatar()
    {
        $user = $this->prepareAvatar();

        $response = $this->json('PATCH', '/settings/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar.jpg', 200, 200),
        ]);

        $response->assertRedirect('/settings');
        $this->assertNotNull($user->fresh()->avatar);
        $this->assertEquals(1, count(Storage::disk('avatars')->files()));
    }

    /** @test */
    function can_delete_avatar()
    {
        $user = $this->prepareAvatar();

        $response = $this->json('PATCH', '/settings/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar.jpg', 200, 200),
        ]);

        $response->assertRedirect('/settings');
        $this->assertNotNull($user->fresh()->avatar);
        $this->assertEquals(1, count(Storage::disk('avatars')->files()));

        $response = $this->json('DELETE', '/settings/avatar');

        $response->assertStatus(200);
        $response->assertJsonStructure(['redirect_url']);
        $this->assertEquals(0, count(Storage::disk('avatars')->files()));
        $this->assertNull($user->fresh()->avatar);
    }

    /** @test */
    function when_new_avatar_is_uploaded_the_previous_one_gets_deleted()
    {
        $user = $this->prepareAvatar();

        $response = $this->json('PATCH', '/settings/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar.jpg', 200, 200),
        ]);

        $response->assertRedirect('/settings');
        $this->assertNotNull($user->fresh()->avatar);
        $this->assertEquals(1, count(Storage::disk('avatars')->files()));

        $response = $this->json('PATCH', '/settings/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar2.jpg', 200, 200),
        ]);

        $response->assertRedirect('/settings');
        $this->assertNotNull($user->fresh()->avatar);
        $this->assertEquals(1, count(Storage::disk('avatars')->files()));
    }
}
