@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Classes-Timetable</h1>
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
                        @include('_message')
                            <div class="card-header">
                                <h3 class="card-title">Choose Class </h3>
                            </div>
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="class_id">Class</label>
                                        <select name="class_id" class="form-control">
                                            <option value="">Select Class</option>
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}">{{ ucfirst($class->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="subject_id">Subject</label>
                                        <select name="subject_id" class="form-control">
                                            <option value="">Select Subject</option>
                                            <!-- Options will be populated dynamically via JavaScript -->
                                        </select>
                                    </div>
                                </div>
                            </form>

                        </div>


                        <!-- Class List Card -->
                        <form action="{{ route('admin.class_timetable.add') }}" method="Post">
                            @csrf
                            <input type="hidden" name="class_id" id="hiddenClassId">
                            <input type="hidden" name="subject_id" id="hiddenSubjectId">
                            <div id="weeksTableContainer" style="display: none;">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Class Timetable</h3>
                                    </div>
                                    <div class="card-body p-0">
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
                                            @php($i = 1)
                                            @foreach($weeks as $value)
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="timetable[{{$i}}][week_id]" value="{{ $value->id }}">
                                                        {{ $value->name }}
                                                    </td>
                                                    <td><input type="time" name="timetable[{{$i}}][start_time]" class="form-control"></td>
                                                    <td><input type="time" name="timetable[{{$i}}][end_time]" class="form-control"></td>
                                                    <td><input type="number" name="timetable[{{$i}}][room_number]" class="form-control">
                                                    </td>

                                                </tr>
                                                @php($i++)
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                        <button type="submit" class="btn btn-lg btn-primary mx-auto">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    {{--                    {{ $classTeachers->withQueryString()->links('vendor.pagination.bootstrap-4') }}--}}
                </div>
            </div>
        </section>
    </div>

    <script>document.addEventListener('DOMContentLoaded', function () {
            const classSelect = document.querySelector('select[name="class_id"]');
            const subjectSelect = document.querySelector('select[name="subject_id"]');

            classSelect.addEventListener('change', function () {
                const classId = this.value;

                // Clear existing subject options
                subjectSelect.innerHTML = '<option value="">Loading...</option>';

                if (!classId) {
                    subjectSelect.innerHTML = '<option value="">Select Subject</option>';
                    return;
                }

                // Fetch subjects for the selected class
                fetch(`admin/get-subjects-by-class/${classId}`)
                    .then((response) => response.json())
                    .then((subjects) => {
                        subjectSelect.innerHTML = '<option value="">Select Subject</option>';
                        subjects.forEach((subject) => {
                            const option = document.createElement('option');
                            option.value = subject.id;
                            option.textContent = `${subject.name} (${subject.status})`;
                            subjectSelect.appendChild(option);
                        });
                    })
                    .catch((error) => {
                        subjectSelect.innerHTML = '<option value="">Select Subject</option>';
                        console.error('Error fetching subjects:', error);
                        alert('Failed to fetch subjects. Please try again.');
                    });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const classSelect = document.querySelector('select[name="class_id"]');
            const subjectSelect = document.querySelector('select[name="subject_id"]');
            const weeksTableContainer = document.getElementById('weeksTableContainer');
            const weekInputs = weeksTableContainer.querySelectorAll('tbody tr');

            function fetchSubjects(classId) {
                // Fetch subjects for the selected class
                fetch(`/get-subjects-by-class/${classId}`)
                    .then(response => response.json())
                    .then(subjects => {
                        // Populate subject dropdown
                        subjectSelect.innerHTML = '<option value="">Select Subject</option>';
                        subjects.forEach(subject => {
                            const option = document.createElement('option');
                            option.value = subject.id;
                            option.textContent = subject.name;
                            subjectSelect.appendChild(option);
                        });
                    })
                    // .catch(error => {
                    //     console.error('Error fetching subjects:', error);
                    //     alert('Failed to fetch subjects. Please try again.');
                    // });
            }

            function fetchTimetable(classId, subjectId) {
                // Fetch timetable for the selected class and subject
                fetch(`admin/get-timetable/${classId}/${subjectId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing values
                        weekInputs.forEach(row => {
                            row.querySelector('input[name*="[start_time]"]').value = '';
                            row.querySelector('input[name*="[end_time]"]').value = '';
                            row.querySelector('input[name*="[room_number]"]').value = '';
                        });

                        // Populate timetable data
                        data.forEach(item => {
                            const weekRow = [...weekInputs].find(row => {
                                return row.querySelector('input[name*="[week_id]"]').value == item.week_id;
                            });

                            if (weekRow) {
                                weekRow.querySelector('input[name*="[start_time]"]').value = item.start_time;
                                weekRow.querySelector('input[name*="[end_time]"]').value = item.end_time;
                                weekRow.querySelector('input[name*="[room_number]"]').value = item.room_number;
                            }
                        });
                    })
                    // .catch(error => {
                    //     console.error('Error fetching timetable:', error);
                    //     alert('Failed to load timetable data. Please try again.');
                    // });
            }

            classSelect.addEventListener('change', function () {
                const classId = this.value;
                const subjectId = subjectSelect.value;

                // Fetch subjects when class changes
                if (classId) {
                    fetchSubjects(classId);
                    weeksTableContainer.style.display = 'none';
                } else {
                    subjectSelect.innerHTML = '<option value="">Select Subject</option>';
                    weeksTableContainer.style.display = 'none';
                }

                // Reset timetable when class changes
                weekInputs.forEach(row => {
                    row.querySelector('input[name*="[start_time]"]').value = '';
                    row.querySelector('input[name*="[end_time]"]').value = '';
                    row.querySelector('input[name*="[room_number]"]').value = '';
                });
            });

            subjectSelect.addEventListener('change', function () {
                const classId = classSelect.value;
                const subjectId = this.value;

                // Fetch timetable when both class and subject are selected
                if (classId && subjectId) {
                    weeksTableContainer.style.display = 'block';
                    fetchTimetable(classId, subjectId);
                } else {
                    weeksTableContainer.style.display = 'none';
                }
            });
        });
    </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const classSelect = document.querySelector('select[name="class_id"]');
            const subjectSelect = document.querySelector('select[name="subject_id"]');
            const hiddenClassId = document.getElementById('hiddenClassId');
            const hiddenSubjectId = document.getElementById('hiddenSubjectId');

            // Update hidden inputs when class or subject is selected
            classSelect.addEventListener('change', function () {
            hiddenClassId.value = this.value; // Set the hidden input for class_id
        });

            subjectSelect.addEventListener('change', function () {
            hiddenSubjectId.value = this.value; // Set the hidden input for subject_id
        });

            // Initialize hidden inputs on page load if values are preselected
            if (classSelect.value) {
            hiddenClassId.value = classSelect.value;
        }
            if (subjectSelect.value) {
            hiddenSubjectId.value = subjectSelect.value;
        }
        });
    </script>
@endsection
