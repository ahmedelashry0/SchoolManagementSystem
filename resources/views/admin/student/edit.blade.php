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
                            <form action="{{ route('admin.student.update' , $student->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>First Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$student->name}}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="last_name"
                                                   placeholder="Enter Last Name" value="{{$student->last_name}}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Admission Number <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="admission_number"
                                                   placeholder="Enter ADN" value="{{$student->admission_number}}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Roll Number</label>
                                            <input type="text" class="form-control" name="roll_number"
                                                   placeholder="Enter RN" value="{{$student->roll_number}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Class name <span style="color: red;">*</span></label>
                                            <select name="class_id" class="form-control">
                                                <option value="">Choose class</option>
                                                @foreach($classes as $class)
                                                    <option value="{{ $class->id }}" @selected($student->class_id == $class->id)>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Gender <span style="color: red;">*</span></label>
                                            <select name="gender" class="form-control">
                                                <option value="">Choose Gender</option>
                                                <option value="male" @selected($student->gender == 'male')>Male</option>
                                                <option value="female" @selected($student->gender == 'female')>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date Of Birth <span style="color: red;">*</span></label>
                                            <input type="date" class="form-control" name="date_of_birth" value="{{old('date_of_birth' , $student->date_of_birth)}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Religion </label>
                                            <input type="text" class="form-control" name="religion"
                                                   placeholder="Enter Phone Number" value="{{ old('religion' , $student->religion)  }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phone Number <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="phone_number"
                                                   placeholder="Enter Phone Number" value="{{ old('phone_number' , $student->phone_number) }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Admission Date <span style="color: red;">*</span></label>
                                            <input type="date" class="form-control" name="admission_date" value="{{ old('admission_date' , $student->admission_date) }}">
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
                                            <input type="text" class="form-control" name="blood_type" value="{{ old('blood_type' , $student->blood_group) }}"  placeholder="Enter type">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Height</label>
                                            <input type="number" class="form-control" name="height"  placeholder="Enter height" value="{{ old("height" , $student->height) }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Weight</label>
                                            <input type="number" class="form-control" name="weight"  placeholder="Enter weight" value="{{ old("weight" , $student->weight) }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Status <span style="color: red;">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                @foreach((new \App\Models\User())->getEnumStatus() as $status)
                                                    <option value="{{ $status }}"
                                                        @selected($student->status == $status)>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address <span
                                                style="color: red;">*</span></label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                               name="email" placeholder="Enter email" value="{{ old("email" , $student->email) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="password"  placeholder="Enter if you want to change">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Confirm Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation"  placeholder="confirm password">
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
