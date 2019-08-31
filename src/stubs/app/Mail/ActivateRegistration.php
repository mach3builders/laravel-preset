<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Facades\Label;

class ActivateRegistration extends Mailable
{
    private $account;
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Account $account, User $user)
    {
        $this->account = $account;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('mail.activate-registration-subject'))
                    ->from(Label::get('email'), Label::get('name'))
                    ->view('mail.activate-registration', ['account' => $this->account, 'user' => $this->user]);
    }
}
