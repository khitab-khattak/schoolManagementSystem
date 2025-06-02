@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">My Class & Subject</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span> My Class & Subject</h2>
    </div>
    <!-- END PAGE TITLE -->


    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">Search My Classs & Subject</h3>
                    </div>
                    @include('_message')
                    <div class="panel-body">
                        <form method="GET" action="{{ url('teacher/my-class-subject') }}">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Class Name</label>
                                    <input type="text" class="form-control" name="class_name"
                                        value="{{ request('class_name') }}" placeholder="Class Name">
                                </div>
                                <div class="col-md-2">
                                    <label>Subject Name</label>
                                    <input type="text" class="form-control" name="subject_name"
                                        value="{{ request('subject_name') }}" placeholder="Subject Name">
                                </div>

                                <div class="col-md-12" style="margin-top: 25px;">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ url('teacher/my-class-subject') }}" class="btn btn-success">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="panel panel-default">
                    


                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class Name</th>
                                        <th>Subject Name</th>
                                        <th>Subject Type</th>
                                        <th>My Class Timetabel</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($getRecord) && $getRecord->count())
                                        @foreach ($getRecord as $value)
                                            <tr id="trow_1">
                                                <td class="text-center">{{ $value->id }}</td>
                                                <td class="text-center">{{ $value->class_name }}</td>
                                                <td class="text-center">{{ $value->subject_name }}</td>
                                                <td class="text-center">{{ $value->subject_type }}</td>
                                                <td>
                                                    @php
                                                        $getClassTimetable = App\Models\ClassTimetable::getRecordA($value->class_id, $value->subject_id, date('l'));
                                                    @endphp
                                                
                                                    @if($getClassTimetable)
                                                        {{ date('h:i A', strtotime($getClassTimetable->start_time)) }} to {{ date('h:i A', strtotime($getClassTimetable->end_time)) }}
                                                    @else
                                                    Not Scheduled
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $value->created_at->format('d M, Y h:i A') }}</td>
                                                <td>
                                                    <a href="{{ url('teacher/my-class-subject/timetable/' . $value->class_id.'/'.$value->subject_id) }}"
                                                        class="btn btn-primary btn-sm">Class Timetabel</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">No schools found.</td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>


                        </div>


                    </div>
                </div>
                <div class="pull-right">
                    {{ $getRecord->appends(request()->except('page'))->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/demo_tables.js') }}"></script>
@endsection
