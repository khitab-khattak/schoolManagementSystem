@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Assign Class Teacher</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Create Assign Class Teacher</h2>
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

                                <form method="POST" action="{{ url('panel/assign-class-teacher/create') }}" enctype="multipart/form-data"
                                    class="form-horizontal">

                                    @csrf
                                    <div class="panel panel-default">

                                        <div class="panel-body">
                                            @include('_message')

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Class<span
                                                        class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control" name="class_id" id="">
                                                        <option value="">Select</option>
                                                        @foreach ($getClass as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">
                                                    Class Teacher <span class="text-red-500">*</span>
                                                </label>
                                                <div class="col-md-6 col-xs-12">
                                                    @foreach ($getTeacher as $teacher)
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="teacher_id[]" value="{{ $teacher->id }}">
                                                                {{ $teacher->name }}  {{ $teacher->last_name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
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
