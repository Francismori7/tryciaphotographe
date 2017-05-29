<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User as GenericUser;

abstract class OAuthController extends Controller
{
    abstract public function redirect();

    abstract public function callback();

    abstract public function retrieveUser(GenericUser $user);

    abstract public function createUser(GenericUser $user);

    protected function socialiteInstance(): AbstractProvider
    {
        return Socialite::driver($this->getDriver())->stateless();
    }

    abstract protected function getDriver(): string;
}