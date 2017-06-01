<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ConnectedAccount
 *
 * @property int $id
 * @property int $user_id
 * @property string $account_id
 * @property string $account_type
 * @property object $data
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\ConnectedAccount whereAccountId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConnectedAccount whereAccountType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConnectedAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConnectedAccount whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConnectedAccount whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConnectedAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConnectedAccount whereUserId($value)
 * @mixin \Eloquent
 */
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
