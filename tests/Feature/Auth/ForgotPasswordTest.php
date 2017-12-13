<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Auth\Traits\MakesRequestsFromPage;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase, MakesRequestsFromPage;

    protected function passwordRequestRoute()
    {
        return route('password.request');
    }

    protected function passwordEmailGetRoute()
    {
        return route('password.email');
    }

    protected function passwordEmailPostRoute()
    {
        return route('password.email');
    }

    protected function guestMiddlewareRoute()
    {
        return route('home');
    }

    /** @test */
    public function user_can_view_an_email_password_form()
    {
        $response = $this->get($this->passwordRequestRoute());

        $response->assertSuccessful();
        $response->assertViewIs('auth.passwords.email');
    }

    /** @test */
    public function user_cannot_view_an_email_password_form_when_authenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get($this->passwordRequestRoute());

        $response->assertRedirect($this->guestMiddlewareRoute());
    }

    /** @test */
    public function user_receives_an_email_with_apassword_reset_link()
    {
        Notification::fake();
        $user = factory(User::class)->create([
            'email' => 'john@example.com',
        ]);

        $response = $this->post($this->passwordEmailPostRoute(), [
            'email' => 'john@example.com',
        ]);

        $this->assertNotNull($token = DB::table('password_resets')->first());
        Notification::assertSentTo($user, ResetPassword::class, function ($notification, $channels) use ($token) {
            return Hash::check($notification->token, $token->token) === true;
        });
    }

    /** @test */
    public function user_does_not_receive_email_when_not_registered()
    {
        Notification::fake();

        $response = $this->fromPage($this->passwordEmailGetRoute())->post($this->passwordEmailPostRoute(), [
            'email' => 'nobody@example.com',
        ]);

        $response->assertRedirect($this->passwordEmailGetRoute());
        $response->assertSessionHasErrors('email');
        Notification::assertNotSentTo(factory(User::class)->make(['email' => 'nobody@example.com']), ResetPassword::class);
    }

    /** @test */
    public function email_is_required()
    {
        $response = $this->fromPage($this->passwordEmailGetRoute())->post($this->passwordEmailPostRoute(), []);

        $response->assertRedirect($this->passwordEmailGetRoute());
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_is_avalid_email()
    {
        $response = $this->fromPage($this->passwordEmailGetRoute())->post($this->passwordEmailPostRoute(), [
            'email' => 'invalid-email',
        ]);

        $response->assertRedirect($this->passwordEmailGetRoute());
        $response->assertSessionHasErrors('email');
    }
}
