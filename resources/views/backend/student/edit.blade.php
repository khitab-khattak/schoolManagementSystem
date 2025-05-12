@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">student</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Edit student</h2>
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
                                    <input name="first_name" type="text" class="form-control" required
                                        value="{{ old('first_name', $getstudent->first_name) }}">
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Last Name *</label>
                                <div class="col-md-6">
                                    <input name="last_name" type="text" class="form-control" required
                                        value="{{ old('last_name', $getstudent->last_name) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">
                                    Admission Number <span class="text-red-500">*</span>
                                </label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-id-card"></span>
                                        </span>
                                        <input name="admission_number"
                                            value="{{ old('admission_number', $getstudent->admission_number) }}"
                                            type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">
                                    Roll Number <span class="text-red-500">*</span>
                                </label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-hashtag"></span>
                                        </span>
                                        <input name="roll_number" value="{{ old('roll_number', $getstudent->roll_number) }}"
                                            type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">
                                    Class <span class="text-red-500">*</span>
                                </label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-graduation-cap"></span>
                                        </span>
                                        <select required class="form-control" name="class_id">
                                            <option value="">Select</option>
                                            @foreach ($getClass as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ old('class_id', $getstudent->class_id ?? '') == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('class_id'))
                                        <div class="text-danger mt-1">{{ $errors->first('class_id') }}</div>
                                    @endif
                                </div>
                            </div>



                            <!-- Gender -->
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">
                                    Gender <span class="text-red-500">*</span>
                                </label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-venus-mars"></i>
                                        </span>
                                        <select required class="form-control" name="gender">
                                            <option value="">Select</option>
                                            <option value="1" {{ old('gender', $getstudent->gender ?? '') == 1 ? 'selected' : '' }}>Male</option>
                                            <option value="2" {{ old('gender', $getstudent->gender ?? '') == 2 ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('gender'))
                                        <div class="text-danger mt-1">{{ $errors->first('gender') }}</div>
                                    @endif
                                </div>
                            </div>
                            


                            <!-- DOB -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Date of Birth *</label>
                                <div class="col-md-6">
                                    <input name="dob" type="date" class="form-control" required
                                        value="{{ old('dob', $getstudent->dob) }}">
                                </div>
                            </div>

                            <!-- Caste -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Caste <span class="text-red-500">*</span></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon" aria-label="Caste">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        <input name="caste" type="text" class="form-control" required
                                            value="{{ old('caste', $getstudent->caste) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">
                                    Religion <span class="text-red-500">*</span>
                                </label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-praying-hands"></i> {{-- or use fa-church, fa-mosque, fa-star-of-david depending on your preference --}}
                                        </span>
                                        <input name="religion" value="{{ old('religion', $getstudent->religion ?? '') }}"
                                            type="text" class="form-control" required />
                                    </div>
                                    @if ($errors->has('religion'))
                                        <div class="text-danger mt-1">{{ $errors->first('religion') }}</div>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">
                                    Mobile Number <span class="text-red-500">*</span>
                                </label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                        <input name="mobile_number"
                                            value="{{ old('mobile_number', $getstudent->mobile_number ?? '') }}"
                                            type="text" class="form-control" required />
                                    </div>
                                    @if ($errors->has('mobile_number'))
                                        <div class="text-danger mt-1">{{ $errors->first('mobile_number') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!-- Admission Date -->
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Admission Date <span
                                        class="text-red-500">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input name="admission_date"
                                            value="{{ old('admission_date', $getstudent->admission_date ?? '') }}"
                                            type="date" class="form-control" required />
                                    </div>
                                    @if ($errors->has('admission_date'))
                                        <div class="text-danger mt-1">{{ $errors->first('admission_date') }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Blood Group -->
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Blood Group <span
                                        class="text-red-500">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tint"></i></span>
                                        <select name="blood_group" class="form-control" required>
                                            <option value="">Select Blood Group</option>
                                            @foreach (['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg)
                                                <option value="{{ $bg }}"
                                                    {{ old('blood_group', $getstudent->blood_group ?? '') == $bg ? 'selected' : '' }}>
                                                    {{ $bg }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('blood_group'))
                                        <div class="text-danger mt-1">{{ $errors->first('blood_group') }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Height -->
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Height <span
                                        class="text-red-500">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                        <input name="height" value="{{ old('height', $getstudent->height ?? '') }}"
                                            type="text" class="form-control"
                                            placeholder="Enter Height (e.g., 5.8 ft or 170 cm)" required />
                                    </div>
                                    @if ($errors->has('height'))
                                        <div class="text-danger mt-1">{{ $errors->first('height') }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Weight -->
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Weight <span
                                        class="text-red-500">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                        <input name="weight" value="{{ old('weight', $getstudent->weight ?? '') }}"
                                            type="number" step="0.1" class="form-control"
                                            placeholder="Enter Weight (in kg)" required />
                                    </div>
                                    @if ($errors->has('weight'))
                                        <div class="text-danger mt-1">{{ $errors->first('weight') }}</div>
                                    @endif
                                </div>
                            </div>




                            <!-- Current Address -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Current Address *</label>
                                <div class="col-md-6">
                                    <textarea name="current_address" class="form-control" required>{{ old('current_address', $getstudent->current_address) }}</textarea>
                                </div>
                            </div>

                            <!-- Permanent Address -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Permanent Address *</label>
                                <div class="col-md-6">
                                    <textarea name="permanent_address" class="form-control" required>{{ old('permanent_address', $getstudent->permanent_address) }}</textarea>
                                </div>
                            </div>


                            <!-- Email -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email *</label>
                                <div class="col-md-6">
                                    <input name="email" type="email" class="form-control" required
                                        value="{{ old('email', $getstudent->email) }}">
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
                                    <input type="file" name="profile_pic" class="form-control">
                                    @if ($getstudent->profile_pic)
                                        <img src="{{ asset('upload/profile/' . $getstudent->profile_pic) }}"
                                            width="50" height="50" style="margin-top: 10px; border-radius: 50%;">
                                    @endif
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Status *</label>
                                <div class="col-md-6">
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ $getstudent->status == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ $getstudent->status == 0 ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="panel-footer text-center">
                                <button type="submit" class="btn btn-primary">Update student</button>
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
