@extends('layouts.error')

@section('content')
<h6 class="ui-legend">{{ __('errors.custom-heading') }}</h6>
<div class="alert alert-danger">{!! $body ?? '' !!}</div>
@endsection
