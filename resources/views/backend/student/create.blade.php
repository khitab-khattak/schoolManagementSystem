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
        <h2><span class="fa fa-arrow-circle-o-left"></span>Create student</h2>
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

                                <form method="POST" action="{{ url('panel/student/create') }}"
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

                                            <!-- student Name -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">First Name <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span
                                                                class="fa fa-pencil"></span></span>
                                                        <input name="name" value="{{ old('name') }}"type="text"
                                                            class="form-control" required />
                                                            <div>{{ $errors->first('name')}}</div>
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
                                                <label class="col-md-3 col-xs-12 control-label">Admission Number <span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-id-card"></span></span>
                                                        <input name="admission_number" type="int"
                                                            class="form-control" required />
                                                         @if ($errors->has('admission_number'))
                                                            <div class="text-danger mt-1">{{ $errors->first('admission_number') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">
                                                    Roll Number <span class="text-red-500">*</span>
                                                </label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" aria-label="Roll Number">
                                                            <i class="fa fa-hashtag"></i>
                                                        </span>
                                                        <input 
                                                            name="roll_number" 
                                                            value="" 
                                                            type="text" 
                                                            class="form-control" 
                                                            required 
                                                        />
                                                    </div>
                                                    @if ($errors->has('roll_number'))
                                                        <div class="text-danger mt-1">{{ $errors->first('roll_number') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Class<span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control getClass" name="class_id" id="">
                                                        <option>Select</option>  
                                                        @foreach ($getClass as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Gender<span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control" name="gender" id="">
                                                        <option value="">Select</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
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
                                                <label class="col-md-3 col-xs-12 control-label">Caste <span class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                        <input name="caste" value="{{ old('caste') }}" type="text" class="form-control" placeholder="Enter Caste" />
                                                    </div>
                                                    <div>{{ $errors->first('caste') }}</div>
                                                </div>
                                            </div>
                                            


                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">
                                                    Religion <span class="text-red-500">*</span>
                                                </label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-mosque"></i>
                                                        </span>
                                                        <input 
                                                            name="religion" 
                                                            value="" 
                                                            type="text" 
                                                            class="form-control" 
                                                            required 
                                                        />
                                                    </div>
                                                    @if ($errors->has('religion'))
                                                        <div class="text-danger mt-1">{{ $errors->first('religion') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Mobile Number <span class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                                        <input name="mobile_number" value="{{ old('mobile_number') }}" type="text" class="form-control" required />
                                                        <div>{{ $errors->first('mobile_number') }}</div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Admission Date <span class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input name="admission_date" value="{{ old('admission_date') }}" type="date" class="form-control" required />
                                                    </div>
                                                    <div>{{ $errors->first('admission_date') }}</div>
                                                </div>
                                            </div>
                                            

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Blood Group <span class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select name="blood_group" class="form-control" required>
                                                        <option value="">Select Blood Group</option>
                                                        <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                                                        <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                                                        <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                                                        <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                                                        <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                                                        <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                                                        <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                                        <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                                    </select>
                                                    <div>{{ $errors->first('blood_group') }}</div>
                                                </div>
                                            </div>
                                            

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Height <span class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                                        <input name="height" value="{{ old('height') }}" type="text" class="form-control" placeholder="Enter Height (e.g., 5.8 ft or 170 cm)" required />
                                                    </div>
                                                    <div>{{ $errors->first('height') }}</div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Weight <span class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                                        <input name="weight" value="{{ old('weight') }}" type="number" step="0.1" class="form-control" placeholder="Enter Weight (in kg)" required />
                                                    </div>
                                                    <div>{{ $errors->first('weight') }}</div>
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
    <script type="text/javascript">
    $('body').delegate('.schoolChange','change',function(){
        var school_id = $(this).val();
        $.ajax({
            url:"{{ url('panel/student/getclass')}}",
            type:"POST",
            data:{
                "_token":"{{ csrf_token() }}",
                school_id:school_id,
            },
            dataType:"json",
            success:function(response){

            },
        });
    })
    </script>
@endsection
