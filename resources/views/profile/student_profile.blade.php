@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit My Profile</h1>
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
                            <form action="{{ route('student.update-profile') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>First Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$user->name}}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="last_name"
                                                   placeholder="Enter Last Name" value="{{$user->last_name}}" >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Admission Number <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="admission_number"
                                                   placeholder="Enter ADN" value="{{$user->admission_number}}" disabled >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Roll Number</label>
                                            <input type="text" class="form-control" name="roll_number"
                                                   placeholder="Enter RN" value="{{$user->roll_number}}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Gender <span style="color: red;">*</span></label>
                                            <select name="gender" class="form-control">
                                                <option value="">Choose Gender</option>
                                                <option value="male" @selected($user->gender == 'male')>Male</option>
                                                <option value="female" @selected($user->gender == 'female')>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date Of Birth <span style="color: red;">*</span></label>
                                            <input type="date" class="form-control" name="date_of_birth" value="{{old('date_of_birth' , $user->date_of_birth)}}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Religion </label>
                                            <input type="text" class="form-control" name="religion"
                                                   placeholder="Enter Phone Number" value="{{ old('religion' , $user->religion)  }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phone Number <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="phone_number"
                                                   placeholder="Enter Phone Number" value="{{ old('phone_number' , $user->phone_number) }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputFile">Profile Picture</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="profile_picture">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                                <img src="{{ asset('storage/' . $user->image) }}" alt="" style="width: 70px; height: 70px; object-fit: cover;">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Blood Type</label>
                                            <input type="text" class="form-control" name="blood_type" value="{{ old('blood_type' , $user->blood_group) }}"  placeholder="Enter type">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Height</label>
                                            <input type="number" class="form-control" name="height"  placeholder="Enter height" value="{{ old("height" , $user->height) }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Weight</label>
                                            <input type="number" class="form-control" name="weight"  placeholder="Enter weight" value="{{ old("weight" , $user->weight) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address <span
                                                style="color: red;">*</span></label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                               name="email" placeholder="Enter email" value="{{ old("email" , $user->email) }}">
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
