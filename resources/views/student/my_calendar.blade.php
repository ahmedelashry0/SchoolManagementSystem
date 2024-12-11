@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>My Calendar</h1>
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
                        <div id="calendar">

                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    {{--    <script src='{{asset('dist/fullcalendar/index.global.js')}}'></script>--}}
    {{--    <script type="text/javascript">--}}
    {{--        var calendarID = document.getElementById('calendar');--}}
    {{--        var calendar = new FullCalendar.Calendar(calendarID, {--}}
    {{--            initialView: 'dayGridMonth',--}}
    {{--            headerToolbar: {--}}
    {{--                left: 'prev,next today',--}}
    {{--                center: 'title',--}}
    {{--                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'--}}
    {{--            },--}}
    {{--        });--}}
    {{--        calendar.render();--}}
    {{--    </script>--}}
@endsection
@section('script')
    <script src='{{asset('dist/fullcalendar/index.global.js')}}'></script>
    <script type="text/javascript">
        var calendarID = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarID, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            navLinks: true,
            editable: false,
            events: [
                    @foreach($timetables->student_class->subject as $subject)
                    @foreach($subject->timetables as $timetable)
                {
                    title: '{{ $subject->name }}',
                    daysOfWeek: [{{ $timetable->week->fullcalendar_day }}],
                    startTime: '{{ \Carbon\Carbon::parse($timetable->start_time)->format('H:i:s') }}',
                    endTime: '{{ \Carbon\Carbon::parse($timetable->end_time)->format('H:i:s') }}',

                },
                @endforeach
                @endforeach
            ],
            initialDate: '<?= date('Y-m-d') ?>',
        });
        calendar.render();
    </script>
@endsection
