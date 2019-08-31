@extends('layouts.mail.admin')

@section('content')
	<p style="font-size: 15px; line-height: 1.6; margin: 0 0 36px 0; padding: 0;">
		De onderstaande fout is opgetreden bij het aanmaken van een Mollie account:<br><br>
		<code>{!! $error !!}</code>
	</p>
	<p style="font-size: 15px; line-height: 1.6; margin: 0 0 36px 0; padding: 0;">
		<u>Contactgegevens</u><br>
		<strong>Bedrijfsnaam</strong>: {{ $company->name }}<br>
		<strong>Contactpersoon</strong>: {{ $company->contact }}<br>
		<strong>Telefoonnummer</strong>: {{ $company->phone }}<br>
		<strong>Emailadres</strong>: {{ $company->email }}<br>
		<strong>Mollie Partner ID</strong>: {{ $company->mollie_partner_id }}<br>
		<strong>Mollie Username</strong>: {{ $company->mollie_username }}
	</p>
@endsection