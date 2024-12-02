@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Exam Schedule</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Search Exam Schedule</h3>
                    </div>
                    @include('_message')
                    <form action="{{ route('admin.exam_schedule') }}" method="Get">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="exam_id">Exam</label>
                                    <select name="exam_id" id="exam_id" class="form-control">
                                        <option value="">Select Exam</option>
                                        @foreach($exams as $exam)
                                            <option value="{{ $exam->id }}" @selected($exam->id == $exam_id)>{{ ucfirst($exam->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="class_id">Class</label>
                                    <select name="class_id" id="class_id" class="form-control">
                                        <option value="">Select Class</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}" @selected($class->id == $class_id)>{{ ucfirst($class->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 align-self-end">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                @if(!empty($subjects))
                    <div class="card mt-4">
                        <div class="card-header">
                            <h3 class="card-title">Exam Schedule</h3>
                        </div>
                        <form action="{{ route('admin.exam_schedule.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{ $exam_id }}">
                            <input type="hidden" name="class_id" value="{{ $class_id }}">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Exam Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Room Number</th>
                                        <th>Full Marks</th>
                                        <th>Passing Marks</th>
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                    @dd($schedules)--}}
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->name }}</td>
                                            <td>
                                                <input type="date" name="schedule[{{ $subject->id }}][exam_date]" value="{{ $schedules[$subject->id]['exam_date'] }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="time" name="schedule[{{ $subject->id }}][start_time]" value="{{ $schedules[$subject->id]['start_time'] }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="time" name="schedule[{{ $subject->id }}][end_time]" value="{{ $schedules[$subject->id]['end_time'] }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="schedule[{{ $subject->id }}][room_number]" value="{{ $schedules[$subject->id]['room_number'] }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" name="schedule[{{ $subject->id }}][full_marks]" value="{{ $schedules[$subject->id]['full_mark'] }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" name="schedule[{{ $subject->id }}][passing_marks]" value="{{ $schedules[$subject->id]['pass_mark'] }}" class="form-control">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-success">Save Schedule</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </section>
    </div>

@endsection
