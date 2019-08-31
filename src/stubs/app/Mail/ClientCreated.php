<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Facades\Label;

class ClientCreated extends Mailable
{
    private $user;
    private $company;
    private $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $company, $password)
    {
        $this->user = $user;
        $this->company  = $company;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('mail.client-created-subject'))
                    ->from(Label::get('email'), Label::get('name'))
                    ->view('mail.client-created', ['user' => $this->user, 'company' => $this->company, 'password' => $this->password]);
    }
}
