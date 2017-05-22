<?php

namespace Tests\Feature;

use App\Mail\AccountActivatedEmail;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mail;
use Tests\TestCase;

class ActivationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_activates_a_user_with_the_right_activation_code()
    {
        Mail::fake();
        
        $user = create(User::class, ['activation_code' => 'code']);

        $response = $this->get(route('activate', ['code']));

        tap($user->fresh(), function ($user) {
            $this->assertTrue($user->isActive());
            $this->assertNotNull($user->activated_at);
        });

        $response->assertRedirect(url('/login'))->assertSessionHas('flash_notification');
    }

    /** @test */
    public function an_error_occurs_when_the_wrong_code_is_used()
    {
        $user = create(User::class, ['activation_code' => 'right-code']);

        $response = $this->withExceptionHandling()->get(route('activate', ['wrong-code']));

        tap($user->fresh(), function ($user) {
            $this->assertFalse($user->isActive());
            $this->assertNull($user->activated_at);
        });

        $response->assertStatus(404);
    }

    /** @test */
    public function activated_email_is_being_sent_after_activation()
    {
        Mail::fake();

        create(User::class, ['activation_code' => 'code']);

        $this->get(route('activate', ['code']));

        Mail::assertSent(AccountActivatedEmail::class);
    }


}
