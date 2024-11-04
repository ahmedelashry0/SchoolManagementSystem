@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Class List (Total: {{ $classes->total() }})</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-primary" href="{{ route('admin.class.add') }}">Add Class</a>
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
                            <div class="card-header">
                                <h3 class="card-title">Filter Classes</h3>
                            </div>
                            <form action="{{ route('admin.class.list') }}" method="get" class="mb-3">
                                <div class="card-body">
                                    <div class="form-row align-items-end">
                                        <div class="form-group col-md-4">
                                            <label>Class Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Name"
                                                   value="{{ request('name') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                @foreach((new \App\Models\Classroom)->getEnumStatus() as $status)
                                                    <option value="{{ $status }}"
                                                        @selected(request('status') == $status)>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-end mt-3">
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                            <button type="button" class="btn btn-secondary" onclick="resetFilters()">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @include('_message')

                        <!-- Class List Card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Class List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classes as $class)
                                        <tr>
                                            <td>{{ $class->id }}</td>
                                            <td>{{ $class->name }}</td>
                                            <td>{{ ucfirst($class->status) }}</td>
                                            <td>{{ $class->user->name }}</td>
                                            <td>{{ $class->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <a href="{{ route('admin.class.edit', $class->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('admin.class.delete', $class->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    {{ $classes->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </section>
    </div>

    <script>
        function resetFilters() {
            document.querySelector('input[name="name"]').value = '';
            document.querySelector('select[name="status"]').value = '';
            document.querySelector('input[name="date"]').value = '';
            window.location.href = "{{ route('admin.class.list') }}";
        }
    </script>
@endsection
