@extends('layouts.app')

@section('content')
    <div class="ui-section-view-main-header">
        <div class="ui-heading">{{ __('dashboard.title') }}</div>
    </div>

    <div class="ui-section-view-main-body">
        <div class="card">
            <div class="card-body">
                {!! __('dashboard.body') !!}
            </div>
        </div>
    </div>
@endsection
