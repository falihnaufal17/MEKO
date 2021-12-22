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
@endsection