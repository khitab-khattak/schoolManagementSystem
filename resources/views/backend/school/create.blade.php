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
        <h2><span class="fa fa-arrow-circle-o-left"></span>Create School</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="page-content-wrap">

                        <div class="row">
                            <div class="col-md-12">

                                <form class="form-horizontal">
                                    <div class="panel panel-default">

                                        <div class="panel-body">

                                            <!-- School Name -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">School Name</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Profile Pic -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Profile Pic</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <input type="file" class=" form-control p-2 fileinput btn-primary" name="filename" id="filename" title="Browse file"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Email</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Password -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Password</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                                        <input type="password" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Address</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <textarea class="form-control"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Center Submit Button -->
                                        <div class="panel-footer d-flex justify-content-center">
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
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
