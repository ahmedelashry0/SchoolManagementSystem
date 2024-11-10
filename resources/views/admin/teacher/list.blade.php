@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Parent List (Total:{{ $teachers->total() }})</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-primary" href="{{ route('admin.teacher.add') }}">Add Teacher</a>
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
                            <form action="{{ route('admin.teacher.list') }}" method="GET" class="mb-4">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ request('name') }}" placeholder="Enter name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" value="{{ request('last_name') }}" placeholder="Enter last name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" value="{{ request('email') }}" placeholder="Enter email">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number" value="{{ request('phone_number') }}" placeholder="Enter phone number">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="address">Current Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ request('address') }}" placeholder="Enter address">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="permanent_address">Permanent Address</label>
                                        <input type="text" class="form-control" name="permanent_address" value="{{ request('permanent_address') }}" placeholder="Enter permanent address">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="gender">Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="">Choose Gender</option>
                                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <input type="date" class="form-control" name="date_of_birth" value="{{ request('date_of_birth') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date_of_joining">Date of Joining</label>
                                        <input type="date" class="form-control" name="date_of_joining" value="{{ request('date_of_joining') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="marital_status">Marital Status</label>
                                        <select name="marital_status" class="form-control">
                                            <option value="">Select Marital Status</option>
                                            @foreach((new \App\Models\User())->getEnumMaritalStatus() as $status)
                                                <option value="{{ $status }}" {{ request('marital_status') == $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="qualification">Qualification</label>
                                        <input type="text" class="form-control" name="qualification" value="{{ request('qualification') }}" placeholder="Enter qualification">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="work_experience">Work Experience</label>
                                        <input type="text" class="form-control" name="work_experience" value="{{ request('work_experience') }}" placeholder="Enter work experience">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select Status</option>
                                            @foreach((new \App\Models\User())->getEnumStatus() as $status)
                                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.teacher.list') }}" class="btn btn-secondary">Reset</a>
                            </form>
                        </div>
                        @include('_message')

                        <!-- Admin List Card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Teacher List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Profile Pic</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>DOB</th>
                                            <th>DOJ</th>
                                            <th>Marital Status</th>
                                            <th>Current Addr</th>
                                            <th>Permanent Addr</th>
                                            <th>Qualification</th>
                                            <th>Work Exp</th>
                                            <th>Note</th>
                                            <th>Status</th>
                                            <th>Created-date</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($teachers as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $value->image) }}" alt="Profile Pic"
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                </td>
                                                <td>{{ $value->name . " " . $value->last_name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->gender }}</td>
                                                <td>{{ $value->phone_number }}</td>
                                                <td>{{ $value->date_of_birth }}</td>
                                                <td>{{ $value->admission_date }}</td>
                                                <td>{{ $value->marital_status }}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>{{ $value->permanent_address }}</td>
                                                <td>{{ $value->qualification }}</td>
                                                <td>{{ $value->work_experience }}</td>
                                                <td>{{ $value->note }}</td>
                                                <td>{{ $value->status }}</td>
                                                <td>{{ $value->created_at->format('d/y/m') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Actions">
                                                    <a href="{{ route('admin.teacher.edit', $value->id) }}"
                                                       class="btn btn-info btn-sm">Edit</a>
                                                    <a href="{{ route('admin.teacher.delete', $value->id) }}"
                                                       class="btn btn-danger btn-sm ml-1">Delete</a>
                                                    {{--                                                <a href="{{ route('admin.teacher.my_students', $value->id) }}" class="btn btn-info btn-sm">My-Students</a>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="d-flex justify-content-end mb-3">
                    {{ $teachers->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        document.getElementById('name').addEventListener('input', function () {
            document.getElementById('last_name').value = this.value;
        });
        function resetFilters() {
            // Clear the form fields
            document.querySelector('input[name="name"]').value = '';
            document.querySelector('input[name="email"]').value = '';
            document.querySelector('input[name="phone_number"]').value = '';
            document.querySelector('input[name="address"]').value = '';
            document.querySelector('input[name="permanent_address"]').value = '';
            document.querySelector('input[name="qualification"]').value = '';
            document.querySelector('input[name="work_experience"]').value = '';
            document.querySelector('input[name="date_of_birth"]').value = '';
            document.querySelector('input[name="date_of_joining"]').value = '';
            document.querySelector('select[naem="gender"]').value = '';
            document.querySelector('select[naem="marital_status"]').value = '';
            document.querySelector('select[naem="status"]').value = '';
            // Redirect to the admin list page
            window.location.href = "{{ route('admin.teacher.list') }}";
        }
    </script>
@endsection
