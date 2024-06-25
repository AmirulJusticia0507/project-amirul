<!-- resources/views/register.blade.php -->

@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Register</h5>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>
@endsection
