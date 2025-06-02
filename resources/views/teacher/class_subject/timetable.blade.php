@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">My Class & Subject Timetabel</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span> My Class & Subject Timetable</h2>
    </div>
    <!-- END PAGE TITLE -->


    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">My Class & Subject Timetabel</h3>
                    </div>
                    @include('_message')
                    

               
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title"><b>{{$getClass->name}}</b>-<b>{{$getSubject->name}}</b></h3>
                       
                    </div>
                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                       
                                        <th>Week Name</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Room Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($getRecord as $value)
                                    <tr id="trow_1">
                                        <td>{{ $value['week_name'] }}</td>
                                        <td>
                                            {{ !empty($value['start_time']) ? \Carbon\Carbon::parse($value['start_time'])->format('h:i A') : '' }}
                                        </td>
                                        <td>
                                            {{ !empty($value['end_time']) ? \Carbon\Carbon::parse($value['end_time'])->format('h:i A') : '' }}
                                        </td>
                                        <td>{{ $value['room_number'] }}</td>
                                    </tr>
                                @endforeach
                                
                                  
                                </tbody>

                            </table>


                        </div>


                    </div>
                </div>
              
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/demo_tables.js') }}"></script>
@endsection
