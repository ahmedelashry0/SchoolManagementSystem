@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Students List (Total: {{ $students->total() }})</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Admin List Card -->
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">Students List</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width: 2%;">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>AdmissionN</th>
                                            <th>AdmissionD</th>
                                            <th>RN</th>
                                            <th>Class</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($students as $classTeacher)
                                            @foreach($classTeacher->classroom->student as $student)
                                                <tr>
                                                    <td>{{ $student->id }}</td>
                                                    <td>{{ $student->name . ' ' . $student->last_name }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ $student->admission_number }}</td>
                                                    <td>{{ $student->admission_date }}</td>
                                                    <td>{{ $student->roll_number }}</td>
                                                    <td>{{ $classTeacher->classroom->name }}</td>
                                                    <td>{{ ucfirst($student->gender) }}</td>
                                                    <td>{{ ucfirst($student->status) }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $student->image) }}"
                                                             alt="{{ $student->name }}"
                                                             class="img-circle img-size-32 mr-2">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No students found.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    {{ $students->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </section>
    </div>
@endsection
