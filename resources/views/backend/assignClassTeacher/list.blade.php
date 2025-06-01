@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Assign Class Teacher</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Assign Class Teachers</h2>
    </div>
    <!-- END PAGE TITLE -->


    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">Search Assign Class Teacher</h3>
                    </div>
                    @include('_message')
                    <div class="panel-body">
                        <form method="GET" action="{{ url('panel/assign-class-teacher/list') }}">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Id</label>
                                    <input type="text" class="form-control" name="id" value="{{ request('id') }}" placeholder="ID">

                                </div>
                                <div class="col-md-2">
                                    <label>Teacher Name</label>
                                    <input type="text" class="form-control" name="teacher_name" value="{{ request('teacher_name') }}"
                                    placeholder="Teacher Name">
                                </div>

                                <div class="col-md-2">
                                    <label>Class Name</label>
                                    <input type="text" class="form-control" name="class_name" value="{{ request('class_name') }}"
                                        placeholder="Class Name">
                                </div>
                                
                                <div class="col-md-2">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Select</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="100" {{ request('status') == '100' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-12" style="margin-top: 25px;">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ url('panel/assign-class-teacher/list') }}" class="btn btn-success">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">Assign Class Teacher List</h3>
                        <a class="btn btn-primary pull-right" href="{{ url('panel/assign-class-teacher/create') }}">Assign Class Teacher</a>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class Name</th>
                                        <th>Teacher Name</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($getteacher) && $getteacher->count())
                                        @foreach ($getteacher as $value)
                                            <tr>
                                                <td class="text-center">{{ $value->id }}</td>
                                                <td><strong>{{ $value->class_name }}</strong></td>
                                                <td>{{ $value->teacher_name }} {{ $value->teacher_last_name }}</td>
                                                <td>
                                                    @if ($value->status == 1)
                                                        <span class="label label-success">Active</span>
                                                    @else
                                                        <span class="label label-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $value->created_at->format('d M, Y h:i A') }}</td>
                                                <td class="text-center">
                                                    <a href="{{ url('panel/assign-class-teacher/edit/' . $value->id) }}"
                                                        class="btn btn-default btn-rounded btn-sm">
                                                        <span class="fa fa-pencil"></span>
                                                    </a>
                                                    <a href="{{ url('panel/assign-class-teacher/delete/' . $value->id) }}"
                                                        class="btn btn-danger btn-rounded btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this assign-class-teacher?');">
                                                        <span class="fa fa-times"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">No Class Teacher found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            
                            @if (!empty($getteacher))
                                <div class="text-center">
                                    {{ $getteacher->links() }}
                                </div>
                            @endif
                            


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
