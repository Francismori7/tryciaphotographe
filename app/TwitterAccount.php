<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App;

use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as GenericUser;

class TwitterAccount extends SocialAccount
{
    public static $name = 'Twitter';
    public static $icon = 'fa-twitter';

    public static function driverName()
    {
        return 'twitter';
    }
}
