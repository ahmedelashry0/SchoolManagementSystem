@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add New Teacher</h1>
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
                            <form action="{{ route('admin.teacher.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name"  placeholder="Enter Name" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name"  placeholder="Enter Last  Name" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Gender <span style="color: red;">*</span></label>
                                            <select name="gender" class="form-control" required>
                                                <option value="">Choose Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Phone Number <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="phone_number"
                                                   placeholder="Enter Phone Number">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Mstatus <span style="color: red;">*</span></label>
                                            <select name="marital_status" class="form-control" required>
                                                @foreach((new \App\Models\User())->getEnumMaritalStatus() as $status)
                                                    <option value="{{ $status }}"
                                                        @selected(request('marital_status') == $status)>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date Of Birth <span style="color: red;">*</span></label>
                                            <input type="date" class="form-control" name="date_of_birth" value="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date Of Joining <span style="color: red;">*</span></label>
                                            <input type="date" class="form-control" name="date_of_joining" value="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Current Address <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="address"
                                                   placeholder="Enter Address" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Permanent Address <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="permanent_address"
                                                   placeholder="Enter Address" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Qualifications <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="qualification"
                                                   placeholder="Enter Qualification" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Work Exp <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="work_experience"
                                                   placeholder="Enter Work EXP" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Note</label>
                                            <input type="text" class="form-control" name="note"
                                                   placeholder="Enter Note">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Status <span style="color: red;">*</span></label>
                                            <select name="status" class="form-control" required>
                                                <option value="">Select Status</option>
                                                @foreach((new \App\Models\User())->getEnumStatus() as $status)
                                                    <option value="{{ $status }}"
                                                        @selected(request('status') == $status)>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputFile">Profile Picture</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="profile_picture">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
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
