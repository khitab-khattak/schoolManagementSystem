@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">parents</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Edit parents</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="" enctype="multipart/form-data" class="form-horizontal">
                    @csrf

                    <div class="panel panel-default">
                        <div class="panel-body">
                            @include('_message')

                            <!-- Name -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">First Name *</label>
                                <div class="col-md-6">
                                    <input name="name" type="text" class="form-control" required
                                        value="{{ old('name', $getparents->name) }}">
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Last Name *</label>
                                <div class="col-md-6">
                                    <input name="last_name" type="text" class="form-control" required
                                        value="{{ old('last_name', $getparents->last_name) }}">
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Gender *</label>
                                <div class="col-md-6">
                                    <select name="gender" class="form-control" required>
                                        <option value="1" {{ $getparents->gender == 1 ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="2" {{ $getparents->gender == 2 ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Occupation <span
                                        class="text-red-500">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-briefcase"></span></span>
                                        <input name="occupation" type="text" class="form-control" required
                                            value="{{ old('occupation', $getparents->occupation) }}" />
                                    </div>
                                </div>
                            </div>




                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Mobile <span
                                        class="text-red-500">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                        <input name="mobile" type="text" class="form-control" required
                                            value="{{ old('mobile', $getparents->mobile) }}" />
                                    </div>
                                </div>
                            </div>




                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Address <span
                                        class="text-red-500">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"></span></span>
                                        <textarea name="address" class="form-control" required>{{ old('address', $getparents->address) }}</textarea>
                                    </div>
                                </div>
                            </div>




                            <!-- Email -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email *</label>
                                <div class="col-md-6">
                                    <input name="email" type="email" class="form-control" required
                                        value="{{ old('email', $getparents->email) }}">
                                    @if ($errors->has('email'))
                                        <div class="text-red-600 mt-1">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Password (optional)</label>
                                <div class="col-md-6">
                                    <input name="password" type="password" class="form-control"
                                        placeholder="Leave blank to keep current password">
                                </div>
                            </div>

                            <!-- Profile Picture -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Profile Picture</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-camera"></span></span>
                                        <input type="file" name="profile_pic" class="form-control">
                                    </div>
                                    @if ($getparents->profile_pic)
                                        <img src="{{ asset('upload/profile/' . $getparents->profile_pic) }}" width="50"
                                            height="50" style="margin-top: 10px; border-radius: 50%;">
                                    @endif
                                </div>
                            </div>


                            <!-- Status -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Status <span class="text-red-500">*</span></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-toggle-on"></span></span>
                                        <select name="status" class="form-control" required>
                                            <option value="1" {{ $getparents->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $getparents->status == 0 ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <!-- Submit -->
                            <div class="panel-footer text-center">
                                <button type="submit" class="btn btn-primary">Update Parent</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/demo_tables.js') }}"></script>
@endsection
