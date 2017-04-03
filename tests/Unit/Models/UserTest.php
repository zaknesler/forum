<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /** @test */
    function if_name_is_not_set_return_username()
    {
        $user = factory(User::class)->make(['name' => null]);

        $this->assertEquals($user->username, $user->getNameOrUsername());
    }

    /** @test */
    function if_name_is_set_return_it()
    {
        $user = factory(User::class)->make();

        $this->assertEquals($user->name, $user->getNameOrUsername());
    }

    /** @test */
    function can_get_gravatar_url()
    {
        $user = factory(User::class)->make(['email' => 'user@example.com']);

        $this->assertEquals(
            'https://www.gravatar.com/avatar/b58996c504c5638798eb6b511e6f49af?s=150&d=mm',
            $user->getAvatar()
        );
    }

    /** @test */
    function size_argument_changes_avatar_url()
    {
        $user = factory(User::class)->make(['email' => 'user@example.com']);

        $this->assertEquals(
            'https://www.gravatar.com/avatar/b58996c504c5638798eb6b511e6f49af?s=300&d=mm',
            $user->getAvatar(300)
        );
    }
}
