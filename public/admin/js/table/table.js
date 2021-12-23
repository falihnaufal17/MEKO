let idTable = null

$(document).ready(function() {
    fetchDataMenu()
    $('#form-add').hide()
    $('#form-edit').hide()
})

function fetchDataMenu(){
    $('#tables').DataTable({
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
            url: base_url + "/api/table",
        },
        columns: [
            { data: 'id' },
            { data: 'number', },
            { data: 'status' },
            {
                data: 'qrcode_image',
                render: (data, type, row) => {
                    return `<img src=${data} alt=${row.number} class="img-thumbnail" />`
                }
            },
            { data: 'url' },
            {
                data: 'created_at',
                render: (data) => {
                    return formatDate(data, true, true)
                }
            },
            {
                data: 'updated_at',
                render: (data) => {
                    return formatDate(data, true, true)
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

function showForm() {
    $('#form-add').show()
    $('#lists').hide()
}

function closeForm() {
    $('#form-add').hide()
    $('#form-edit').hide()
    $('#lists').show()
    $('#add-table')[0].reset()
    $('#edit-table')[0].reset()
    checkValidFromResponse({el: "table-edit-", source: {
        number: ''
    }})
    checkValidFromResponse({el: "table-", source: {
        number: ''
    }})
}

function openEdit(id) {
    idTable = id

    $.ajax({
        type: 'get',
        url: base_url + '/api/table/' + id,
    }).then(res => {
        $('input[name=number]').val(res.data.number)

        $('#form-edit').show()
        $('#lists').hide()
    }).catch(err => {
        swal("Error", err, 'error')
    })
}

function submitForm(e) {
    e.preventDefault()

    let data = new FormData($('#add-table')[0])

    $.ajax({
        type: 'post',
        url: base_url + '/api/table/add',
        data: data,
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

            checkValidFromResponse({el: "table-", source: {
                number: ''
            }})
        })
    }).catch(err => {
        checkValidFromResponse({el: "table-", source: {
            number: '',
        }, errResponse: err.responseJSON.data})
    })
}

function submitFormUpdate(e) {
    e.preventDefault()

    let data = new FormData($('#edit-table')[0])

    $.ajax({
        type: 'post',
        url: base_url + '/api/table/' + idTable,
        data: data,
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
            $('#form-edit').hide()
            $('#lists').show()

            checkValidFromResponse({el: "table-edit-", source: {
                number: ''
            }})
        })
    }).catch(err => {
        checkValidFromResponse({el: "table-edit-", source: {
            number: '',
        }, errResponse: err.responseJSON.data})
    })
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
                url: base_url + '/api/table/' + id,
                processData: false,
                contentType: false
            }).then((res) => {
                swal(
                    'Success!',
                    'Table has been deleted.',
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