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
        <h2><span class="fa fa-arrow-circle-o-left"></span> Parents</h2>
    </div>
    <!-- END PAGE TITLE -->


    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading flex justify-between">
                        <h3 class="panel-title">Search Parent</h3>
                    </div>
                    @include('_message')
                    <div class="panel-body">
                        <form method="GET" action="{{ url('panel/parents/list') }}">
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
                                <div class="col-md-2">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="">Select</option>
                                        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>

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
                                    <a href="{{ url('panel/parents/list') }}" class="btn btn-success">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="panel panel-default">
                    @if (Auth::user()->is_admin == 3 || Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                        <div class="panel-heading flex justify-between">
                            <h3 class="panel-title">Parents List</h3>
                            <a class="btn btn-primary pull-right" href="{{ url('panel/parents/create') }}">Create
                                Parent</a>
                        </div>
                    @endif


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
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Gender</th>
                                        <th>Occupation</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>
                                        @if (!empty($getparents) && $getparents->count())
                                        @foreach ($getparents as $value)
                                            <tr>
                                                <td class="text-center">{{ $value->id }}</td>
                                                @if (Auth::user()->is_admin == 1||Auth::user()->is_admin == 2)
                                                <td>{{ $value->getCreatedBy->name ?? '' }}</td>
                                            @endif
                                                <td>
                                                    
                                        @if (!empty($value->profile_pic))
                                            <img src="{{ asset('upload/profile/' . $value->profile_pic) }}" width="50"
                                                height="50" style="border-radius: 50%;">
                                        @endif
                                    </td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->last_name }}</td>
                                    <td>{{ $value->gender == 1 ? 'Male' : 'Female' }}</td>
                                    <td>{{ $value->occupation }}</td>
                                    <td>{{ $value->mobile }}</td>
                                    <td>{{ $value->address }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>
                                        @if ($value->status == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->created_at->format('d M, Y h:i A') }}</td>
                                    <td>
                                        <a href="{{ url('panel/parents/edit/' . $value->id) }}"
                                            class="btn btn-default btn-rounded btn-sm">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                        <a href="{{ url('panel/parents/delete/' . $value->id) }}"
                                            class="btn btn-danger btn-rounded btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this parents?');">
                                            <span class="fa fa-times"></span>
                                        </a>
                                        <a href="{{ url('panel/parents/my_student/' . $value->id) }}"
                                            class="btn btn-primary  btn-sm"
                                           >
                                            My students</span>
                                        </a>
                                    </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="18">No parentss found.</td>
                                    </tr>
                                    @endif
                                </tbody>


                            </table>


                        </div>


                    </div>
                </div>
                <div class="pull-right">
                    {{ $getparents->appends(request()->except('page'))->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/demo_tables.js') }}"></script>
@endsection
