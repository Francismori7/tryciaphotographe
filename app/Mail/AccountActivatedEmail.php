<?php
/******************************************************************************
 * Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.           *
 ******************************************************************************/

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountActivatedEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var \App\User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param \App\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.account-activated')
            ->subject(__('Account Activated Successfully!'));
    }
}
