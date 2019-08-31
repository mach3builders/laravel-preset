<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Account;
use App\User;

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
                    ->from(env('APP_EMAIL_FROM'), env('APP_NAME'))
                    ->view('mail.activate-registration', [
                        'account' => $this->account,
                        'user' => $this->user,
                    ]);
    }
}
