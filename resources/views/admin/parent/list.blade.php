@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Parent List (Total:{{ $parents->total() }})</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-primary" href="{{ route('admin.parent.add') }}">Add parent</a>
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
                            <form action="{{ route('admin.parent.list') }}" method="get" class="mb-3">
                                @csrf
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
                                <h3 class="card-title">Parent List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Profile Pic</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Occupation</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Created-date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($parents as $parent)
                                        <tr>
                                            <td>{{ $parent->id }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $parent->image) }}" alt="Profile Pic" style="width: 50px; height: 50px; object-fit: cover;">
                                            </td>
                                            <td>{{ $parent->name . " " . $parent->last_name }}</td>
                                            <td>{{ $parent->email }}</td>
                                            <td>{{ $parent->gender }}</td>
                                            <td>{{ $parent->phone_number }}</td>
                                            <td>{{ $parent->occupation }}</td>
                                            <td>{{ $parent->address }}</td>
                                            <td>{{ $parent->status }}</td>
                                            <td>{{ $parent->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.parent.edit', $parent->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('admin.parent.delete', $parent->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                                <a href="{{ route('admin.parent.my_students', $parent->id) }}" class="btn btn-info btn-sm">My-Students</a>
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
                    {{ $parents->withQueryString()->links('vendor.pagination.bootstrap-4') }}
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
            window.location.href = "{{ route('admin.parent.list') }}"; // Adjust the route name as necessary
        }
    </script>
@endsection
