@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Assign Teacher</h1>
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
                            <form action="{{route('admin.class_teacher.update' , $classTeacher->id)}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Class name</label>
                                        <select name="classroom" class="form-control">
                                            <option value="">Choose class</option>
                                            @foreach($classrooms as $class)
                                                <option value="{{ $class->id }}" @selected($classTeacher->class_id == $class->id)>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Teacher Name</label>
                                        @foreach($teachers as $teacher)
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="teachers[]" value="{{ $teacher->id }}" @checked(in_array($teacher->id ,$assigned_teachers))>
                                                    {{ $teacher->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select Status</option>
                                            @foreach((new \App\Models\ClassSubject())->getEnumStatus() as $status)
                                                <option value="{{ $status }}" @selected($status == $classTeacher->status)>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.card-body -->
                                    <button type="submit" class="btn btn-primary">Update</button>
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
