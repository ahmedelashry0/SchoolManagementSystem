@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $header_title }}</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @foreach ($classes as $classTeacher)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Class: {{ $classTeacher->classroom->name }}
                                    </h3>
                                </div>
                                <div class="card-body">
                                    @php
                                        $groupedSchedules = $classTeacher->classroom->exams->groupBy('exam_id');
                                    @endphp
                                    @if($groupedSchedules->isNotEmpty())
                                    @foreach ($groupedSchedules as $examId => $schedules)
                                        <h5>Exam Name: {{ $schedules->first()->exam->name }}</h5>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Subject Name</th>
                                                <th>Day</th>
                                                <th>Exam Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Room Number</th>
                                                <th>Full Marks</th>
                                                <th>Passing Marks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($schedules as $schedule)
                                                <tr>
                                                    <td>{{ $schedule->subject->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($schedule->exam_date)->format('l') }}</td>
                                                    <td>{{ $schedule->exam_date }}</td>
                                                    <td>{{ $schedule->start_time }}</td>
                                                    <td>{{ $schedule->end_time }}</td>
                                                    <td>{{ $schedule->room_number }}</td>
                                                    <td>{{ $schedule->full_mark }}</td>
                                                    <td>{{ $schedule->pass_mark }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endforeach
                                    @else
                                        <p>No exams scheduled for this class</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
