@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Wallet</div>

                <div class="card-body">
                    @foreach($users as $user)
                        <h4>User: {{ $user->name }}</h4>
                        <p>Current Wallet Balance: {{ formatRupiah($user->wallet) }}</p>
                        <form action="{{ route('wallet.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="form-group">
                                <label for="amount">Add Amount:</label>
                                <input type="number" id="amount" name="amount" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Wallet</button>
                        </form>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
