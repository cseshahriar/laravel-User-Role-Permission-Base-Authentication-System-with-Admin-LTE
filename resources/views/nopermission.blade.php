@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                   <p class="alert alert-danger">Access Denied! You have no permission for this action.</p>
                   <a href="{{ url('/home') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
