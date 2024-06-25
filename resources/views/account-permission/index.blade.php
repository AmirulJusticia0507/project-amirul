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
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addPermissionModal">Add Permission</button>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPermissionModal{{ $user->id }}">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePermissionModal{{ $user->id }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('account-permission.create') <!-- Include create modal -->
@foreach($users as $user)
@include('account-permission.edit', ['user' => $user]) <!-- Include edit modals for each user -->
@include('account-permission.delete', ['user' => $user]) <!-- Include delete modals for each user -->
@endforeach
@endsection
