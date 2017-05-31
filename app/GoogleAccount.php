<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App;

use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as GenericUser;

class GoogleAccount
{
    /**
     * @var \App\User
     */
    public $user;
    /**
     * @var \App\ConnectedAccount
     */
    public $account;

    /**
     * GoogleAccount constructor.
     *
     * @param \App\User $user
     * @param \App\ConnectedAccount $account
     */
    public function __construct(User $user, ConnectedAccount $account)
    {
        $this->user = $user;
        $this->account = $account;
    }

    public function refreshAccount()
    {
        $this->account->data = self::dataForConnectedAccount($this->getFreshGoogleUser());

        $this->account->save();

        return $this;
    }

    public static function dataForConnectedAccount(GenericUser $genericUser)
    {
        return [
            'genericUser' => $genericUser->getRaw(),
            'access_token' => $genericUser->token,
            'refresh_token' => $genericUser->refreshToken ?? null,
        ];
    }

    /**
     * Retrieve a live version.
     * @return mixed
     */
    public function getFreshGoogleUser()
    {
        return Socialite::driver('google')->stateless()->userFromToken($this->account->data->access_token);
    }
}
