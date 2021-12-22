@extends('template')
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h3>Table</h3>
        </div>
    </div>
    <div class="row" id="cancel-row">
        @include('table.form-add')
        @include('table.form-edit')
        <div class="col-12 col-md-12 layout-spacing" id="lists">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row align-items-center text-center justify-content-center justify-content-md-between">
                        <div class="col-12 col-md-auto">
                            <h4>Table List</h4>
                        </div>
                        <div class="col-12 col-md-auto">
                            <button class="btn btn-button-4 rounded btn-block" onclick="showForm()">Add New Table</button>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4 style-1">
                        <table id="tables" class="table table-striped style-1 table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Number</th>
                                    <th>Status</th>
                                    <th>Qr Code</th>
                                    <th>Url</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
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
    <script src="js/table/table.js" defer></script>    
@endsection