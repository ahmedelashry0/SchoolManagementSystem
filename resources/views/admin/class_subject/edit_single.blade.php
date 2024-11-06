@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit Single assign</h1>
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
                            <form action="{{route('admin.class_subject.update_single' , $classSubject->id)}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Class name</label>
                                        <select name="classroom" class="form-control">
                                            <option value="">Choose class</option>
                                            @foreach($classrooms as $class)
                                                <option value="{{ $class->id }}" @selected($class->id == $classSubject->class_id)>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Subject Name</label>
                                            <div>
                                                <select name="subject" class="form-control">
                                                    <option value="">Select Subject</option>
                                                    @foreach($subjects as $subject)
                                                        <option value="{{ $subject->id }}"@selected($classSubject->subject_id == $subject->id) >{{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select Status</option>
                                            @foreach((new \App\Models\ClassSubject())->getEnumStatus() as $status)
                                                <option value="{{ $status }}" @selected(old('status' , $classSubject->status) == $status)>{{ $status }}</option>
                                            @endforeach
                                        </select>
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
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
