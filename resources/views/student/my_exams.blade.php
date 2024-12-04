@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Exam List (Total:{{ $exams->total() }})</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <!-- Form for filtering admins -->
                        </div>
                        @include('_message')

                        <!-- Admin List Card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Exam List</h3>
                            </div>
                            <!-- /.card-header -->
                            @if(!empty($exams))
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Exam Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Room Number</th>
                                        <th>Full Mark</th>
                                        <th>Pass Mark</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($exams as $value)
                                        <tr>
                                            <td>{{ $value->subject->name }}</td>
                                            <td>{{ $value->exam_date }}</td>
                                            <td>{{ $value->start_time }}</td>
                                            <td>{{ $value->end_time }}</td>
                                            <td>{{ $value->room_number }}</td>
                                            <td>{{ $value->room_number }}</td>
                                            <td>{{ $value->full_mark }}</td>
                                            <td>{{ $value->pass_mark }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            @else
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th colspan="7" class="text-center">No exams available</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            @endif
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="d-flex justify-content-end mb-3">
                    {{ $exams->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        function resetFilters() {
            // Clear the form fields
            document.querySelector('input[name="name"]').value = '';
            document.querySelector('input[name="email"]').value = '';

            // Redirect to the admin list route to refresh the list
            window.location.href = "{{ route('admin.list') }}"; // Adjust the route name as necessary
        }
    </script>
@endsection
