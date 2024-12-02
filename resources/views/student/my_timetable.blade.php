@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $header_title }}</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Timetable Cards -->
{{--                        @dd($timetables->student_class->timetables)--}}
                        @if($timetables && $timetables->student_class && $timetables->student_class->subject->isNotEmpty())
                            @foreach($timetables->student_class->subject as $subject)
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h3 class="card-title">{{ $subject->name }}</h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Week</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Room Number</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($subject->timetables->isNotEmpty())
                                                    @foreach($subject->timetables as $timetable)
                                                        <tr>
                                                            <td>{{ $timetable->week->name }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($timetable->start_time)->format('h:i A') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($timetable->end_time)->format('h:i A') }}</td>
                                                            <td>{{ $timetable->room_number }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="text-center">No timetable available</td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card">
                                <div class="card-body text-center">
                                    <p>No subjects or timetables available for your class.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
