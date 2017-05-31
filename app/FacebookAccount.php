<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App;

class FacebookAccount extends SocialAccount
{
    public static $name = 'Facebook';
    public static $icon = 'fa-facebook-f';

    public static function driverName()
    {
        return 'facebook';
    }
}
