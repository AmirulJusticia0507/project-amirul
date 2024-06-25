<!-- resources/views/forgot.blade.php -->

@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Forgot Password</h5>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
        </form>
    </div>
</div>
@endsection
