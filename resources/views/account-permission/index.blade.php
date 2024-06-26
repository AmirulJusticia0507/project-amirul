@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Account Permission</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Account Permission</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#addPermissionModal">
        <i class="fas fa-plus"></i> Add Permission
    </button>

    <div class="table-responsive">
        <table class="display table table-bordered table-striped table-hover responsive nowrap" style="width:100%" id="permissionTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @if(auth()->user()->role == 'user' && auth()->user()->id != $user->id)
                        @continue
                    @endif
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editPermissionModal{{ $user->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePermissionModal{{ $user->id }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('account-permission.create') <!-- Include create modal -->

@foreach($users as $user)
    @if(auth()->user()->role == 'user' && auth()->user()->id != $user->id)
        @continue
    @endif
    @include('account-permission.edit', ['user' => $user]) <!-- Include edit modals for each user -->
    @include('account-permission.delete', ['user' => $user]) <!-- Include delete modals for each user -->
@endforeach

<script>
    $(document).ready(function () {
        $('#permissionTable').DataTable({
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
