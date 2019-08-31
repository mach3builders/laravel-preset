@extends('layouts.error')

@section('content')
<h6 class="ui-legend">{{ __('errors.500-heading') }}</h6>
<div class="alert alert-danger">{!! $body ?? __('errors.message') !!}</div>
@endsection
