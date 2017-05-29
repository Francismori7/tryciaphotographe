<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

/**
 * Created by PhpStorm.
 * User: franc
 * Date: 2017-05-15
 * Time: 21:48
 */

namespace App\Traits;


use App\Mail\AccountActivationEmail;
use Illuminate\Support\Facades\Mail;

trait MustActivateAccount
{
    /**
     * Send an email that tells about the activation of the user's account.
     * @return $this
     */
    public function sendActivationEmail()
    {
        Mail::to($this)->send(new AccountActivationEmail($this));
        return $this;
    }

    /**
     * Activates the user's account.
     * @return $this
     */
    public function activate()
    {
        $this->update([
            'activation_code' => null,
            'activated_at' => $this->freshTimestamp(),
        ]);

        return $this;
    }

    /**
     * Returns the activation link for the user.
     * @return null|string
     */
    public function activationPath()
    {
        if ($this->isActive()) {
            return null;
        }

        return route('activate', ['code' => $this->activation_code]);
    }

    /**
     * Is the user currently active?
     * @return bool
     */
    public function isActive()
    {
        return !$this->activation_code;
    }

    /**
     * Returns a new activation code.
     * @return string
     */
    public static function newActivationCode()
    {
        return str_random(32);
    }
}