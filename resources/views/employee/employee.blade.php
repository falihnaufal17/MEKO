@extends('template')
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h3>Employee</h3>
        </div>
    </div>
    <div class="row">
        @include('employee.form-add')
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
    <script>
        let token = localStorage.getItem('token')

        // initialize
        // $(function(){
            fetchData()

            $('#form-add').hide()
        // })

        function fetchData(){
            $('#employee-table').DataTable({
                destroy: true,
                serverSide: true,
                fnRowCallback: function (
                    nRow,
                    aData,
                    iDisplayIndex,
                    iDisplayIndexFull
                ){
                    var index = iDisplayIndex + 1;
                    $("td:eq(0)", nRow).html(index);
                    return nRow;
                },
                ajax: {
                    url: base_url + "/api/auth/employee/list",
                    headers: {
                        Authorization: 'Bearer ' + token
                    }
                },
                columns: [
                    {
                        data: 'id'
                    },
                    {
                        data: 'image',
                        render: (data, p, row) => {
                            return `
                                <img src=${data} class="img-thumbnail rounded-circle" alt=${row.name} />
                            `
                        }
                    },
                    {
                        data: 'name',
                        render: (data) => {
                            return `<span class="text-capitalize">${data}</span>`
                        }
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'gender',
                        render: (data) => {
                            return `<span class="text-capitalize">${data}</span>`
                        }
                    },
                    {
                        data: 'role',
                        render: (data) => {
                            return `<span class="text-capitalize">${data}</span>`
                        }
                    },
                    {
                        data: 'birth_date',
                        render: (data) => {
                            return formatDate(data)
                        }
                    },
                    {
                        data: 'birth_place',
                        render: (data) => {
                            return `<span class="text-capitalize">${data}</span>`
                        }
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'created_at',
                        render: (data) => {
                            return formatDate(data)
                        }
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
        }
        
        function showForm(){
            $('#form-add').show()
            $('#lists').hide()
        }

        function closeForm(){
            $('#form-add').hide()
            $('#lists').show()
            $('#add-employee')[0].reset()
        }

        function submitData(e){
            e.preventDefault()
            let form = $('#add-employee')
            let formData = new FormData(form[0])
            formData.append('image', $('input[name=image]')[0].files[0])
            
            $.ajax({
                type: 'post',
                headers: {
                    Authorization: 'Bearer ' + token
                },
                url: base_url + '/api/auth/employee/create',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false
            }).then(res => {
                swal({
                    title: 'Success',
                    text: res.message,
                    type: 'success'
                }).then(()=>{
                    closeForm()
                    fetchData()
                    checkValidFromResponse({el: "employee-", source: {
                        name: '',
                        phone: '',
                        birth_date: '',
                        birth_place: '',
                        role_id: '',
                        gender: '',
                        email: '',
                        password: '',
                        address: ''
                    }})
                })
            }).catch(err => {
                checkValidFromResponse({el: "employee-", source: {
                    name: '',
                    phone: '',
                    birth_date: '',
                    birth_place: '',
                    role_id: '',
                    gender: '',
                    email: '',
                    password: '',
                    address: ''
                }, errResponse: err.responseJSON.data})
            })
        }

    </script>
@endsection