$(document).ready(function() {
    fetchData()

    $('#form-add').hide()
    $('#form-edit').hide()
})

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
            url: base_url + "/api/auth/employee/list"
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

function showForm(){
    $('#form-add').show()
    $('#lists').hide()
}

function closeForm(){
    $('#form-add').hide()
    $('#form-edit').hide()
    $('#lists').show()
    $('#add-employee')[0].reset()
    $('#edit-employee')[0].reset()
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
}

function submitData(e){
    e.preventDefault()
    let form = $('#add-employee')
    let formData = new FormData(form[0])
    formData.append('image', $('input[name=image]')[0].files[0])
    
    $.ajax({
        type: 'post',
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

function openEdit(id){
    $.ajax({
        type: 'get',
        url: base_url + '/api/auth/employee/' + id,
        dataType: 'json',
        processData: false,
        contentType: false
    }).then((res) => {

        // Fill field input from response api
        $('input[name=name').val(res.data.name)
        $('input[name=birth_date').val(res.data.birth_date)
        $('input[name=birth_place').val(res.data.birth_place)
        $('select[name=role_id').val(res.data.role_id)
        $('select[name=gender').val(res.data.gender)
        $('input[name=phone').val(res.data.phone)
        $('input[name=email').val(res.data.email)
        $('textarea[name=address').val(res.data.address)
        $('input[name=image').val(res.data.image)

        // Show form edit data employee
        $('#form-edit').show()
        $('#lists').hide()
    }).catch((err) => {
        console.log(err)
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
                url: base_url + '/api/auth/employee/' + id,
                processData: false,
                contentType: false
            }).then((res) => {
                swal(
                    'Success!',
                    'Employee has been deleted.',
                    'success'
                ).then(()=>{
                    fetchData()
                })
            }).catch((err) => {
                console.log(err)
            })
        }else{
            swal(
                'Cancelled',
                'Employee is safe :)',
                'error'
            )
        }

    })
}