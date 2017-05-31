<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConnectedAccount extends Model
{
    protected $guarded = [];
    protected $casts = [
        'data' => 'object',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets an instance of the account type.
     */
    public function getInstance()
    {
        return new $this->account_type($this);
    }

    public function getName()
    {
        return $this->getAccountType()::$name;
    }

    public function getIcon()
    {
        return $this->getAccountType()::$icon;
    }

    /**
     * @return mixed
     */
    protected function getAccountType()
    {
        return $this->account_type;
    }
}
