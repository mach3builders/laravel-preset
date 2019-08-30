@extends('layouts.error')

@section('content')
<h6 class="ui-legend">{{ __('errors.404-heading') }}</h6>
<div class="alert alert-danger">{{ __('errors.404-body') }}</div>
@endsection
