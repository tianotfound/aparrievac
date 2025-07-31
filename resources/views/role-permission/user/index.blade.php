@extends('layouts.app')

@section('content')

    <div class="container mt-2">
        <div class="row">
            <!-- Left column for buttons card -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-header fw-bold">
                        <h7>Management</h7>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <a href="{{ url('roles') }}" class="btn btn-primary mx-1 mb-2">Roles</a>
                        <a href="{{ url('permissions') }}" class="btn btn-info mx-1 mb-2">Permissions</a>
                        <a href="{{ url('users') }}" class="btn btn-warning mx-1">Users</a>
                    </div>
                </div>
            </div>

            <!-- Right column for table -->
            <div class="col-md-9">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mb-3 bg-transparent border-0">
                    <div class="card-body fw-bold">
                        <h7>Users
                            @can('create user')
                            <a href="{{ url('users/create') }}" class="btn btn-primary btn-sm float-end">Add User</a>
                            @endcan
                        </h7>
                    </div>
                </div>
                        <table id="myTable" class="table table-bordered table-light table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $rolename)
                                                <label class="badge badge-sm bg-primary mx-1">{{ $rolename }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @can('update user')
                                        <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-success btn-sm">Edit</a>
                                        @endcan

                                        @can('delete user')
                                        <a href="{{ url('users/'.$user->id.'/delete') }}" class="btn btn-danger btn-sm">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

@endsection