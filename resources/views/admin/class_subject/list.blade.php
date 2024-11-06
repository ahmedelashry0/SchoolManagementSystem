@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Classes-Subjects List (Total: {{ $classSubjects->total() }})</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-primary" href="{{ route('admin.class_subject.assign') }}">Assign Subject</a>
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
                            <form action="{{ route('admin.class_subject.list') }}" method="get" class="mb-3">
                                <div class="card-body">
                                    <div class="form-row align-items-end">
                                        <div class="form-group col-md-4">
                                            <label>Class Name</label>
                                            <input type="text" class="form-control" name="className"
                                                   placeholder="Enter Name"
                                                   value="{{ request('className') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Subject Name</label>
                                            <input type="text" class="form-control" name="subjectName"
                                                   placeholder="Enter Name"
                                                   value="{{ request('subjectName') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Creator</label>
                                            <select name="creator" class="form-control">
                                                <option value="">Creator</option>
                                                @foreach($classSubjects as $user)
                                                    <option value="{{ $user->user->name }}"
                                                        @selected(request('creator') == $user->user->name)>
                                                        {{ ucfirst($user->user->name) }}
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
                                            <input type="date" class="form-control" name="date"
                                                   value="{{ request('date') }}">
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
                                <h3 class="card-title">AAssignments List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class Name</th>
                                        <th>Subject Name</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classSubjects as $assignment)
                                        <tr>
                                            <td>{{ $assignment->id }}</td>
                                            <td>{{ $assignment->classroom->name }}</td>
                                            <td>{{ $assignment->subject->name }}</td>
                                            <td>{{ ucfirst($assignment->status) }}</td>
                                            <td>{{ $assignment->user->name }}</td>
                                            <td>{{ $assignment->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <a href="{{ route('admin.class_subject.edit', $assignment->id) }}"
                                                   class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('admin.class_subject.delete', $assignment->id) }}"
                                                   class="btn btn-danger btn-sm">Delete</a>
                                                <a href="{{ route('admin.class_subject.edit_single', $assignment->id) }}"
                                                   class="btn btn-primary btn-sm">Edit Single</a>
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
                    {{ $classSubjects->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </section>
    </div>

    <script>function resetFilters() {
            document.querySelector('input[name="className"]').value = '';
            document.querySelector('select[name="status"]').value = '';
            document.querySelector('input[name="subjectName"]').value = '';
            document.querySelector('input[name="date"]').value = '';
            document.querySelector('select[name="creator"]').value = '';
            document.querySelector('form').submit();
        }</script>
@endsection
