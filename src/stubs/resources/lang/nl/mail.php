<?php
return [
	'registration-done-title' => 'Jouw account is aangemaakt!',
	'registration-done-body' => 'Wij hebben een activatielink verzonden naar :email.',
	'activate-registration-subject' => 'Activeer jouw '.env('APP_NAME').' account',
	'activate-registration-body' => 'Super dat je een account hebt aangemaakt bij '.env('APP_NAME').'!<br />
                                        Bevestig jouw account door op de onderstaande knop te klikken.<br /><br />
                                        <a href=":link" style="background-color:#2ea1f8;border-radius:3px;color:#ffffff;display:inline-block;font-size:11px;font-weight:bold;padding-top:8px;padding-bottom:8px;padding-right:27px;padding-left:27px;text-decoration:none;text-transform:uppercase;">Account activeren</a>',
    'password-reset-body-1' => 'We sturen je deze e-mail omdat we een aanvraag hebben gekregen om jouw wachtwoord te resetten.<br />
                                Als je dit niet zelf hebt aangevraagd dan kan je deze mail negeren.
                                Wil je het wachtwoord wel vernieuwen? Klik dan op de onderstaande button:<br><br>
								<a href=":link" style="background-color:#2ea1f8;border-radius:3px;color:#ffffff;display:inline-block;font-size:11px;font-weight:bold;padding-top:8px;padding-bottom:8px;padding-right:27px;padding-left:27px;text-decoration:none;text-transform:uppercase;">Wachtwoord resetten</a>',
	'password-reset-subject' => 'Nieuw wachtwoord aanvragen voor '. env('APP_NAME'),
	'salutation' => 'Beste :name,',
	'signature' => 'Met vriendelijke groet,<br />
					'.env('APP_NAME'),
	'signature-simple' => 'Met vriendelijke groet,',
	'footer' => env('APP_NAME').' is mogelijk gemaakt door',
];
