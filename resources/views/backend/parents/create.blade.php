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
        <h2><span class="fa fa-arrow-circle-o-left"></span>Create Parent</h2>
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

                                <form method="POST" action="{{ url('panel/parents/create') }}"
                                    enctype="multipart/form-data" class="form-horizontal">

                                    @csrf
                                    <div class="panel panel-default">

                                        <div class="panel-body">
                                            @include('_message')
                                            @if (Auth::user()->is_admin==1 || Auth::user()->is_admin==2)
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">School Name<span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control schoolChange" name="school_id" id="">
                                                        <option value="1">Select</option>
                                                        @foreach ($getSchool as $school)
                                                        <option value="{{ $school->id }}">{{ $school->name}}</option>
                                                     
                                                        @endforeach
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                                
                                            @endif
                                            <!-- parents Name -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">First Name <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span
                                                                class="fa fa-pencil"></span></span>
                                                        <input name="first_name" type="text" class="form-control"
                                                            required />
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

                                            <!-- Gender -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Gender <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control" name="gender" id="">
                                                        <option value="1" class="fa fa-male"> Male</option>
                                                        <option value="0" class="fa fa-female"> Female</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Occupation <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span
                                                                class="fa fa-briefcase"></span></span>
                                                        <input name="occupation" type="text" class="form-control"
                                                            required value="{{ old('occupation') }}" />
                                                    </div>
                                                </div>
                                            </div>




                                            <!-- Mobile Number -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Mobile <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span
                                                                class="fa fa-phone"></span></span>
                                                        <input name="mobile" type="text" class="form-control" required
                                                            value="{{ old('mobile') }}" />
                                                    </div>
                                                </div>
                                            </div>





                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Address <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">

                                                        <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Profile Pic</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span
                                                                class="fa fa-camera"></span></span>
                                                        <input name="profile_pic" type="file"
                                                            class="form-control fileinput btn-primary"
                                                            title="Browse file" />
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Status <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span
                                                                class="fa fa-toggle-on"></span></span>
                                                        <select required class="form-control" name="status" id="">
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
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
                                                                class="fa fa-envelope"></span></span>
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
