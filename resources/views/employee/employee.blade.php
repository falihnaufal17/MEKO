@extends('template')
@section('content')

    <div id="eq-loader">
        <div class="eq-loader-div">
            <div class="eq-loading dual-loader mx-auto mb-5"></div>
        </div>
    </div>
    <div class="page-header">
        <div class="page-title">
            <h3>Employee</h3>
        </div>
    </div>
    <div class="row">
        @include('employee.form-add')
        @include('employee.form-edit')
        <div class="col-12 col-md-12 layout-spacing" id="lists">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row align-items-center text-center justify-content-center justify-content-md-between">
                        <div class="col-12 col-md-auto">
                            <h4>Employee List</h4>
                        </div>
                        <div class="col-12 col-md-auto">
                            <button class="btn btn-button-4 rounded btn-block" onclick="showForm()">Add New Employee</button>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="employee-table" class="table table-striped table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Role</th>
                                    <th>Birth Date</th>
                                    <th>Birth Place</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th class="invisible"></th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="js/employee/employee.js"></script>
@endsection