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
        <h2><span class="fa fa-arrow-circle-o-left"></span>Edit School</h2>
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

                                <form method="POST" action="" enctype="multipart/form-data" class="form-horizontal">

                                    @csrf
                                    <div class="panel panel-default">

                                        <div class="panel-body">
                                            @include('_message')

                                            <!-- School Name -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">School Name<span class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input name="name" value="{{ old('name',$getSchool->name)  }}"type="text" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Profile Pic -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Profile Pic</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <input name="profile_pic" type="file" class=" form-control  fileinput btn-primary" name="filename" id="filename" title="Browse file"/>
                                                        @if (!empty($getSchool->profile_pic))
                                                        <img src="{{ asset('upload/profile/' . $getSchool->profile_pic) }}"
                                                            width="50" height="50" style="border-radius: 50%;">
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <!-- Email -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">
                                                    Email <span class="text-red-500">*</span>
                                                </label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <span class="fa fa-envelope"></span>
                                                        </span>
                                                        <input name="email" type="email" class="form-control" 
                                                               value="{{ old('email', $getSchool->email) }}" required />
                                                    </div>
                                                    @if ($errors->has('email'))
                                                        <div class="text-red-600 mt-1">{{ $errors->first('email') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            

                                            <!-- Password -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">
                                                    Password <span class="text-red-500 text-sm font-normal">(Optional)</span>
                                                </label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                                        <input name="password" type="text" class="form-control" placeholder="Leave blank to keep current password" />
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <!-- Address -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Address<span class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <textarea name="address" class="form-control" required>{{ old('address',$getSchool->address) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">
                                                    Status <span class="text-red-500">*</span>
                                                </label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control" name="status">
                                                        <option value="1" {{ $getSchool->status == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ $getSchool->status == 0 ? 'selected' : '' }}>Inactive</option>
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
