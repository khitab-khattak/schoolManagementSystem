@extends('backend.layouts.app')

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Edit Single Assign Subject Class</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span> Edit Singe Assign Subject Class</h2>
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
                                <form method="POST" action=""
                                    enctype="multipart/form-data" class="form-horizontal">
                                    @csrf

                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            @include('_message')

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">
                                                    Class <span class="text-red-500">*</span>
                                                </label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control" name="class_id" id="class_id">
                                                        <option value="">Select</option>
                                                        @foreach ($getClass as $class)
                                                            <option value="{{ $class->id }}"
                                                                {{ isset($getRecord) && $getRecord->class_id == $class->id ? 'selected' : '' }}>
                                                                {{ $class->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">
                                                    Subjects <span class="text-red-500">*</span>
                                                </label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control" name="subject_id" id="subject_id">
                                                        <option value="">Select</option>
                                                        @foreach ($getsubject as $sub)
                                                        <option value="{{ $sub->id }}"
                                                            {{ isset($getRecord) && $getRecord->subject_id == $sub->id ? 'selected' : '' }}>
                                                            {{ $sub->name }} {{ $sub->last_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">
                                                    Status <span class="text-red-500">*</span>
                                                </label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control" name="status" id="status">
                                                        <option value="1" {{ $getRecord->status == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ $getRecord->status == 0 ? 'selected' : '' }}>Inactive</option>
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
