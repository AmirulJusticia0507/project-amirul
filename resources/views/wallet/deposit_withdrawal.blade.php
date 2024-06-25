@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Deposit & Withdrawal</div>

                <div class="card-body">
                    <h4>Your Wallet Balance: {{ $user->wallet }}</h4>

                    <div class="mt-4">
                        <!-- Form untuk deposit -->
                        <form action="{{ route('wallet.deposit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="deposit_amount">Deposit Amount:</label>
                                <input type="number" id="deposit_amount" name="amount" class="form-control" required min="1">
                            </div>
                            <button type="submit" class="btn btn-primary">Deposit</button>
                        </form>
                    </div>

                    <hr>

                    <div class="mt-4">
                        <!-- Form untuk withdrawal -->
                        <form action="{{ route('wallet.withdrawal') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="withdrawal_amount">Withdrawal Amount:</label>
                                <input type="number" id="withdrawal_amount" name="amount" class="form-control" required min="1" max="{{ $user->wallet }}">
                            </div>
                            <button type="submit" class="btn btn-danger">Withdrawal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
