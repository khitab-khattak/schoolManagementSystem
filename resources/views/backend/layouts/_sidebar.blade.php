<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <!-- Header -->
        <li style="background: #e34724; font-weight: bold; text-align: center;">
            <a href="/panel/dashboard" style="color: white; text-decoration: none; font-size: 20px;">SCHOOL</a>
            <a href="#" class="x-navigation-control"></a>
        </li>

        <!-- Profile Section -->
        <li class="xn-profile">
            <div class="profile" style="text-align: center; padding: 20px 0;">
                @php
                    $user = null;

                    foreach (['web', 'teacher', 'student', 'parent'] as $guard) {
                        if (Auth::guard($guard)->check()) {
                            $user = Auth::guard($guard)->user();
                            break;
                        }
                    }

                    $profilePic =
                        $user && $user->profile_pic
                            ? asset('upload/profile/' . $user->profile_pic)
                            : asset('assets/images/users/avatar.jpg');

                    $userFullName = $user ? trim($user->name . ' ' . $user->last_name) : 'Guest';
                @endphp

                <div class="profile" style="text-align: center; padding: 20px 0;">
                    <div class="profile-image" style="display: flex; justify-content: center;">
                        <img src="{{ $profilePic }}" alt="User"
                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 2px solid #fff;" />
                    </div>

                    <div class="profile-data" style="margin-top: 10px;">
                        <div class="profile-data-name" style="font-weight: bold;">{{ $userFullName }}</div>
                    </div>
                </div>

                <div class="profile-controls" style="margin-top: 10px;">
                    <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>
        </li>

        <!-- Dashboard Link -->
        @php
            $currentGuard = null;
            foreach (['web', 'teacher', 'student', 'parent'] as $guard) {
                if (Auth::guard($guard)->check()) {
                    $currentGuard = $guard;
                    break;
                }
            }
        @endphp

        @if ($currentGuard == 'student')
            {{-- Student-specific sidebar --}}
            <li>
                <a href="{{ url('/student/dashboard') }}">
                    <span class="fa fa-user"></span> Dashboard
                </a>
            </li>
            <li class="{{ Request::segment(2) == 'change-password' ? 'active' : '' }}">
                <a href="{{ url('student/change-password') }}"><span class="fa fa-key"></span> Change Password</a>
            </li>
            <li class="{{ Request::segment(2) == 'my-account' ? 'active' : '' }}">
                <a href="{{ url('student/my-account') }}"><span class="fa fa-user"></span> My Account</a>
            </li>
        @elseif ($currentGuard == 'teacher')
            {{-- Teacher-specific sidebar --}}
            <li>
                <a href="{{ url('/teacher/dashboard') }}">
                    <span class="fa fa-chalkboard-teacher"></span> Dashboard
                </a>
            </li>
            <li class="{{ Request::segment(2) == 'change-password' ? 'active' : '' }}">
                <a href="{{ url('teacher/change-password') }}"><span class="fa fa-key"></span> Change Password</a>
            </li>
            <li class="{{ Request::segment(2) == 'my-account' ? 'active' : '' }}">
                <a href="{{ url('teacher/my-account') }}"><span class="fa fa-user"></span> My Account</a>
            </li>
        @elseif ($currentGuard == 'parent')
            {{-- Parent-specific sidebar --}}
            <li>
                <a href="{{ url('/parent/dashboard') }}">
                    <span class="fa fa-users"></span> Dashboard
                </a>
            </li>
            <li class="{{ Request::segment(2) == 'change-password' ? 'active' : '' }}">
                <a href="{{ url('parent/change-password') }}"><span class="fa fa-key"></span> Change Password</a>
            </li>
            <li class="{{ Request::segment(2) == 'my-account' ? 'active' : '' }}">
                <a href="{{ url('parent/my-account') }}"><span class="fa fa-user"></span> My Account</a>
            </li>
            {{-- Add more parent-specific links here --}}
        @endif
        {{-- Web/admin-specific sidebar --}}
        @if ($currentGuard == 'web')
            <li>
                <a href="{{ url('/panel/dashboard') }}">
                    <span class="fa fa-tachometer-alt"></span> Dashboard
                </a>
            </li>
            <li class="{{ Request::segment(2) == 'my-account' ? 'active' : '' }}">
                <a href="{{ url('panel/my-account') }}"><span class="fa fa-user"></span> My Account</a>
            </li>
        @endif

     












        @if (Auth::guard('web')->check() &&
                (Auth::guard('web')->user()->is_admin == 1 || Auth::guard('web')->user()->is_admin == 2))
            <li class="{{ Request::segment(2) == 'admin' ? 'active' : '' }}">
                <a href="/panel/admin/list">
                    <span class="fa fa-user"></span>
                    <span class="xn-text">Admin</span>
                </a>
            </li>

            <!-- School Link -->
            <li class="{{ Request::segment(2) == 'school' ? 'active' : '' }}">
                <a href="{{ url('panel/school/list') }}">
                    <span class="fa fa-school"></span>
                    <span class="xn-text">School</span>
                </a>
            </li>
        @endif

        @if (Auth::check() && (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2))
            <li class="{{ Request::segment(2) == 'school_admin' ? 'active' : '' }}">
                <a href="{{ url('/panel/school_admin/list') }}">
                    <span class="fa fa-user"></span>
                    <span class="xn-text">School Admin</span>
                </a>
            </li>
            <li class="{{ Request::segment(2) == 'teacher' ? 'active' : '' }}">
                <a href="{{ url('/panel/teacher/list') }}">
                    <span class="fa fa-user"></span>
                    <span class="xn-text">Teachers</span>
                </a>
            </li>
            <li class="{{ Request::segment(2) == 'student' ? 'active' : '' }}">
                <a href="{{ url('/panel/student/list') }}">
                    <span class="fa fa-user"></span>
                    <span class="xn-text">Students</span>
                </a>
            </li>
            <li class="{{ Request::segment(2) == 'parents' ? 'active' : '' }}">
                <a href="{{ url('/panel/parents/list') }}">
                    <span class="fa fa-user"></span>
                    <span class="xn-text">Parents</span>
                </a>
            </li>
        @endif

        @if (Auth::check() && Auth::guard('web')->user()->is_admin == 3)
            <!-- Layouts Dropdown -->
            <li
                class="xn-openable {{ in_array(Request::segment(2), ['class', 'subject', 'student', 'parents']) ? 'active' : '' }}">
                <a href="#">
                    <span class="fa fa-graduation-cap"></span>
                    <span class="xn-text">Academics</span>
                </a>
                <ul>
                    <li class="{{ Request::segment(2) == 'class' ? 'active' : '' }}">
                        <a href="{{ url('panel/class/list') }}"><span class="fa fa-users"></span> Class</a>
                    </li>
                    <li class="{{ Request::segment(2) == 'subject' ? 'active' : '' }}">
                        <a href="{{ url('panel/subject/list') }}"><span class="fa fa-book"></span> Subjects</a>
                    </li>
                    <li class="{{ Request::segment(2) == 'student' ? 'active' : '' }}">
                        <a href="{{ url('panel/student/list') }}"><span class="fa fa-book"></span> Students</a>
                    </li>
                    <li class="{{ Request::segment(2) == 'parents' ? 'active' : '' }}">
                        <a href="{{ url('panel/parents/list') }}"><span class="fa fa-book"></span> Parents</a>
                    </li>
                </ul>
            </li>
        @endif

        @if ($currentGuard == 'web')
            <li class="{{ Request::segment(2) == 'change-password' ? 'active' : '' }}">
                <a href="{{ url('panel/change-password') }}"><span class="fa fa-key"></span> Change Password</a>
            </li>
        @endif


        <!-- Layouts Dropdown -->
        <li class="xn-openable">
            <a href="#">
                <span class="fa fa-file-text-o"></span>
                <span class="xn-text">Layouts</span>
            </a>
            <ul>
                <li><a href="layout-boxed.html">Add</a></li>
                <li><a href="layout-nav-toggled.html">List</a></li>
            </ul>
        </li>
    </ul>
    <!-- END X-NAVIGATION -->
</div>
