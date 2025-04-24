@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">School Admin</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>School Admin</h2>
    </div>
    <!-- END PAGE TITLE -->


    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">Search School Admin</h3>
                    </div>
                    @include('_message')
                    <div class="panel-body">
                        <form method="GET" action="{{ url('panel/school_admin/list') }}">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Id</label>
                                    <input type="text" class="form-control" name="id" value="{{ request('id') }}"
                                        placeholder="ID">
                                </div>
                                <div class="col-md-2">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ request('name') }}"
                                        placeholder="Name">
                                </div>
                                <div class="col-md-2">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ request('email') }}"
                                        placeholder="Email">
                                </div>
                                <div class="col-md-2">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ request('address') }}" placeholder="Address">
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
                                    <a href="{{ url('panel/school_admin/list') }}" class="btn btn-success">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">school_admin List</h3>
                        <a class="btn btn-primary pull-right" href="{{ url('panel/school_admin/create') }}">Create school_admin</a>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                                        <th>School Name</th>
                                    @endif
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($getschool_admin) && $getschool_admin->count())
                                        @foreach ($getschool_admin as $value)
                                            <tr id="trow_1">
                                                <td class="text-center">{{ $value->id }}</td>
                                                @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                                                <td>
                                                    @if (!empty($value->getCreatedBy))
                                                        {{ $value->getCreatedBy->name }}
                                                    @endif
                                                </td>
                                            @endif
                                                <td>
                                                    @if (!empty($value->profile_pic))
                                                        <img src="{{ asset('upload/profile/' . $value->profile_pic) }}"
                                                            width="50" height="50" style="border-radius: 50%;">
                                                    @endif
                                                </td>
                                                <td><strong>{{ $value->name }}</strong></td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->address }}</td>

                                                
                                                
                                                <td>
                                                 @if ($value->status == 1)
                                                 <span class="label label-success">Active</span>
                                                 @else
                                                 <span class="label label-danger">Inactive</span>
                                                 @endif
                                                </td>
                                                
                                                <td>{{ $value->created_at->format('d M, Y h:i A') }}</td>
                                                <td>
                                                    <a href="{{ url('panel/school_admin/edit/' . $value->id) }}"
                                                        class="btn btn-default btn-rounded btn-sm"><span
                                                            class="fa fa-pencil"></span></a>
                                                    <a href="{{ url('panel/school_admin/delete/' . $value->id) }}"
                                                        class="btn btn-danger btn-rounded btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this school_admin?');">
                                                        <span class="fa fa-times"></span>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">No school_admins found.</td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>


                        </div>


                    </div>
                </div>
                <div class="pull-right">
                    {{ $getschool_admin->appends(request()->except('page'))->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/demo_tables.js') }}"></script>
@endsection
