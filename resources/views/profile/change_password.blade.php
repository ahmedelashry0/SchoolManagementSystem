
@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Change password</h1>
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @php
                                    $action = '';
                                    if (Auth::user()->user_type == 'admin') {
                                        $action = route('admin.update-password');
                                    } elseif (Auth::user()->user_type == 'teacher') {
                                        $action = route('teacher.update-password');
                                    }
                            @endphp
                            <form action="{{$action}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Old password</label>
                                        <input type="password" class="form-control" name="old_password" placeholder="Enter old password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>New password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter new password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm password</label>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                                    </div>
                                    <!-- /.card-body -->
                                    <button type="submit" class="btn btn-primary">update</button>
                                    {{--                                    <div class="card-footer">--}}
                                    {{--                                    </div>--}}
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
