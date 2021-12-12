let idMenu = null

$(document).ready(function() {
    fetchDataMenu()
    fetchCategory()

    $('#form-add').hide()
    $('#form-edit').hide()
})

function fetchDataMenu(){
    $('#zero-config').DataTable({
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
            url: base_url + "/api/menu/list",
        },
        columns: [
            {
                data: 'id'
            },
            {
                data: 'image',
                render: (data, type, row) => {
                    return `<img src=${data} alt=${row.name} class="img-thumbnail" />`
                }
            },
            {
                data: 'name'
            },
            {
                data: 'status_stock',
                render: (data) => {
                    if (data == 1) {
                        return `<label class="badge badge-success">Stock Ready</label>`
                    } else {
                        return `<label class="badge badge-danger">Out Of Stock</label>`
                    }
                }
            },
            {
                data: 'status',
                render: (data, type, row) => {
                    return `
                        <div><label class="${data == 'reject' ? `text-danger` : `text-primary`} text-capitalize">${data}</label></div>
                        ${row.reason != null ? `<div><a href="#" class="badge badge-primary" onclick="openReason('${row.reason}')">See reason</a></div>` : '' }
                    `
                }
            },
            {
                data: 'price',
                render: (data) => {
                    return "Rp. " + priceDecimal(data)
                }
            },
            {
                data: 'created_by'
            },
            {
                data: 'updated_by',
                render: (data) => {
                    if (data == null) return '-'
                }
            },
            {
                data: 'approved_by',
                render: (data) => {
                    if (data) return data
                    return '-'
                }
            },
            {
                data: 'approved_at',
                render: (data) => {
                    return formatDate(data)
                }
            },
            {
                data: 'rejected_by',
                render: (data) => {
                    if (data) return data
                    return '-'
                }
            },
            {
                data: 'rejected_at',
                render: (data) => {
                    return formatDate(data)
                }
            },
            {
                data: 'category_name'
            },
            {
                data: 'description'
            },
            {
                data: 'created_at',
                render: (data) => {
                    return formatDate(data)
                }
            },
            {
                data: 'id',
                render: (data, type, row, meta) => {
                    return `
                        <div class="dropdown custom-dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="flaticon-dot-three"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                <a class="dropdown-item" href="javascript:void(0);" onclick="openEdit(${data})">Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="openConfirmDelete(${data})">Delete</a>
                                ${ profile.role_id == 1 ?
                                    row.status == 'approve' ? 
                                        `<a class="dropdown-item" href="javascript:void(0);" onclick="openFormReject(${data})">Reject</a>` 
                                    : `<a class="dropdown-item" href="javascript:void(0);" onclick="approve(${data})">Approve</a>`
                                : ``}
                                <a class="dropdown-item" href="javascript:void(0);" onclick="openModalChangeStock(${data}, ${row.status_stock})">Change Stock</a>
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

function submitForm(e){
    e.preventDefault()
    let form = $('#add-menu')
    let formData = new FormData(form[0])
    formData.append('image', $('input[name=image]')[0].files[0])
    formData.append('created_by', profile.name)
    formData.append('status', 'pending')

    $.ajax({
        type: 'post',
        url: base_url + '/api/menu/create',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false
    }).then(res => {
        swal({
            title: 'Success',
            text: res.message,
            type: 'success'
        }).then(() => {
            fetchDataMenu()
            $('#form-add').hide()
            $('#lists').show()

            checkValidFromResponse({el: "menu-", source: {
                name: '',
                status_stock: '',
                price: '',
                image: '',
                category_id: '',
                description: ''
            }})
        })
    }).catch(err => {
        checkValidFromResponse({el: "menu-", source: {
            name: '',
            status_stock: '',
            price: '',
            image: '',
            category_id: '',
            description: ''
        }, errResponse: err.responseJSON.data})
    })
}

function fetchCategory(){
    $.ajax({
        type: 'GET',
        url: base_url + '/api/menu/categories',
        success: (res) => {
            let select = $('select[name=category_id')
            res.data.map(item => {
                select.append('<option value=' + item.id + '>' + item.name + '</option')
            })
        }
    })
}

function showForm(){
    $('#form-add').show()
    $('#lists').hide()
}

function closeForm(){
    $('#form-add').hide()
    $('#form-edit').hide()
    $('#lists').show()
    $('#add-menu')[0].reset()
    $('#edit-menu')[0].reset()
    checkValidFromResponse({el: "menu-", source: {
        name: '',
        status_stock: '',
        price: '',
        image: '',
        category_id: '',
        description: ''
    }})
}

function openConfirmDelete(id){
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete'
    }).then(function(result) {
        
        if (result.value) {
            $.ajax({
                type: 'delete',
                url: base_url + '/api/menu/' + id,
                processData: false,
                contentType: false
            }).then((res) => {
                swal(
                    'Success!',
                    'Menu has been deleted.',
                    'success'
                ).then(() => {
                    fetchDataMenu()
                })
            }).catch((err) => {
                console.log(err)
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

function openEdit(id) {
    $.ajax({
        type: 'get',
        url: base_url + '/api/menu/' + id
    }).then(res => {
        $('#form-edit').show()
        $('#lists').hide()

        $('input[name=name').val(res.data.name)
        $('select[name=status_stock').val(res.data.status_stock)
        $('input[name=price').val(res.data.price)
        $('input[name=image').val(res.data.image)
        $('select[name=category_id').val(res.data.category_id)
        $('textarea[name=description').html(res.data.description)
    })
}

function approve(id) {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Approve'
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: 'post',
                url: base_url + '/api/menu/approve/' + id
            }).then(res => {
                swal(
                    'Success!',
                    res.message,
                    'success'
                ).then(() => {
                    fetchDataMenu()
                })
            })
        }
    })
}

function openFormReject(id) {
    $('#idmenu-to-reject').val(id)
    $('#modal-form-reject').modal('show')
}

function reject(e) {
    e.preventDefault()

    let id = $('#idmenu-to-reject').val()
    let formData = new FormData($('#form-reject')[0])

    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Reject'
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: 'post',
                url: base_url + '/api/menu/reject/' + id,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false
            }).then(res => {
                swal(
                    'Success!',
                    res.message,
                    'success'
                ).then(() => {
                    fetchDataMenu()
                    $('#idmenu-to-reject').val('')
                    $('#modal-form-reject').modal('hide')
                    $('textarea[name=reason]').val('')
                })
            })
        }
    })
}

function changeStatusStock(e) {
    e.preventDefault()

    let id = $('#idmenu_change_status').val()
    let formData = new FormData($('#form-change-status')[0])

    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Update Stock'
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: 'post',
                url: base_url + '/api/menu/change-stock/' + id,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false
            }).then(res => {
                $('#modal-change-stock').modal('hide')
                $('#idmenu_change_status').val(null)
                $('select[name=status_stock]').val('')

                swal(
                    'Success!',
                    res.message,
                    'success'
                ).then(() => {
                    fetchDataMenu()
                })
            })
        }
    })
}

function openModalChangeStock(id, data){
    $('#modal-change-stock').modal('show')
    $('#idmenu_change_status').val(id)

    $('select[name=status_stock]').val(data)
}

function openReason(data) {
    $('#reason-text').html(data)
    $('#modal-show-reason').modal('show')    
}