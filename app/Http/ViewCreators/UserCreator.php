<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Http\ViewCreators;

use Illuminate\Contracts\View\View;

class UserCreator
{
    /**
     * Create a new profile composer.
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     *
     * @return void
     */
    public function create(View $view)
    {
        /** @var \App\User $user */
        $user = auth()->user();
        if ($user) {
            $user->setRelation('connectedAccounts', $user->connectedAccounts);
            $user->setAttribute('unreadNotifications_count', $user->unreadNotifications()->count());
        }

        $view->with('user', $user);
    }
}