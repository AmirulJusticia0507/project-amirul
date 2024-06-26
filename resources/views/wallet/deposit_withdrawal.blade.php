@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br><br>
            <div class="card">
                <div class="card-header">Deposit & Withdrawal</div>

                <div class="card-body">
                    <h4>Your Wallet Balance: {{ formatRupiah($user->wallet) }}</h4>

                    <!-- Menampilkan notifikasi jika ada -->
                    @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

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

                    <hr>

                    <!-- Tabel catatan log -->
                    <div class="mt-4">
                        <h5>Transaction Log</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactionLogs as $log)
                                <tr>
                                    <td>{{ $log->created_at }}</td>
                                    <td>{{ formatRupiah($log->amount) }}</td>
                                    <td>{{ ucfirst($log->type) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
