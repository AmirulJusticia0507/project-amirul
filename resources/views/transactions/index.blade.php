@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Transactions</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Transactions</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-6">
                <p>Your current wallet balance: {{ $walletBalance }}</p>
            </div>


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Transaction History</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addTransactionModal">Add Transaction</button>
                        <div class="table-responsive">
                            <table class="display table table-bordered table-striped table-hover responsive nowrap" style="width:100%" id="transactionTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
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
                                        <td>{{ $transaction->product->name }}</td>
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
<script>
    $(document).ready(function () {
        $('#transactionTable').DataTable({
            responsive: true,
            scrollX: true,
            searching: true,
            lengthMenu: [10, 25, 50, 100, 500, 1000],
            pageLength: 10,
            dom: 'lBfrtip'
        });
    });
</script>
@endsection
