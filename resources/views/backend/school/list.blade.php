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
                @include('_message')
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
                                    @foreach ($getSchool as $school)
                                        <tr id="trow_1">
                                            <td class="text-center">{{ $school->id }}</td>
                                            <td>
                                                <img src="{{ asset('upload/profile/' . $school->profile_pic) }}" width="50" height="50" style="border-radius: 50%;">
                                            </td>
                                            <td><strong>{{ $school->name }}</strong></td>
                                            <td>{{ $school->email }}</td>
                                            <td>{{ $school->address }}</td>
                                            <td>
                                                <span
                                                    class="label {{ $school->status == 1 ? 'label-success' : 'label-danger' }}">
                                                    {{ $school->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>{{ $school->created_at->format('d M, Y h:i A') }}</td>
                                            <td>
                                                <button class="btn btn-default btn-rounded btn-sm"><span
                                                        class="fa fa-pencil"></span></button>
                                                <button class="btn btn-danger btn-rounded btn-sm"
                                                    onClick="delete_row('trow_1');"><span
                                                        class="fa fa-times"></span></button>
                                            </td>
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
