<!-- resources/views/reset.blade.php -->

@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Reset Password</h5>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required autocomplete="new-password">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script to toggle password visibility
    $(document).ready(function() {
        $('#togglePassword, #toggleConfirmPassword').on('click', function() {
            const target = $(this).prev('input');
            const type = target.attr('type') === 'password' ? 'text' : 'password';
            target.attr('type', type);
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });
    });
</script>
@endpush
