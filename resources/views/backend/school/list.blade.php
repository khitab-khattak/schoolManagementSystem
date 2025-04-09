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
    <h2><span class="fa fa-arrow-circle-o-left"></span> School</h2>
</div>
<!-- END PAGE TITLE -->                

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading flex justify-between">
                    <h3 class="panel-title">School List</h3>
                    <a class="btn btn-primary pull-right" href="{{ url('panel/school/create') }}">Create School</a>
                </div>

                <div class="panel-body panel-body-table">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th width="100">status</th>
                                    <th width="100">amount</th>
                                    <th width="100">date</th>
                                    <th width="100">actions</th>
                                </tr>
                            </thead>
                            <tbody>                                            
                                <tr id="trow_1">
                                    <td class="text-center">1</td>
                                    <td><strong>John Doe</strong></td>
                                    <td><span class="label label-success">New</span></td>
                                    <td>$430.20</td>
                                    <td>24/09/2014</td>
                                    <td>
                                        <button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
                                        <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_1');"><span class="fa fa-times"></span></button>
                                    </td>
                                </tr>
                                <tr id="trow_2">
                                    <td class="text-center">2</td>
                                    <td><strong>Dmitry Ivaniuk</strong></td>
                                    <td><span class="label label-warning">Pending</span></td>
                                    <td>$1,351.00</td>
                                    <td>23/09/2014</td>
                                    <td>
                                        <button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
                                        <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_2');"><span class="fa fa-times"></span></button>
                                    </td>
                                </tr>
                                <tr id="trow_3">
                                    <td class="text-center">3</td>
                                    <td><strong>Nadia Ali</strong></td>
                                    <td><span class="label label-info">In Queue</span></td>
                                    <td>$2,621.00</td>
                                    <td>22/09/2014</td>
                                    <td>
                                        <button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
                                        <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_3');"><span class="fa fa-times"></span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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