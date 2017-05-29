<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Http\Controllers\Auth;

use App\Mail\OAuthAccountCreatedEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Two\User as GenericUser;

class GoogleController extends OAuthController
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function redirect()
    {
        return $this->socialiteInstance()->redirect();
    }

    public function callback()
    {
        /** @var GenericUser $genericUser */
        $genericUser = $this->socialiteInstance()->user();

        if (!$user = $this->retrieveUser($genericUser)) {
            $user = $this->createUser($genericUser);

            flash(__('Welcome to your new account, :user! You may use Google to login again in the future.',
                ['user' => $user->name]))->success();
        }

        auth()->login($user, true);

        return redirect()->intended(route('dashboard.index'));
    }

    public function retrieveUser(GenericUser $user)
    {
        return User::where([
            ['oauth_id', $user->getId()],
            ['oauth_type', 'google'],
        ])->first();
    }

    public function createUser(GenericUser $user): User
    {
        /** @var User $user */
        $user = User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => bcrypt(str_random(32)),
            'activated_at' => Carbon::now(),
            'oauth_id' => $user->getId(),
            'oauth_type' => 'google',
            'oauth_access_token' => $user->token
        ]);

        \Mail::to($user)->send(new OAuthAccountCreatedEmail($user));

        return $user;
    }

    protected function getDriver(): string
    {
        return 'google';
    }
}
