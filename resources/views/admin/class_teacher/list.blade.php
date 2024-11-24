@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Classes-Teachers List (Total: {{ $classTeachers->total() }})</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-primary" href="{{ route('admin.class_teacher.assign') }}">Assign Teacher</a>
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
                                <h3 class="card-title">Filter Assignments</h3>
                            </div>
                            <form action="{{ route('admin.class_teacher.list') }}" method="get" class="mb-3">
                                <div class="card-body">
                                    <div class="form-row align-items-end">
                                        <div class="form-group col-md-4">
                                            <label>Class</label>
                                            <select name="class_id" class="form-control">
                                                <option value="">Select class</option>
                                                @foreach($classes as $value)
                                                    <option value="{{ $value->id }}"
                                                        @selected(request('class_id') == $value->id)>
                                                        {{ ucfirst($value->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Teacher</label>
                                            <select name="teacher_id" class="form-control">
                                                <option value="">Select Teacher</option>
                                                @foreach($teachers as $value)
                                                    <option value="{{ $value->id }}"
                                                        @selected(request('teacher_id') == $value->id)>
                                                        {{ ucfirst($value->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                @foreach((new \App\Models\ClassSubject())->getEnumStatus() as $status)
                                                    <option value="{{ $status }}"
                                                        @selected(request('status') == $status)>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="created_at"
                                                   value="{{ request('created_at') }}">
                                        </div>
                                    </div>
                                    <div class="form-row justify-content-end mt-3">
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                            <button type="button" class="btn btn-secondary" onclick="resetFilters()">
                                                Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @include('_message')

                        <!-- Class List Card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Class-Teacher List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class Name</th>
                                        <th>Teacher Name</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classTeachers as $assignment)
                                        <tr>
                                            <td>{{ $assignment->id }}</td>
                                            <td>{{ $assignment->classroom->name }}</td>
                                            <td>{{ $assignment->teacher->name }}</td>
                                            <td>{{ ucfirst($assignment->status) }}</td>
                                            <td>{{ $assignment->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <a href="{{ route('admin.class_teacher.edit', $assignment->id) }}"
                                                   class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('admin.class_teacher.delete', $assignment->id) }}"
                                                   class="btn btn-danger btn-sm">Delete</a>
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
                    {{ $classTeachers->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </section>
    </div>

    <script>function resetFilters() {
            document.querySelector('select[name="class_id"]').value = '';
            document.querySelector('select[name="status"]').value = '';
            document.querySelector('select[name="teacher_id"]').value = '';
            document.querySelector('input[name="created_at"]').value = '';
            document.querySelector('form').submit();
        }</script>
@endsection
