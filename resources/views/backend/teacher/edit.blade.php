@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Teacher</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Edit Teacher</h2>
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
                                    <input name="name" type="text" class="form-control" required value="{{ old('name', $getteacher->name) }}">
                                </div>
                            </div>
    
                            <!-- Last Name -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Last Name *</label>
                                <div class="col-md-6">
                                    <input name="last_name" type="text" class="form-control" required value="{{ old('last_name', $getteacher->last_name) }}">
                                </div>
                            </div>
    
                            <!-- Gender -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Gender *</label>
                                <div class="col-md-6">
                                    <select name="gender" class="form-control" required>
                                        <option value="1" {{ $getteacher->gender == 1 ? 'selected' : '' }}>Male</option>
                                        <option value="2" {{ $getteacher->gender == 2 ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
    
                            <!-- DOB -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Date of Birth *</label>
                                <div class="col-md-6">
                                    <input name="dob" type="date" class="form-control" required value="{{ old('dob', $getteacher->dob) }}">
                                </div>
                            </div>
    
                            <!-- DOJ -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Date of Joining *</label>
                                <div class="col-md-6">
                                    <input name="doj" type="date" class="form-control" required value="{{ old('doj', $getteacher->doj) }}">
                                </div>
                            </div>
    
                            <!-- Mobile -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Mobile *</label>
                                <div class="col-md-6">
                                    <input name="mobile" type="text" class="form-control" required value="{{ old('mobile', $getteacher->mobile) }}">
                                </div>
                            </div>
    
                            <!-- Marital Status -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Marital Status *</label>
                                <div class="col-md-6">
                                    <input name="marital_status" type="text" class="form-control" required value="{{ old('marital_status', $getteacher->marital_status) }}">
                                </div>
                            </div>
    
                            <!-- Current Address -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Current Address *</label>
                                <div class="col-md-6">
                                    <textarea name="current_address" class="form-control" required>{{ old('current_address', $getteacher->current_address) }}</textarea>
                                </div>
                            </div>
    
                            <!-- Permanent Address -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Permanent Address *</label>
                                <div class="col-md-6">
                                    <textarea name="permanent_address" class="form-control" required>{{ old('permanent_address', $getteacher->permanent_address) }}</textarea>
                                </div>
                            </div>
    
                            <!-- Qualification -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Qualification *</label>
                                <div class="col-md-6">
                                    <input name="qualification" type="text" class="form-control" required value="{{ old('qualification', $getteacher->qualification) }}">
                                </div>
                            </div>
    
                            <!-- Work Experience -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Work Experience *</label>
                                <div class="col-md-6">
                                    <input name="work_experience" type="text" class="form-control" required value="{{ old('work_experience', $getteacher->work_experience) }}">
                                </div>
                            </div>
    
                            <!-- Note -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Note</label>
                                <div class="col-md-6">
                                    <textarea name="note" class="form-control">{{ old('note', $getteacher->note) }}</textarea>
                                </div>
                            </div>
    
                            <!-- Email -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email *</label>
                                <div class="col-md-6">
                                    <input name="email" type="email" class="form-control" required value="{{ old('email', $getteacher->email) }}">
                                    @if ($errors->has('email'))
                                        <div class="text-red-600 mt-1">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
    
                            <!-- Password -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Password (optional)</label>
                                <div class="col-md-6">
                                    <input name="password" type="password" class="form-control" placeholder="Leave blank to keep current password">
                                </div>
                            </div>
    
                            <!-- Profile Picture -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Profile Picture</label>
                                <div class="col-md-6">
                                    <input type="file" name="profile_pic" class="form-control">
                                    @if($getteacher->profile_pic)
                                        <img src="{{ asset('upload/profile/'.$getteacher->profile_pic) }}" width="50" height="50" style="margin-top: 10px; border-radius: 50%;">
                                    @endif
                                </div>
                            </div>
    
                            <!-- Status -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Status *</label>
                                <div class="col-md-6">
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ $getteacher->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $getteacher->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
    
                            <!-- Submit -->
                            <div class="panel-footer text-center">
                                <button type="submit" class="btn btn-primary">Update Teacher</button>
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
