@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Transaction History</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Order ID</th>
                                        <th>Amount</th>
                                        <th>Timestamp</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->order_id }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->timestamp }}</td>
                                        <td>{{ $transaction->status == 1 ? 'Success' : 'Failed' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editTransactionModal{{ $transaction->id }}">Edit</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteTransactionModal{{ $transaction->id }}">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@include('transactions.create') <!-- Include create modal -->
@foreach($transactions as $transaction)
@include('transactions.edit', ['transaction' => $transaction]) <!-- Include edit modals for each transaction -->
@include('transactions.delete', ['transaction' => $transaction]) <!-- Include delete modals for each transaction -->
@endforeach

@endsection
