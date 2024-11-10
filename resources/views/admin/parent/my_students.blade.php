@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Parent Student List (Total: {{ $students->total() }})</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-primary" href="{{ route('admin.parent.add') }}">Add Parent</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form action="{{ route('admin.parent.my_students', $parent->id) }}" method="GET" class="mb-3">
                                @csrf
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>Student ID</label>
                                            <input type="text" class="form-control" name="student_id" placeholder="Enter ID" value="{{ request('student_id') }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ request('name') }}">
                                            <input type="hidden" class="form-control" name="last_name" value="{{ request('name') }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Email Address</label>
                                            <input type="text" class="form-control" name="email" placeholder="Enter Email" value="{{ request('email') }}">
                                        </div>
                                        <div class="form-group col-md-2 mt-auto">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                            <button type="button" class="btn btn-secondary" onclick="resetFilters()">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @include('_message')

                        <!-- Unassigned Students List -->
                        @if($students->total() > 0)
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Students list</h3>
                                </div>
                                <div class="card-body p-0 overflow-auto">
                                    <table class="table table-striped text-center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Last Name</th>
                                            <th>Parent</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $student->id }}</td>
                                                <td>
                                                    <a href="{{ asset('storage/' . $student->image) }}">
                                                        <img src="{{ asset('storage/' . $student->image) }}" class="rounded-circle" width="60" height="60" alt="image"/>
                                                    </a>
                                                </td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->last_name }}</td>
                                                <td>{{ $student->parent->name ?? 'No Parent' }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->created_at->format('Y-m-d H:i:s') }}</td>
                                                <td>
                                                    @if($student->parent_id)
                                                        <button class="btn btn-secondary" disabled>Assigned</button>
                                                    @else
                                                    <a href="{{ route('admin.parent.assign_student_parent', [$student->id, $parent->id]) }}" class="btn btn-info">Add to Parent</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end mt-3">
                                        {{ $students->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-center my-3">No unassigned students found.</p>
                        @endif

                        <!-- Assigned Students List -->
                        @if($parent_students->total() > 0)
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h3 class="card-title">Parent's Assigned Students (Total: {{ $parent_students->total() }})</h3>
                                </div>
                                <div class="card-body p-0 overflow-auto">
                                    <table class="table table-striped text-center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Parent Name</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($parent_students as $student)
                                            <tr>
                                                <td>{{ $student->id }}</td>
                                                <td>
                                                    <a href="{{ asset('storage/' . $student->image) }}">
                                                        <img src="{{ asset('storage/' . $student->image) }}" class="rounded-circle" width="60" height="60" alt="image"/>
                                                    </a>
                                                </td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->last_name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->parent->name }}</td>
                                                <td>{{ $student->created_at->format('Y-m-d H:i:s') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.parent.delete_student_parent', $student->id) }}" class="btn btn-danger">Remove</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end mt-3">
                                        {{ $parent_students->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-center my-3">No assigned students found.</p>
                        @endif
                    </div>
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
            document.querySelector('input[name="student_id"]').value = '';
            window.location.href = "{{ route('admin.parent.my_students', $parent->id) }}";
        }
    </script>
@endsection
