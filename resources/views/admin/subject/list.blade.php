@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subjects List (Total: {{ $subjects->total() }})</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-primary" href="{{ route('admin.subject.add') }}">Add Subject</a>
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
                                <h3 class="card-title">Filter Subjects</h3>
                            </div>
                            <form action="{{ route('admin.subject.list') }}" method="get" class="mb-3">
                                <div class="card-body">
                                    <div class="form-row align-items-end">
                                        <div class="form-group col-md-4">
                                            <label>Subject Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Name"
                                                   value="{{ request('name') }}">
                                        </div>
                                            <div class="form-group col-md-4">
                                                <label>Type</label>
                                                <select name="type" class="form-control">
                                                    <option value="">Select Type</option>
                                                    @foreach((new \App\Models\Subject)->getEnumType() as $type)
                                                        <option value="{{ $type }}"
                                                            @selected(request('type') == $type)>
                                                            {{ $type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <div class="form-group col-md-4">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                @foreach((new \App\Models\Subject)->getEnumStatus() as $status)
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
                                <h3 class="card-title">Subject List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->id }}</td>
                                            <td>{{ $subject->name }}</td>
                                            <td>{{ $subject->type }}</td>
                                            <td>{{ ucfirst($subject->status) }}</td>
                                            <td>{{ $subject->user->name }}</td>
                                            <td>{{ $subject->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <a href="{{ route('admin.subject.edit', $subject->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('admin.subject.delete', $subject->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
                    {{ $subjects->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </section>
    </div>

    <script>
        function resetFilters() {
            document.querySelector('input[name="name"]').value = '';
            document.querySelector('select[name="status"]').value = '';
            document.querySelector('select[name="type"]').value = '';
            document.querySelector('input[name="date"]').value = '';
            window.location.href = "{{ route('admin.subject.list') }}";
        }
    </script>
@endsection
