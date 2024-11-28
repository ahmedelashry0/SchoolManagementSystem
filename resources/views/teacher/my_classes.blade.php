@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Classes-Subjects List (Total: {{ $classesSubjects->total() }})</h1>
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
{{--                            <form action="{{ route('admin.class_teacher.list') }}" method="get" class="mb-3">--}}
{{--                                <div class="card-body">--}}
{{--                                    <div class="form-row align-items-end">--}}
{{--                                        <div class="form-group col-md-4">--}}
{{--                                            <label>Class</label>--}}
{{--                                            <select name="class_id" class="form-control">--}}
{{--                                                <option value="">Select class</option>--}}
{{--                                                @foreach($classes as $value)--}}
{{--                                                    <option value="{{ $value->id }}"--}}
{{--                                                        @selected(request('class_id') == $value->id)>--}}
{{--                                                        {{ ucfirst($value->name) }}--}}
{{--                                                    </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-4">--}}
{{--                                            <label>Teacher</label>--}}
{{--                                            <select name="teacher_id" class="form-control">--}}
{{--                                                <option value="">Select Teacher</option>--}}
{{--                                                @foreach($teachers as $value)--}}
{{--                                                    <option value="{{ $value->id }}"--}}
{{--                                                        @selected(request('teacher_id') == $value->id)>--}}
{{--                                                        {{ ucfirst($value->name) }}--}}
{{--                                                    </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-4">--}}
{{--                                            <label>Status</label>--}}
{{--                                            <select name="status" class="form-control">--}}
{{--                                                <option value="">Select Status</option>--}}
{{--                                                @foreach((new \App\Models\ClassSubject())->getEnumStatus() as $status)--}}
{{--                                                    <option value="{{ $status }}"--}}
{{--                                                        @selected(request('status') == $status)>--}}
{{--                                                        {{ ucfirst($status) }}--}}
{{--                                                    </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-4">--}}
{{--                                            <label>Date</label>--}}
{{--                                            <input type="date" class="form-control" name="created_at"--}}
{{--                                                   value="{{ request('created_at') }}">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-row justify-content-end mt-3">--}}
{{--                                        <div class="col-auto">--}}
{{--                                            <button type="submit" class="btn btn-primary">Filter</button>--}}
{{--                                            <button type="button" class="btn btn-secondary" onclick="resetFilters()">--}}
{{--                                                Reset--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
                        </div>

                        @include('_message')

                        <!-- Class List Card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Class-Subject List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>Class Name</th>
                                        <th>Subject Name</th>
                                        <th>Subject Type</th>
                                        <th>My class Timetable</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classesSubjects as $classTeacher)
                                        @foreach($classTeacher->classroom->classSubjects as $classSubject)
                                            <tr>
                                                <td>{{ $classSubject->id }}</td>
                                                <td>{{ $classTeacher->classroom->name }}</td>
                                                <td>{{ $classSubject->subject?->name ?? 'N/A' }}</td>
                                                <td>{{ ucfirst($classSubject->subject?->type ?? 'N/A') }}</td>
                                                <td>
                                                    @php
                                                        $today = now()->dayName;
                                                        $timetable = $classSubject->timetables
                                                            ->where('week.name', $today)
                                                            ->where('class_id', $classTeacher->classroom->id)
                                                            ->where('subject_id', $classSubject->subject->id)
                                                            ->first();

                                                    @endphp

                                                    @if ($timetable)
                                                        {{ \Carbon\Carbon::parse($timetable->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($timetable->end_time)->format('h:i A') }}<br>
                                                        Room: {{ $timetable->room_number }}
                                                    @else
                                                        No timetable today
                                                    @endif
                                                </td>

                                                <td>{{ $classSubject->created_at->format('Y-m-d') }}</td>
                                                <td><a href="{{ route('teacher.my_timetable', [$classTeacher->classroom->id ,$classSubject->subject->id] ) }}" class="btn btn-info btn-sm">Timetable</a></td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    {{ $classesSubjects->withQueryString()->links('vendor.pagination.bootstrap-4') }}
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
