<!-- resources/views/login.blade.php -->

@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Login</h5>
        <form method="POST" action="{{ route('login') }}">
            @csrf

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

            <div class="form-group d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary">Login</button>
                {{-- <div>
                    <a href="{{ route('password.request') }}" class="btn btn-link">Forgot Password?</a>
                    <a href="{{ route('register') }}" class="btn btn-link">Register</a>
                </div> --}}
            </div>
        </form>
        <h4>Catatan:</h4>
        <p>Email Login: amirul@gmail.com</p>
        <p>Password Login: tester123</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script to toggle password visibility
    $(document).ready(function() {
        $('#togglePassword').on('click', function() {
            const password = $('#password');
            const type = password.attr('type') === 'password' ? 'text' : 'password';
            password.attr('type', type);
            $(this).find('i').toggleClass('fa fa-eye fa fa-eye-slash');
        });
    });
</script>
@endpush
