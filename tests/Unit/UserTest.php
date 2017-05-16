<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_be_active_or_inactive()
    {
        /** @var User $user */
        $user = create(User::class);

        $this->assertFalse($user->isActive());
        $this->assertNull($user->activated_at);

        $user->activate();

        $this->assertTrue($user->isActive());
        $this->assertNotNull($user->activated_at);
    }

    /** @test */
    public function it_generates_an_activation_code_when_registering()
    {
        $code = User::newActivationCode();

        $this->assertNotNull($code);
        $this->assertEquals(32, strlen($code));
    }

    /** @test */
    public function it_activates_a_user()
    {
        /** @var User $user */
        $user = create(User::class);

        $user->activate();

        $this->assertTrue($user->isActive());
    }

}
