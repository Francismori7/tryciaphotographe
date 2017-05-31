<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Http\Controllers\Auth;

use App\TwitterAccount;

class TwitterController extends OAuthController
{
    /**
     * @var string|TwitterAccount
     */
    protected $model = TwitterAccount::class;

    public function __construct()
    {
        $this->middleware('guest');
    }
}
