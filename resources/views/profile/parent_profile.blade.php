@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit my profile</h1>
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
                            <form action="{{ route('parent.update-profile') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $user->name }}"  placeholder="Enter Name" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}"  placeholder="Enter Last  Name" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control" >
                                                <option value="">Choose Gender</option>
                                                <option value="male"@selected($user->gender == 'male')>Male</option>
                                                <option value="female" @selected($user->gender == 'female')>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Phone Number </label>
                                            <input type="text" class="form-control" name="phone_number"
                                                   placeholder="Enter Phone Number" value="{{ $user->phone_number }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Occupation</label>
                                            <input type="text" class="form-control" name="occupation"
                                                   placeholder="Enter Occupation" value="{{ $user->occupation }}" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Address </label>
                                            <input type="text" class="form-control" name="address"
                                                   placeholder="Enter Address" value="{{ $user->address }}">
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
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email"  value="{{ $user->email }}">
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
