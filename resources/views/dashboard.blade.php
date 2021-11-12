@extends('template')
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h3>Dashboard</h3>
        </div>
    </div>
    <div class="row layout-spacing ">

        <div class="col-xl-3 mb-xl-0 col-lg-6 mb-4 col-md-6 col-sm-6">
            <div class="widget-content-area  data-widgets br-4">
                <div class="widget  t-sales-widget">
                    <div class="media">
                        <div class="icon ml-2">
                            <i class="flaticon-desk-chair"></i>
                        </div>
                        <div class="media-body text-right">
                            <p class="widget-text mb-0">Tables</p>
                            <p class="widget-numeric-value">50</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 mb-xl-0 col-lg-6 mb-4 col-md-6 col-sm-6">
            <div class="widget-content-area  data-widgets br-4">
                <div class="widget  t-order-widget">
                    <div class="media">
                        <div class="icon ml-2">
                            <i class="flaticon-bill"></i>
                        </div>
                        <div class="media-body text-right">
                            <p class="widget-text mb-0">Orders</p>
                            <p class="widget-numeric-value">24,017</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-sm-0 mb-4">
            <div class="widget-content-area  data-widgets br-4">
                <div class="widget  t-customer-widget">
                    <div class="media">
                        <div class="icon ml-2">
                            <i class="flaticon-cutlery-1"></i>
                        </div>
                        <div class="media-body text-right">
                            <p class="widget-text mb-0">Menus</p>
                            <p class="widget-numeric-value">92,251</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            
            <div class="widget-content-area  data-widgets br-4">
                <div class="widget  t-income-widget">
                    <div class="media">
                        <div class="icon ml-2">
                            <i class="flaticon-employees"></i>
                        </div>
                        <div class="media-body text-right">
                            <p class="widget-text mb-0">Employee</p>
                            <p class="widget-numeric-value">30</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row" id="cancel-row">
                
        <div class="col-12 col-md-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Menu List</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="zero-config" class="table table-striped table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th>Category</th>
                                    <th>Created At</th>
                                    <th class="invisible"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Image</td>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                    <td>Category</td>
                                    <td>Created At</td>
                                    <td>
                                        <div class="dropdown custom-dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="flaticon-dot-three"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Approve</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Reject</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
<script>
    $('#zero-config').DataTable({
        "language": {
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_"
        }
    });
</script>    
@endsection