@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit My profile</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('_message')
                            <form action="{{ route('teacher.update-profile', $user->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter Name" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="Enter Last Name" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Gender <span style="color: red;">*</span></label>
                                            <select name="gender" class="form-control" required>
                                                <option value="">Choose Gender</option>
                                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Phone Number <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Enter Phone Number">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Marital Status <span style="color: red;">*</span></label>
                                            <select name="marital_status" class="form-control" required>
                                                @foreach((new \App\Models\User())->getEnumMaritalStatus() as $status)
                                                    <option value="{{ $status }}" {{ old('marital_status', $user->marital_status) == $status ? 'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date Of Birth <span style="color: red;">*</span></label>
                                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Current Address <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="address" value="{{ old('address', $user->address) }}" placeholder="Enter Address" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Permanent Address <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="permanent_address" value="{{ old('permanent_address', $user->permanent_address) }}" placeholder="Enter Address" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Qualifications <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="qualification" value="{{ old('qualification', $user->qualification) }}" placeholder="Enter Qualification" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Work Experience <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="work_experience" value="{{ old('work_experience', $user->work_experience) }}" placeholder="Enter Work Experience" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="profile_picture">Profile Picture</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="profile_picture" name="profile_picture">
                                                    <label class="custom-file-label" for="profile_picture">Choose file</label>
                                                </div>
                                            </div>
                                            <img src="{{ asset('storage/' . $user->image) }}" alt="" style="width: 70px; height: 70px; object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>

                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
