@extends('layouts.content')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-light">
                    <h3 class="h5 pt-2">User Dashboard</h3>
                </div>
                <div class="card-body">
                    <p>Welcome, {{ Auth::user()->name }}! You are logged in as a <strong>User</strong>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
