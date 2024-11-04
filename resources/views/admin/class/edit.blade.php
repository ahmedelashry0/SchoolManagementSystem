
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
                            <form action="{{ route('admin.class.update' , $class->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Class name</label>
                                        <input type="text" class="form-control" name="name" VALUE="{{ $class->name }}" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Status</label>
                                        <select name="status" class="form-control">
                                            @foreach((new \App\Models\Classroom)->getEnumStatus() as $status)
                                                <option value="{{ $status }}" @selected($class->status == $status)>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.card-body -->
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                    {{--                                    <div class="card-footer">--}}
                                    {{--                                    </div>--}}
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
