<?php

namespace Tests;

use App\Exceptions\Handler;
use App\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this->app->instance(ExceptionHandler::class, new class extends Handler
        {
            public function __construct()
            {
            }

            public function report(\Exception $e)
            {
            }

            public function render($request, \Exception $e)
            {
                throw $e;
            }
        });
    }

    /**
     * Re-enables exception handling.
     * @return $this
     */
    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        return $this;
    }

    /**
     * Signs a new user in.
     *
     * @param array $attributes
     *
     * @return $this
     */
    protected function signInUnactivated($attributes = [])
    {
        return $this->actingAs(create(User::class, $attributes));
    }

    /**
     * Signs a new user in.
     *
     * @param array $attributes
     *
     * @return $this
     */
    protected function signIn($attributes = [])
    {
        $user = create(User::class, $attributes);

        $user->activate();

        return $this->actingAs($user);
    }
}