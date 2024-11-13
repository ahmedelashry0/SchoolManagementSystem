@extends('layouts.app')

@section('content')
{{--    @dd($students)--}}
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My students List (Total: {{ $students->total() }})</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">

                        </div>
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
                                            <th>Religion</th>
                                            <th>DOB</th>
                                            <th>Phone</th>
                                            <th>BG</th>
                                            <th>Height</th>
                                            <th>Weight</th>
                                            <th>Image</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $student->id }}</td>
                                                <td>{{ $student->name. " " .$student->last_name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->admission_number }}</td>
                                                <td>{{ $student->admission_date }}</td>
                                                <td>{{ $student->roll_number }}</td>
                                                <td>{{ $student->student_class->name }}</td>
                                                <td>{{ $student->gender }}</td>
                                                <td>{{ $student->status }}</td>
                                                <td>{{ $student->religion }}</td>
                                                <td>{{ $student->date_of_birth }}</td>
                                                <td>{{ $student->phone_number }}</td>
                                                <td>{{ $student->blood_group }}</td>
                                                <td>{{ $student->height }} cm</td>
                                                <td>{{ $student->weight }} KG</td>
                                                <td><img src="{{ asset('storage/' . $student->image) }}"
                                                         alt="{{ $student->name }}" class="img-thumbnail"
                                                         style="width: 100px; height: 50px;"></td>
                                                <td>{{ $student->created_at->format('d/m/y') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Actions">
                                                        <a href="{{ route('admin.student.edit', $student->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                        <a href="{{ route('admin.student.delete', $student->id) }}" class="btn btn-danger btn-sm ml-1">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    {{ $students->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </section>
    </div>
    <script>
        document.getElementById('name').addEventListener('input', function () {
            document.getElementById('last_name').value = this.value;
        });
        function resetFilters() {
            document.querySelector('input[name="name"]').value = '';
            document.querySelector('input[name="email"]').value = '';
            document.querySelector('input[name="admission_number"]').value = '';
            document.querySelector('input[name="date_of_birth"]').value = '';
            window.location.href = "{{ route('parent.my_students') }}";
        }
    </script>
@endsection
