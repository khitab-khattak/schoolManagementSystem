<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>{{ !empty($meta_title) ? $meta_title . ' - School' : 'School' }}</title>
         
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        
        <!-- Favicon (icon) -->
        <link rel="icon" href="{{ asset('assets/images/icon/favicon.ico') }}" type="image/x-icon" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('css/theme-default.css') }}" />
        <!-- EOF CSS INCLUDE -->                                       
    </head>
    
    
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
           
            <!-- END PAGE SIDEBAR -->
            @include('backend/layouts/_sidebar')
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                @include('backend/layouts._header')
                @yield('content')
                <!-- END X-NAVIGATION VERTICAL -->  
            </div>         
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->    

        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="/logout" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
        
       

        <audio id="audio-alert" src="{{ asset('audio/alert.mp3') }}" preload="auto"></audio>
        <audio id="audio-fail" src="{{ asset('audio/fail.mp3') }}" preload="auto"></audio>                             

        <script src="{{ asset('js/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/plugins/jquery/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/plugins/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/plugins/icheck/icheck.min.js') }}"></script>
        <script src="{{ asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>
        {{-- <script src="{{ asset('js/settings.js') }}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/actions.js') }}"></script>
        @yield('script')
    </body>
</html>