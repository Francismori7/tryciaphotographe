<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Http\Controllers\Auth;

use App\FacebookAccount;

class FacebookController extends OAuthController
{
    /**
     * @var string|FacebookAccount
     */
    protected $model = FacebookAccount::class;

    public function __construct()
    {
        $this->middleware('guest');
    }
}
