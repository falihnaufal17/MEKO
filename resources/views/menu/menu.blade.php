@extends('template')
@section('style')
    <style>
    </style>
@endsection
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h3>Menu</h3>
        </div>
    </div>
    <div class="row" id="cancel-row">
        @include('menu.form-add')
        @include('menu.form-edit')
        <div class="col-12 col-md-12 layout-spacing" id="lists">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row align-items-center text-center justify-content-center justify-content-md-between">
                        <div class="col-12 col-md-auto">
                            <h4>Menu List</h4>
                        </div>
                        <div class="col-12 col-md-auto">
                            <button class="btn btn-button-4 rounded btn-block" onclick="showForm()">Add New Menu</button>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4 style-1">
                        <table id="zero-config" class="table table-striped style-1 table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Status Stock</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th>Approved By</th>
                                    <th>Approved At</th>
                                    <th>Rejected By</th>
                                    <th>Rejected At</th>
                                    <th>Category</th>
                                    <th>Description</th>
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
    @include('menu.modal-change-stock')
    @include('menu.modal-form-reject')
    @include('menu.modal-show-reason')
@endsection
@section('script')
    <script src="js/menu/menu.js" defer></script>    
@endsection