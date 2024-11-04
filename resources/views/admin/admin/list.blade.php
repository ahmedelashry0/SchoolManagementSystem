@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Admin List (Total:{{ $admins->total() }})</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-primary" href="{{ route('admin.add') }}">Add Admin</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <!-- Form for filtering admins -->
                            <form action="{{ route('admin.list') }}" method="get" class="mb-3">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ request('name') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Email address</label>
                                            <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{ request('email') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="date"  value="{{ request('date') }}">
                                        </div>
                                        <div class="form-group col-md-4 mt-auto">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                            <button type="button" class="btn btn-secondary" onclick="resetFilters()">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @include('_message')

                        <!-- Admin List Card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Admin List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created-date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ route('admin.delete', $admin->id) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="d-flex justify-content-end mb-3">
                    {{ $admins->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        function resetFilters() {
            // Clear the form fields
            document.querySelector('input[name="name"]').value = '';
            document.querySelector('input[name="email"]').value = '';

            // Redirect to the admin list route to refresh the list
            window.location.href = "{{ route('admin.list') }}"; // Adjust the route name as necessary
        }
    </script>
@endsection
