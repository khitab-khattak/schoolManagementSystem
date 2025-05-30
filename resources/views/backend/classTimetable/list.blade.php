@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Assign Subject Class</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Class Timetable</h2>
    </div>
    <!-- END PAGE TITLE -->


    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">Search Class Timetable</h3>
                    </div>
                    @include('_message')
                    <div class="panel-body">
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Class Name</label>
                                    <select required class="form-control getClassChange" name="class_id">
                                        <option value="">Select</option>
                                        @foreach ($getClass as $class)
                                            <option {{ Request::get('class_id') == $class->id ? 'selected' : '' }}
                                                value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label>Subject Name</label>
                                    <select required class="form-control getSubject" name="subject_id">
                                        <option value="">Select</option>
                                        @if (!empty($getSubject))
                                            @foreach ($getSubject as $subject)
                                                <option
                                                    {{ Request::get('subject_id') == $subject->subject_id ? 'selected' : '' }}
                                                    value="{{ $subject->subject_id }}">
                                                    {{ $subject->subject_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="classMessage" style="margin-top:5px; color:red;"></div>
                                </div>





                                <div class="col-md-12" style="margin-top: 25px;">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ url('panel/class-timetable/list') }}" class="btn btn-success">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="panel panel-default">

                    <div class="panel-body panel-body-table">

                        <form method="POST" action="" enctype="multipart/form-data"
                        class="form-horizontal">

                        @csrf
                        <input type="hidden" name="subject_id" value="{{ Request::get('subject_id')}}" id="">
                        <input type="hidden" name="class_id" value="{{ Request::get('class_id')}}" id="">
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
                                        <tr>
                                            <td>{{ $value['week_name'] }}</td>
                                            
                                            <td>
                                                <input type="hidden"
                                                value="{{ $value['id'] }}" class="form-control" name="timetable[{{ $value['id'] }}][week_id]">

                                                <input type="time" value="{{$value['start_time']}}" class="form-control" name="timetable[{{ $value['id'] }}][start_time]">
                                            </td>
                                            <td>
                                                <input type="time" value="{{$value['end_time']}}" class="form-control" name="timetable[{{ $value['id'] }}][end_time]">
                                            </td>
                                            <td>
                                                <input type="text" value="{{$value['room_number']}}" class="form-control" name="timetable[{{ $value['id'] }}][room_number]">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (Request::get('subject_id')&& Request::get('class_id'))
                            <div class="mt-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> 
                            @endif
                            
                        </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('body').delegate('.getClassChange', 'change', function() {
            var class_id = $(this).val();
            var subject_id = "{{ Request::get('subject_id') ?? '' }}"; // retain selected subject

            $.ajax({
                url: "{{ url('panel/get-assign-subject-class') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    class_id: class_id,
                    selected_subject_id: subject_id
                },
                dataType: "json",
                success: function(response) {
                    $('.getSubject').html(response.success);
                    $('.classMessage').html(response.message || '');
                    $('.getSubject').prop('disabled', false);
                },
                error: function() {
                    alert('An error occurred while fetching subjects.');
                }
            });
        });
    </script>
@endsection
