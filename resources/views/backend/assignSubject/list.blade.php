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
        <h2><span class="fa fa-arrow-circle-o-left"></span>Assign Subject Classs</h2>
    </div>
    <!-- END PAGE TITLE -->


    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">Search Assign Subject Class</h3>
                    </div>
                    @include('_message')
                    <div class="panel-body">
                        <form method="GET" action="{{ url('panel/assign-subject/list') }}">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Id</label>
                                    <input type="text" class="form-control" name="id" value="{{ request('id') }}" placeholder="ID">

                                </div>
                                <div class="col-md-2">
                                    <label>Subject Name</label>
                                    <input type="text" class="form-control" name="subject_name" value="{{ request('subject_name') }}"
                                    placeholder="Subject Name">
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
                                    <a href="{{ url('panel/assign-subject/list') }}" class="btn btn-success">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">Assign Subject Class List</h3>
                        <a class="btn btn-primary pull-right" href="{{ url('panel/assign-subject/create') }}">Assign Subject Class</a>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        {{-- <th>Created By</th> --}}
                                        <th>Class Name</th>
                                        <th>Subject Name</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($getsubject) && $getsubject->count())
                                        @foreach ($getsubject as $value)
                                            <tr id="trow_1">
                                                <td class="text-center">{{ $value->id }}</td>
                                                {{-- <td class="text-center">{{ $value->getCreatedBy->name }}</td> --}}
                                                <td><strong>{{ $value->class_name }}</strong></td>
                                                <td>{{ $value->subject_name }}</strong></td>
                                                <td>
                                                 @if ($value->status == 1)
                                                 <span class="label label-success">Active</span>
                                                 @else
                                                 <span class="label label-danger">Inactive</span>
                                                 @endif
                                                </td>
                                                
                                                <td>{{ $value->created_at->format('d M, Y h:i A') }}</td>
                                                <td>
                                                    <a href="{{ url('panel/assign-subject/edit/' . $value->id) }}"
                                                        class="btn btn-default btn-rounded btn-sm"><span
                                                            class="fa fa-pencil"></span></a>
                                                            <a href="{{ url('panel/single-assign-subject/edit/' . $value->id) }}"
                                                                class="btn btn-primary  btn-sm">Edit Single</a>
                                                    <a href="{{ url('panel/assign-subject/delete/' . $value->id) }}"
                                                        class="btn btn-danger btn-rounded btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this assign-subject?');">
                                                        <span class="fa fa-times"></span>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">No Assign Subject Class found.</td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>


                        </div>


                    </div>
                </div>
                <div class="pull-right">
                    {{ $getsubject->appends(request()->except('page'))->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/demo_tables.js') }}"></script>
@endsection
