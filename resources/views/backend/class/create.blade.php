@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">class</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Create class</h2>
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

                                <form method="POST" action="{{ url('panel/class/create') }}" enctype="multipart/form-data"
                                    class="form-horizontal">

                                    @csrf
                                    <div class="panel panel-default">

                                        <div class="panel-body">
                                            @include('_message')

                                            <!-- class Name -->
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
