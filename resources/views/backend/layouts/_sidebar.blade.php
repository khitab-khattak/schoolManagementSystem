<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li style="background: #e34724; font-weight: bold; text-align: center;">
            <a href="/panel/dashboard" style="color: white; text-decoration: none; font-size: 20px;">SCHOOL</a>
            <a href="#" class="x-navigation-control"></a>
        </li>

        <li class="xn-profile">
            <div class="profile">
                <div class="profile-image">
                    <img src="{{ asset('assets/images/users/avatar.jpg') }}" alt="John Doe" />

                </div>
                <div class="profile-data">
                    <div class="profile-data-name">John Doe</div>
                    <div class="profile-data-title">Web Developer/Designer</div>
                </div>
                <div class="profile-controls">
                    <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>
        </li>

        <li class="{{ (Request::segment(2)=='dashboard')?'active':''}}">
            <a href="/panel/dashboard"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
        </li>
        <li class="{{ (Request::segment(2)=='school')?'active':''}}">
            <a href="/panel/school" ><span class="fas fa-school"></span> <span style="margin-left:15px" class="xn-text">School</span></a>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Layouts</span></a>
            <ul>
                <li><a href="layout-boxed.html">Add</a></li>
                <li><a href="layout-nav-toggled.html">List</a></li>
            </ul>
        </li>
    </ul>
    <!-- END X-NAVIGATION -->
</div>
