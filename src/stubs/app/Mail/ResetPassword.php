<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;

use App\User;
use App\Facades\Label;

class ResetPassword extends Mailable
{
    private $user;
    private $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $token)
    {
        $this->user     = $user;
        $this->token    = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('mail.password-reset-subject'))
                    ->from(Label::get('email'), Label::get('name'))
                    ->view('mail.password-reset', ['user' => $this->user, 'token' => $this->token]);
    }
}
