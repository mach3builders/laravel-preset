<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Facades\Label;

class AccountCreatedError extends Mailable
{
    private $company;
    private $error;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($company, $error)
    {
        $this->company  = $company;
        $this->error    = $error;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Fout bij aanmaken Mollie account')
                    ->from(Label::get('email'), Label::get('name'))
                    ->view('mail.account-created-error', ['company' => $this->company, 'error' => $this->error]);
    }
}
