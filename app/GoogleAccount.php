<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App;

use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as GenericUser;

class GoogleAccount extends SocialAccount
{
    public static $name = 'Google';
    public static $icon = 'fa-google';

    public static function driverName()
    {
        return 'google';
    }
}
