<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Http\Controllers\Auth;

use App\GoogleAccount;

class GoogleController extends OAuthController
{
    /**
     * @var string|GoogleAccount
     */
    protected $model = GoogleAccount::class;

    public function __construct()
    {
        $this->middleware('guest');
    }
}
