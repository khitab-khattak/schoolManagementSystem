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
                <div class="profile-image" style="display: flex; justify-content: center;">
                    <img src="{{ asset('assets/images/users/avatar.jpg') }}" alt="User"
                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 2px solid #fff;" />
                </div>
                <div class="profile-data" style="margin-top: 10px;">
                    <div class="profile-data-name" style="font-weight: bold;">John Doe</div>
                    <div class="profile-data-title" style="font-size: 12px; color: #999;">Web Developer/Designer</div>
                </div>
                <div class="profile-controls" style="margin-top: 10px;">
                    <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>
        </li>

        <!-- Dashboard Link -->
        <li class="{{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
            <a href="/panel/dashboard">
                <span class="fa fa-desktop"></span>
                <span class="xn-text">Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
            <li class="{{ Request::segment(2) == 'admin' ? 'active' : '' }}">
                <a href="/panel/admin/list">
                    <span class="fa fa-user"></span>
                    <span class="xn-text">Admin</span>
                </a>
            </li>

            <!-- School Link -->
            <li class="{{ Request::segment(2) == 'school' ? 'active' : '' }}">
                <a href="{{ url('panel/school/list') }}">
                    <span class="fas fa-school"></span>
                    <span class="xn-text" style="margin-left:15px;">School</span>
                </a>
            </li>
        @endif
       @if (Auth::user()->is_admin==3)
       <li class="{{ Request::segment(2) == 'teacher' ? 'active' : '' }}">
        <a href="{{ url('panel/teacher') }}">
            <span class="fas fa-user"></span>
            <span class="xn-text" style="margin-left:15px;">Teacher</span>
        </a>
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
