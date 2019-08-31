@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    
    <div class="ui-section-view-main-header">
        <div class="ui-heading">Dashboard</div>
    </div>
    
    <div class="card">
        <div class="card-body">
            You are logged in!
        </div>
    </div>
@endsection
