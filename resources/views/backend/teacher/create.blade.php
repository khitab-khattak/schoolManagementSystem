@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">teacher</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Create teacher</h2>
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

                                <form method="POST" action="{{ url('panel/teacher/create') }}"
                                    enctype="multipart/form-data" class="form-horizontal">

                                    @csrf
                                    <div class="panel panel-default">

                                        <div class="panel-body">
                                            @include('_message')

                                            <!-- teacher Name -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">First Name <span
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

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Last Name <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span
                                                                class="fa fa-pencil"></span></span>
                                                        <input name="last_name" value="{{ old('last_name') }}"type="text"
                                                            class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Gender<span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control" name="gender" id="">
                                                        <option value="1">Male</option>
                                                        <option value="0">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Date of Birth <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input name="dob" value="{{ old('dob') }}" type="date"
                                                        class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Date of Joining <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input name="doj" value="{{ old('doj') }}" type="date"
                                                        class="form-control" required />
                                                </div>
                                            </div>

                                            <!-- Mobile Number -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Mobile Number <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input name="mobile" value="{{ old('mobile') }}" type="text"
                                                        class="form-control" required />
                                                </div>
                                            </div>


                                            <!-- Marital Status -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Marital Status<span
                                                    class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select name="marital_status" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Single"
                                                            {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single
                                                        </option>
                                                        <option value="Married"
                                                            {{ old('marital_status') == 'Married' ? 'selected' : '' }}>
                                                            Married</option>
                                                        <option value="Divorced"
                                                            {{ old('marital_status') == 'Divorced' ? 'selected' : '' }}>
                                                            Divorced</option>
                                                        <option value="Widowed"
                                                            {{ old('marital_status') == 'Widowed' ? 'selected' : '' }}>
                                                            Widowed</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Current Address -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Current Address<span
                                                    class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <textarea name="current_address" class="form-control">{{ old('current_address') }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Permanent Address -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Permanent Address<span
                                                    class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <textarea name="permanent_address" class="form-control">{{ old('permanent_address') }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Qualification -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Qualification<span
                                                    class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input name="qualification" value="{{ old('qualification') }}"
                                                        type="text" class="form-control" />
                                                </div>
                                            </div>

                                            <!-- Work Experience -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Work Experience<span
                                                    class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input name="work_experience" value="{{ old('work_experience') }}"
                                                        type="text" class="form-control" />
                                                </div>
                                            </div>

                                            <!-- Note -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Note<span
                                                    class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <textarea name="note" class="form-control">{{ old('note') }}</textarea>
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
