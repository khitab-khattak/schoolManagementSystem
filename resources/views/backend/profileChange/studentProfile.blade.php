@extends('backend.layouts.app')

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Student My Account</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-lock"></span> Student My Account</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="POST" action="{{ url('student/my-account/' . $getRecordAll->id) }}" enctype="multipart/form-data" class="form-horizontal">

                            @csrf

                            @include('_message')
                          
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">First Name<span class="text-red-500">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input name="name" value="{{ old('name',$getRecordAll->name)  }}"type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Last Name<span class="text-red-500">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input name="last_name" value="{{ old('last_name',$getRecordAll->last_name)  }}"type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                      

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Profile Pic</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input name="profile_pic" type="file" class=" form-control  fileinput btn-primary" name="filename" id="filename" title="Browse file"/>
                                        @if (!empty($getRecordAll->profile_pic))
                                        <img src="{{ asset('upload/profile/' . $getRecordAll->profile_pic) }}"
                                            width="50" height="50" style="border-radius: 50%;">
                                    @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="panel-footer text-center">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
