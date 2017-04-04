<?php

namespace Tests\Feature\User\Settings;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AvatarTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_upload_avatar()
    {
        Storage::fake('avatars');
        Storage::fake('avatars-temp');

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->json('PATCH', '/settings/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar.jpg', 200, 200),
        ]);

        $response->assertStatus(302);
        $this->assertNotNull($user->fresh()->avatar);
        $this->assertEquals(1, count(Storage::disk('avatars')->files()));
    }

    /** @test */
    function when_new_avatar_is_uploaded_the_previous_one_gets_deleted()
    {
        Storage::fake('avatars');
        Storage::fake('avatars-temp');

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->json('PATCH', '/settings/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar.jpg', 200, 200),
        ]);

        $response->assertStatus(302);
        $this->assertNotNull($user->fresh()->avatar);
        $this->assertEquals(1, count(Storage::disk('avatars')->files()));

        $response = $this->json('PATCH', '/settings/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar2.jpg', 200, 200),
        ]);

        $response->assertStatus(302);
        $this->assertNotNull($user->fresh()->avatar);
        $this->assertEquals(1, count(Storage::disk('avatars')->files()));
    }
}
