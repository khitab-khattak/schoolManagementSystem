@extends('backend.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">subject</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Edit subject</h2>
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

                                            <!-- class Name -->
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Name<span class="text-red-500">*</span></label>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input name="name" value="{{ old('name',$getsubject->name)  }}"type="text" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">
                                                    Type <span class="text-red-500">*</span>
                                                </label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control" name="type">
                                                        <option value="Theory" {{ $getsubject->type == 'Theory' ? 'selected' : '' }}>Theory</option>
                                                        <option value="Practical" {{ $getsubject->type == 'Practical' ? 'selected' : '' }}>Practical</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">
                                                    Status <span class="text-red-500">*</span>
                                                </label>
                                                <div class="col-md-6 col-xs-12">
                                                    <select required class="form-control" name="status">
                                                        <option value="1" {{ $getsubject->status == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ $getsubject->status == 0 ? 'selected' : '' }}>Inactive</option>
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
