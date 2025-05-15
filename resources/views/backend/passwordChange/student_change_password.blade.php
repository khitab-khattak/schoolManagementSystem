@extends('backend.layouts.app')

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Change Password</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-lock"></span> Change Password</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="POST" action="{{ url('student/change-password') }}" class="form-horizontal">
                            @csrf

                            @include('_message')

                            <!-- Current Password -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Current Password <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" name="old_password" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">New Password <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" name="new_password" class="form-control" required />
                                    </div>
                                    @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            <!-- Confirm New Password -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Confirm Password <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" name="new_password_confirmation" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="panel-footer text-center">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
