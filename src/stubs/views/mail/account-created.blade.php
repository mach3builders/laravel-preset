@extends('layouts.mail.admin')

@section('content')
	<h3 style="color: #1b2431; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 22px; font-weight: 500; line-height: 1.1; margin: 0 0 18px 0; padding: 0;">
		{!! trans('mail.salutation', ['name' => $company->contact]) !!}
	</h3>
	<p style="font-size: 15px; line-height: 1.6; margin: 0 0 36px 0; padding: 0;">
		{!! trans('mail.account-created-body-1') !!}
	</p>
	<p style="font-size: 15px; line-height: 1.6; margin: 0 0 36px 0; padding: 0;">
		{!! trans('mail.account-created-body-2', ['username' => $username, 'password' => $password, 'activation_link' => $activation_link]) !!}
	</p>
	<p style="font-size: 13px; line-height: 1.6; margin: 0 0 36px 0; padding: 0;">
		{!! trans('mail.signature') !!}
	</p>
@endsection
