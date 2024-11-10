@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add New Admin</h1>
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
                            <form action="{{ route('admin.parent.update' , $parent->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $parent->name }}"  placeholder="Enter Name" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name" value="{{ $parent->last_name }}"  placeholder="Enter Last  Name" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Gender <span style="color: red;">*</span></label>
                                            <select name="gender" class="form-control" >
                                                <option value="">Choose Gender</option>
                                                <option value="male"@selected($parent->gender == 'male')>Male</option>
                                                <option value="female" @selected($parent->gender == 'female')>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Phone Number <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="phone_number"
                                                   placeholder="Enter Phone Number" value="{{ $parent->phone_number }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Occupation <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="occupation"
                                                   placeholder="Enter Occupation" value="{{ $parent->occupation }}" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Address <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="address"
                                                   placeholder="Enter Address" value="{{ $parent->address }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Status <span style="color: red;">*</span></label>
                                            <select name="status" class="form-control" >
                                                <option value="">Select Status</option>
                                                @foreach((new \App\Models\User())->getEnumStatus() as $status)
                                                    <option value="{{ $status }}"
                                                        @selected($parent->status == $status)>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email"  value="{{ $parent->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" >
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
