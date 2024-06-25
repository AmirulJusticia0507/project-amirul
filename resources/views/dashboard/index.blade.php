@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Welcome to the dashboard!</p>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Transactions</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($recentTransactions as $transaction)
                            <li class="list-group-item">{{ $transaction->order_id }} - {{ $transaction->amount }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product Inventory</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($productInventory as $product)
                        <li class="list-group-item">{{ $product->name }} - {{ $product->quantity }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
