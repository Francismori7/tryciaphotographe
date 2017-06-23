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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets an instance of the account type.
     *
     * @return \App\SocialAccount
     */
    public function getInstance()
    {
        return new $this->account_type($this);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getAccountType()::$name;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->getAccountType()::$icon;
    }

    /**
     * @return string
     */
    protected function getAccountType()
    {
        return $this->account_type;
    }
}
