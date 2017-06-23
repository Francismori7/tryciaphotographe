<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Mail\OAuthAccountCreatedEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

abstract class OAuthController extends Controller
{
    public function redirect()
    {
        return $this->socialiteInstance()->redirect();
    }

    public function callback()
    {
        $genericUser = $this->socialiteInstance()->user();

        if ($user = $this->retrieveUser($genericUser)) {
            $this->refreshUser($user, $genericUser);
        } else {
            $user = $this->createUser($genericUser);

            flash(__('Welcome to your account, :user! You may use :provider to login again in the future.', [
                'user' => $user->name,
                'provider' => title_case($this->getDriver()),
            ]))->success();
        }

        auth()->login($user, true);

        return redirect()->intended(route('dashboard.index'));
    }

    public function retrieveUser($user)
    {
        return User::whereHas('connectedAccounts', function (Builder $query) use ($user) {
            $query->where('connected_accounts.account_id', $user->getId());
            $query->where('connected_accounts.account_type', $this->model);
        })->first();
    }

    public function refreshUser(User $user, $genericUser)
    {
        $account = $user
            ->connectedAccounts()
            ->where('account_type', $this->model)
            ->where('connected_accounts.account_id', $genericUser->getId())
            ->first();

        $account->data = $this->model::dataForConnectedAccount($genericUser);

        $account->save();
    }

    public function createUser($genericUser): User
    {
        /** @var User $user */
        $user = User::firstOrCreate([
            'email' => $genericUser->getEmail(),
        ], [
            'name' => $genericUser->getName(),
            'password' => bcrypt(str_random(32)),
            'activated_at' => Carbon::now(),
        ]);

        $user->connectedAccounts()->create([
            'account_type' => $this->model,
            'account_id' => $genericUser->getId(),
            'data' => $this->model::dataForConnectedAccount($genericUser),
        ]);

        $user->assignRole('user');

        Mail::to($user)->send(new OAuthAccountCreatedEmail($user));

        return $user;
    }

    protected function getDriver(): string
    {
        return $this->model::driverName();
    }

    protected function socialiteInstance()
    {
        return tap(Socialite::driver($this->getDriver()), function ($instance) {
            if (method_exists($instance, 'stateless')) {
                $instance->stateless();
            }
        });
    }
}