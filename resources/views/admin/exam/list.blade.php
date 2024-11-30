@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Exam List (Total:{{ $exams->total() }})</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-primary" href="{{ route('admin.exam.add') }}">Add Exam</a>
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
                            <form action="{{ route('admin.exam.list') }}" method="get" class="mb-3">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ request('name') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Note</label>
                                            <input type="text" class="form-control" name="note" placeholder="Enter note" value="{{ request('note') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Created-by</label>
                                            <input type="text" class="form-control" name="created_by" placeholder="Enter Name" value="{{ request('created_by') }}">
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
                                <h3 class="card-title">Exam List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Note</th>
                                        <th>Created-By</th>
                                        <th>Created-date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($exams as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->note }}</td>
                                            <td>{{ $value->creator->name }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.exam.edit', $value->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ route('admin.exam.delete', $value->id) }}" class="btn btn-danger">Delete</a>
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
                    {{ $exams->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        function resetFilters() {
            // Clear the form fields
            document.querySelector('input[name="name"]').value = '';
            document.querySelector('input[name="created_by"]').value = '';
            document.querySelector('input[name="date"]').value = '';
            document.querySelector('input[name="note"]').value = '';

            // Redirect to the admin list route to refresh the list
            window.location.href = "{{ route('admin.list') }}"; // Adjust the route name as necessary
        }
    </script>
@endsection
