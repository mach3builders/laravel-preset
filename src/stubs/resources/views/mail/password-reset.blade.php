@extends('layouts.mail.customer')

@section('content')
	<h3 style="color: #1b2431; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 22px; font-weight: 500; line-height: 1.1; margin: 0 0 18px 0; padding: 0;">
		{!! trans('mail.salutation', ['name' => $user->name]) !!}
	</h3>
	<p style="font-size: 15px; line-height: 1.6; margin: 0 0 36px 0; padding: 0;">
		{!! trans('mail.password-reset-body-1') !!}
	</p>
	<p style="color: #1b2431; font-weight: normal; font-size: 14px; line-height: 1.6; margin: 0 0 36px 0; padding: 0;">
		{!! trans('mail.password-reset-body-2', ['link' => url('password/reset', $token)]) !!}
	</p>
	<p style="font-size: 13px; line-height: 1.6; margin: 0 0 36px 0; padding: 0;">
		{!! trans('mail.signature') !!}
	</p>
@endsection