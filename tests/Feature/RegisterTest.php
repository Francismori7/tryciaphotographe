<?php

namespace Tests\Feature;

use App\Mail\AccountActivationEmail;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mail;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_activation_code_is_sent_by_email()
    {
        Mail::fake();

        $this->post('/register', $this->validParams());

        Mail::assertSent(AccountActivationEmail::class);
    }

    /**
     * An array of valid parameters.
     *
     * @param array $attributes
     *
     * @return array
     */
    protected function validParams(array $attributes = [])
    {
        return array_merge([
            'name' => 'User 1',
            'email' => 'user1@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ], $attributes);
    }

    /** @test */
    public function it_generates_an_activation_code_when_registering()
    {
        Mail::fake();

        $this->post('/register', $this->validParams());

        $user = User::first();

        $this->assertNotNull($user->activation_code,
            'An activation code was not automatically generated for the user.');
    }

    /** @test */
    public function it_locks_the_account_until_it_is_activated()
    {
        $this->signInUnactivated();

        $response = $this->withExceptionHandling()->get(route('dashboard.index'));

        $response->assertRedirect(url('/login'))
            ->assertSessionHas('flash_notification');

        $this->signIn();

        $response = $this->get(route('dashboard.index'));

        $response->assertSuccessful();
    }


}
