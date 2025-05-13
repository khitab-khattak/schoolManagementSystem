@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Parents</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span> Parents My Student</h2>
    </div>
    <!-- END PAGE TITLE -->


    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">Parents My Student Search</h3>
                    </div>
                    @include('_message')
                    <div class="panel-body">
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>ID</label>
                                    <input type="text" class="form-control" name="id" value="{{ request('id') }}"
                                        placeholder="ID">
                                </div>
                                <div class="col-md-2">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ request('name') }}"
                                        placeholder="First Name">
                                </div>
                                <div class="col-md-2">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="last_name"
                                        value="{{ request('last_name') }}" placeholder="Last Name">
                                </div>
                                <div class="col-md-2">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ request('email') }}"
                                        placeholder="Email">
                                </div>
                                <div class="col-md-12" style="margin-top: 25px;">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ url('panel/parents/my_student/'.$parent_id) }}" class="btn btn-success">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="panel panel-default">
                    @if (Auth::user()->is_admin == 3 || Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                        <div class="panel-heading flex justify-between">
                            <h3 class="panel-title">Search Student List</h3>
                        </div>
                    @endif


                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Parent Name</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('last_name')) || !empty(Request::get('email')))
                                        @if(count($getMyStudent) > 0)
                                            @foreach ($getMyStudent as $value)
                                                <tr>
                                                    <td class="text-center">{{ $value->id }}</td>
                                                    <td>
                                                        @if (!empty($value->profile_pic))
                                                            <img src="{{ asset('upload/profile/' . $value->profile_pic) }}" width="50" height="50" style="border-radius: 50%;">
                                                        @endif
                                                    </td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->last_name }}</td>
                                                    <td>{{ $value->email }}</td>
                                                    <td>{{ $value->gender == 1 ? 'Male' : 'Female' }}</td>
                                                    <td>
                                                        @if ($value->getParentData)
                                                            {{ $value->getParentData->name }} {{ $value->getParentData->last_name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $value->created_at->format('d M, Y h:i A') }}</td>
                                                    <td>
                                                        <a href="{{ url('panel/parents/add_student/' . $value->id.'/'.$parent_id) }}"
                                                           class="btn btn-primary btn-sm">
                                                            Add To Parent
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9" class="text-center">No Students Found</td>
                                            </tr>
                                        @endif
                                    @endif
                                </tbody>
                                


                            </table>


                        </div>


                    </div>
                </div>

                <div class="panel panel-default">
                    @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2 || Auth::user()->is_admin == 3)
                        <div class="panel-heading flex justify-between">
                            <h3 class="panel-title">Student List</h3>
                        </div>
                    @endif
                
                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Mobile</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($getRecord) > 0)
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td class="text-center">{{ $value->id }}</td>
                                                <td>
                                                    @if (!empty($value->profile_pic))
                                                        <img src="{{ asset('upload/profile/' . $value->profile_pic) }}" width="50" height="50" style="border-radius: 50%;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->last_name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->gender == 1 ? 'Male' : 'Female' }}</td>
                                                <td>{{ $value->mobile_number }}</td>
                                                <td>{{ $value->created_at->format('d M, Y h:i A') }}</td>
                                                <td>
                                                    <a href="{{ url('panel/parents/mystudent_delete/' . $value->id) }}" class="btn btn-danger btn-rounded btn-sm"
                                                       onclick="return confirm('Are you sure you want to delete this student?');">
                                                        <span class="fa fa-times"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">No Students Found</td>
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
