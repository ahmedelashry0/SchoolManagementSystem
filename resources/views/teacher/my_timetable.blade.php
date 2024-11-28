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
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">
                                    @if ($timetables->isNotEmpty())
                                        {{ $timetables->first()->class->name }} - {{ $timetables->first()->subject->name }}
                                    @else
                                        No Timetable Data
                                    @endif
                                </h3>
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
                                        @if ($timetables->isNotEmpty())
                                            @foreach ($timetables as $timetable)
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
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
