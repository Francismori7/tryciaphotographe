<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App;


use Laravel\Socialite\Facades\Socialite;

abstract class SocialAccount
{
    /**
     * @var \App\ConnectedAccount
     */
    public $account;

    /**
     * SocialAccount constructor.
     *
     * @param \App\ConnectedAccount $account
     */
    public function __construct(ConnectedAccount $account)
    {
        $this->account = $account;
    }

    abstract public static function driverName();

    public static function dataForConnectedAccount($genericUser)
    {
        /** @var \Laravel\Socialite\Two\User|\Laravel\Socialite\One\User $genericUser */
        return [
            'genericUser' => $genericUser->getRaw(),
            'nickname' => $genericUser->getNickname(),
            'avatar' => $genericUser->avatar_original ?? $genericUser->getAvatar(),

            'access_token' => $genericUser->token,
            'refresh_token' => $genericUser->refreshToken ?? null,
            'secret_token' => $genericUser->tokenSecret ?? null,
        ];
    }

    public function refreshAccount()
    {
        $this->account->data = self::dataForConnectedAccount($this->getFreshUser());

        $this->account->save();

        return $this;
    }

    /**
     * Retrieve a live version.
     */
    public function getFreshUser()
    {
        $instance = Socialite::driver($this::driverName());

        if (method_exists($instance, 'stateless')) {
            $instance->stateless();

            return $instance->userFromToken($this->account->data->access_token);
        }

        return $instance->userFromTokenAndSecret(
            $this->account->data->access_token,
            $this->account->data->secret_token
        );
    }
}