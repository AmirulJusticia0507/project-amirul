<!-- resources/views/verifikasi.blade.php -->

@extends('layouts.auth')

@section('title', 'Verification')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Verification</h5>
        <div class="alert alert-success" role="alert">
            Your account has been verified successfully.
        </div>
        <p>Continue to <a href="{{ route('dashboard.index') }}">Dashboard</a></p>
    </div>
</div>
@endsection
