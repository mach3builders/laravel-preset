<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Facades\Label;

class AccountCreated extends Mailable
{
    private $company;
    private $username;
    private $password;
    private $activation_link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($company, $username, $password, $activation_link)
    {
        $this->company          = $company;
        $this->username         = $username;
        $this->password         = $password;
        $this->activation_link  = $activation_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('mail.account-created-subject'))
                    ->from(Label::get('email'), Label::get('name'))
                    ->view('mail.account-created', [
                        'company' => $this->company,
                        'username' => $this->username,
                        'password' => $this->password,
                        'activation_link' => $this->activation_link
                    ]);
    }
}
