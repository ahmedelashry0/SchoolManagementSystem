@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add New Student</h1>
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
                            @include('_message')
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.student.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>First Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Name"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="last_name"
                                                   placeholder="Enter Last Name" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Admission Number <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="admission_number"
                                                   placeholder="Enter ADN" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Roll Number</label>
                                            <input type="text" class="form-control" name="roll_number"
                                                   placeholder="Enter RN">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Class name <span style="color: red;">*</span></label>
                                            <select name="class_id" class="form-control">
                                                <option value="">Choose class</option>
                                                @foreach($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Gender <span style="color: red;">*</span></label>
                                            <select name="gender" class="form-control">
                                                <option value="">Choose Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date Of Birth <span style="color: red;">*</span></label>
                                            <input type="date" class="form-control" name="date_of_birth" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Religion </label>
                                            <input type="text" class="form-control" name="religion"
                                                   placeholder="Enter Phone Number">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phone Number <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="phone_number"
                                                   placeholder="Enter Phone Number">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Admission Date <span style="color: red;">*</span></label>
                                            <input type="date" class="form-control" name="admission_date" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputFile">Profile Picture</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="profile_picture">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Blood Type</label>
                                            <input type="text" class="form-control" name="blood_type"  placeholder="Enter type">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Height</label>
                                            <input type="number" class="form-control" name="height"  placeholder="Enter height">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Weight</label>
                                            <input type="number" class="form-control" name="weight"  placeholder="Enter weight">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Status <span style="color: red;">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                @foreach((new \App\Models\User())->getEnumStatus() as $status)
                                                    <option value="{{ $status }}"
                                                        @selected(request('status') == $status)>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
{{--                                        <div class="form-group col-md-6">--}}
{{--                                            <label>Address <span style="color: red;">*</span></label>--}}
{{--                                            <textarea class="form-control" name="address" rows="3"--}}
{{--                                                      placeholder="Enter Address"></textarea>--}}
{{--                                        </div>--}}
                                    </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address <span
                                                    style="color: red;">*</span></label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                   name="email" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password <span
                                                    style="color: red;">*</span></label>
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                   name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Confirm Password <span
                                                    style="color: red;">*</span></label>
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                   name="password_confirmation" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Add</button>
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
