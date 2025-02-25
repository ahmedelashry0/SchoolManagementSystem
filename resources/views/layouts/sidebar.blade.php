<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link" style="text-align: center">
        <span class="brand-text " STYLE="font-size: 20PX; !important; font-weight: bold">School</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{  asset('storage/' . Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
{{--        <div class="form-inline">--}}
{{--            <div class="input-group" data-widget="sidebar-search">--}}
{{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-sidebar">--}}
{{--                        <i class="fas fa-search fa-fw"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(Auth::user()->user_type == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard')active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.profile') }}" class="nav-link @if(Request::segment(3) == 'profile')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                My Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.list') }}" class="nav-link @if(Request::segment(3) == 'list')active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Admins
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.teacher.list') }}" class="nav-link @if(Request::segment(3) == 'teacher')active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Teachers
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.student.list') }}" class="nav-link @if(Request::segment(3) == 'students')active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Students
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.parent.list') }}" class="nav-link @if(Request::segment(3) == 'parent')active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Parents
                            </p>
                        </a>
                    </li>
                    <li class="nav-item @if(in_array(Request::segment(3) , ['class' , 'subject', 'class-subject', 'class-teacher' , 'class-timetable'])) menu-is-opening menu-open @endif" >
                        <a href="#" class="nav-link @if(in_array(Request::segment(3) , ['class' , 'subject', 'class-subject', 'class-teacher' ,'class-timetable'])) active @endif">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Academics
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.class.list') }}" class="nav-link @if(Request::segment(3) == 'class')active @endif">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Class
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.subject.list') }}" class="nav-link @if(Request::segment(3) == 'subject')active @endif">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Subjects
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.class_subject.list') }}" class="nav-link @if(Request::segment(3) == 'class-subject')active @endif">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Assign Subjects
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.class_teacher.list') }}" class="nav-link @if(Request::segment(3) == 'class-teacher')active @endif">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Assign Class Teacher
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.class_timetable') }}" class="nav-link @if(Request::segment(3) == 'class-timetable')active @endif">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Class Timetable
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @if(in_array(Request::segment(3) , ['exam'])) menu-is-opening menu-open @endif" >
                        <a href="#" class="nav-link @if(in_array(Request::segment(3) , ['exam' ])) active @endif">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Examinations
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.exam.list') }}" class="nav-link @if(Request::segment(3) == 'exam')active @endif">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Exams
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.exam_schedule') }}" class="nav-link @if(Request::segment(3) == 'exam_schedule')active @endif">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Exam Schedule
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.change-password') }}" class="nav-link @if(Request::segment(3) == 'change-password')active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Change password
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->user_type == 'teacher')
                    <li class="nav-item">
                        <a href="{{ route('teacher.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard')active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.profile') }}" class="nav-link @if(Request::segment(2) == 'profile')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                My Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.my_classes') }}" class="nav-link @if(Request::segment(2) == 'my-classes')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                My Class-Subjects
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.my_exams') }}" class="nav-link @if(Request::segment(2) == 'my-exams')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                My Exams Timetable
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('teacher.my_students') }}" class="nav-link @if(Request::segment(2) == 'my-students')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                My Students
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('teacher.change-password') }}" class="nav-link @if(Request::segment(2) == 'change-password')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                Change password
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->user_type == 'student')
                    <li class="nav-item">
                        <a href="{{ route('student.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard')active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.profile') }}" class="nav-link @if(Request::segment(2) == 'profile')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                My Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.my_subjects') }}" class="nav-link @if(Request::segment(2) == 'my-subjects')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                My Subjects
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.my_timetable') }}" class="nav-link @if(Request::segment(2) == 'my-timetable')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                My Time table
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.my_exams') }}" class="nav-link @if(Request::segment(2) == 'my-exams')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                My Exams
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('student.my_calendar') }}" class="nav-link @if(Request::segment(2) == 'my-exams')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                My Calendar
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->user_type == 'parent')
                    <li class="nav-item">
                        <a href="{{ route('parent.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard')active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('parent.profile') }}" class="nav-link @if(Request::segment(2) == 'profile')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                My Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('parent.my_students') }}" class="nav-link @if(Request::segment(2) == 'my_students')active @endif">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                My Students
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link ">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
