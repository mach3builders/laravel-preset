<?php
return [
	'registration-done-title' => 'Your account has been created!',
	'registration-done-body' => 'We have sent an activation link to :email.',
	'activate-registration-subject' => 'Activate your '.env('APP_NAME').' account',
	'activate-registration-body' => 'Great that you have created an account at '.env('APP_NAME').'!<br />
									    Confirm your account by clicking the button below.<br /><br />
										<a href=":link" style="background-color:#2ea1f8;border-radius:3px;color:#ffffff;display:inline-block;font-size:11px;font-weight:bold;padding-top:8px;padding-bottom:8px;padding-right:27px;padding-left:27px;text-decoration:none;text-transform:uppercase;">Activate account</a>',
    'password-reset-body' => 'We\'re sending you this email because we received a request to reset your password.<br />
                                If you have not requested it yourself then you can ignore this mail.<br />
                                If you do want to renew your password, please click on the button below:<br><br>
								<a href=":link" style="background-color:#2ea1f8;border-radius:3px;color:#ffffff;display:inline-block;font-size:11px;font-weight:bold;padding-top:8px;padding-bottom:8px;padding-right:27px;padding-left:27px;text-decoration:none;text-transform:uppercase;">Reset password</a>',
	'password-reset-subject' => 'Request new password for '. env('APP_NAME'),
	'salutation' => 'Dear :name,',
	'signature' => 'Best regards,<br />
					'.env('APP_NAME'),
	'signature-simple' => 'Best regards,',
	'footer' => env('APP_NAME').' is made possible by',
];
