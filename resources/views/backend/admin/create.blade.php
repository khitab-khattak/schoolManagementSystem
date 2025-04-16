@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Admin</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Create Admin</h2>
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

                                <form method="POST" action="{{ url('panel/admin/create') }}" enctype="multipart/form-data"
                                    class="form-horizontal">

                                    @csrf
                                    <div class="panel panel-default">

                                        <div class="panel-body">
                                            @include('_message')

                                            <!-- admin Name -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Name <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span
                                                                class="fa fa-pencil"></span></span>
                                                        <input name="name" value="{{ old('name') }}"type="text"
                                                            class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Profile Pic -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Profile Pic</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <input name="profile_pic" type="file"
                                                            class=" form-control  fileinput btn-primary" name="filename"
                                                            id="filename" title="Browse file" />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Email<span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span
                                                                class="fa fa-pencil"></span></span>
                                                        <input name="email" value="{{ old('email') }}" type="text"
                                                            class="form-control" required />
                                                    </div>
                                                    <div class="text-red-600">{{ $errors->first('email') }}</div>
                                                </div>
                                            </div>

                                            <!-- Password -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Password<span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span
                                                                class="fa fa-unlock-alt"></span></span>
                                                        <input name="password" type="password" class="form-control"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Address<span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Status<span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control" name="status" id="">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Role<span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control" name="is_admin" id="">
                                                        <option value="1">Super Admin</option>
                                                        <option value="2">Admin</option>

                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                        <!-- Center Submit Button -->
                                        <div class="panel-footer d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
