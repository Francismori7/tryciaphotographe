<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Http\Controllers\Auth;

use App\GoogleAccount;
use App\Mail\OAuthAccountCreatedEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Socialite\Two\User as GenericUser;

class GoogleController extends OAuthController
{
    private $model = GoogleAccount::class;

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

        if ($user = $this->retrieveUser($genericUser)) {
            $this->refreshUser($user, $genericUser);
        } else {
            $user = $this->createUser($genericUser);

            flash(__('Welcome to your new account, :user! You may use Google to login again in the future.',
                ['user' => $user->name]))->success();
        }

        auth()->login($user, true);

        return redirect()->intended(route('dashboard.index'));
    }

    public function retrieveUser(GenericUser $user)
    {
        return User::whereHas('connectedAccounts', function (Builder $query) use ($user) {
            $query->where('connected_accounts.account_id', $user->getId());
            $query->where('connected_accounts.account_type', $this->model);
        })->first();
    }

    public function refreshUser(User $user, GenericUser $genericUser)
    {
        $account = $user
            ->connectedAccounts()
            ->where('account_type', $this->model)
            ->where('connected_accounts.account_id', $genericUser->getId())
            ->first();

        $account->data = GoogleAccount::dataForConnectedAccount($genericUser);

        $account->save();
    }

    protected function dataForConnectedAccount(GenericUser $genericUser)
    {
    }

    public function createUser(GenericUser $genericUser): User
    {
        /** @var User $user */
        $user = User::create([
            'name' => $genericUser->getName(),
            'email' => $genericUser->getEmail(),
            'password' => bcrypt(str_random(32)),
            'activated_at' => Carbon::now(),
        ]);

        $user->connectedAccounts()->create([
            'account_type' => $this->model,
            'account_id' => $genericUser->getId(),
            'data' => GoogleAccount::dataForConnectedAccount($genericUser),
        ]);

        \Mail::to($user)->send(new OAuthAccountCreatedEmail($user));

        return $user;
    }

    protected function getDriver(): string
    {
        return 'google';
    }
}
