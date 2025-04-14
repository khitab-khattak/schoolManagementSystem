@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">School</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span> School</h2>
    </div>
    <!-- END PAGE TITLE -->


    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">Search School</h3>
                    </div>
                    @include('_message')
                    <div class="panel-body">
                        <form method="GET" action="{{ url('panel/school/list') }}">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Id</label>
                                    <input type="text" class="form-control" name="id" value="{{ request('id') }}"
                                        placeholder="ID">
                                </div>
                                <div class="col-md-2">
                                    <label>School Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ request('name') }}"
                                        placeholder="School Name">
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
                                    <a href="{{ url('panel/school/list') }}" class="btn btn-success">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">School List</h3>
                        <a class="btn btn-primary pull-right" href="{{ url('panel/school/create') }}">Create School</a>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile</th>
                                        <th>School Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($getSchool) && $getSchool->count())
                                        @foreach ($getSchool as $value)
                                            <tr id="trow_1">
                                                <td class="text-center">{{ $value->id }}</td>
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
                                                    <span
                                                        class="label {{ $value->status == 1 ? 'label-success' : 'label-danger' }}">
                                                        {{ $value->status == 1 ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>{{ $value->created_at->format('d M, Y h:i A') }}</td>
                                                <td>
                                                    <a href="{{ url('panel/school/edit/' . $value->id) }}"
                                                        class="btn btn-default btn-rounded btn-sm"><span
                                                            class="fa fa-pencil"></span></a>
                                                    <a href="{{ url('panel/school/delete/' . $value->id) }}"
                                                        class="btn btn-danger btn-rounded btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this school?');">
                                                        <span class="fa fa-times"></span>
                                                    </a>

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
                    {{ $getSchool->appends(request()->except('page'))->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/demo_tables.js') }}"></script>
@endsection
