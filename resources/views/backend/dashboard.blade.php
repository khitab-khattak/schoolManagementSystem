    @extends('backend.layouts.app')           
    @section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Dashboards</li>
    </ul>
    <!-- END BREADCRUMB -->
    
    <!-- PAGE TITLE -->
    <div class="page-title">                    
        <h2><span class="fa fa-arrow-circle-o-left"></span> Dashboards</h2>
    </div>
    <!-- END PAGE TITLE -->                
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
    

        <!-- END RESPONSIVE TABLES -->
        
    <!-- END PAGE CONTENT WRAPPER -->                                    
    </div>         
@endsection
@section('script')
<script src="{{ asset('js/demo_tables.js') }}"></script>
@endsection