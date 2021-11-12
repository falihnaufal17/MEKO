@extends('template')
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h3>Menu</h3>
        </div>
    </div>
    <div class="row" id="cancel-row">
        <div class="col-12 col-md-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row align-items-center text-center justify-content-center justify-content-md-between">
                        <div class="col-12 col-md-auto">
                            <h4>Menu List</h4>
                        </div>
                        <div class="col-12 col-md-auto">
                            <button class="btn btn-button-4 rounded btn-block md-trigger" data-modal="form">Add New Menu</button>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4 style-1">
                        <table id="zero-config" class="table table-striped style-1 table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th>Approved By</th>
                                    <th>Category</th>
                                    <th>Created At</th>
                                    <th class="invisible"></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
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
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="openEdit(1)">Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="onDelete(1)">Delete</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Approve</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Reject</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('menu.modal-form')
@endsection
@section('script')
<script>
    let idMenu = null
    $('#zero-config').DataTable({
        ajax: {
            url: base_url + "/api/menu/lists",
        },
        columns: [
            {
                data: 'image'
            },
            {
                data: 'name'
            },
            {
                data: 'stock'
            },
            {
                data: 'status'
            },
            {
                data: 'price'
            },
            {
                data: 'created_by'
            },
            {
                data: 'updated_by'
            },
            {
                data: 'approved_by'
            },
            {
                data: 'category_id'
            },
            {
                data: 'created_at'
            },
            {
                data: 'id',
                render: (data) => {
                    return `
                        <div class="dropdown custom-dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="flaticon-dot-three"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                <a class="dropdown-item" href="javascript:void(0);" onclick="openEdit(${data})">Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="onDelete(${data})">Delete</a>
                                <a class="dropdown-item" href="javascript:void(0);">Approve</a>
                                <a class="dropdown-item" href="javascript:void(0);">Reject</a>
                            </div>
                        </div>
                    `
                }
            },
        ],
        "language": {
            "paginate": { "previous": "<i class='flaticon-arrow-left-1'></i>", "next": "<i class='flaticon-arrow-right'></i>" },
            "info": "Showing page _PAGE_ of _PAGES_"
        }
    });
    function openEdit(id){
        document.getElementById('form').classList.add("md-show")
        document.getElementById('title-modal').innerHTML = "Edit Menu"
        idMenu = id
    }
    function onDelete(id){
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then(function(result) {
            if (result.value) {
                swal(
                    'Deleted!',
                    'Menu has been deleted.',
                    'success'
                )
            }else{
                swal(
                    'Cancelled',
                    'Menu is safe :)',
                    'error'
                )
            }
        })
    }
    function submitForm(e){
        e.preventDefault()
        document.getElementById('form').classList.remove("md-show")
        if(idMenu == null){
            swal({
                title: 'Success',
                text: "Data has been added successfully!",
                type: 'success'
            }).then(()=>{
                console.log("ajax reload datatable")
            })
        }else{
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Update'
            }).then(function(result) {
                if (result.value) {
                    swal(
                        'Updated!',
                        'Menu has been updated.',
                        'success'
                    ).then(()=>{
                        idMenu = null
                        document.getElementById('title-modal').innerHTML = "Add New Menu"
                        console.log("ajax reload datatable")
                    })
                }else{
                    swal(
                        'Cancelled',
                        'Menu is safe :)',
                        'error'
                    )
                }
            })
        }
    }
</script>    
@endsection