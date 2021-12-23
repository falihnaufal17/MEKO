$("#eq-loader").hide();
let ajax = {
    beforeSend: function (xhr) {
        $("#eq-loader").show();

        const accessToken = localStorage.getItem('token');
        xhr.setRequestHeader("Authorization", `Bearer ${accessToken}`)
    },
    complete: function (jqXHR, textStatus) {
        $("#eq-loader").hide();
    },
    error: function (jqXHR, textStatus, errorThrown) {
        swal(textStatus.toUpperCase(), jqXHR.responseJSON?.message || jqXHR.statusText, 'error')
            .then(() => jqXHR.status == 401 ? window.location.href = '/admin/login' : '')
        $("#eq-loader").hide();
    }
}

$.ajaxSetup(ajax)
$.extend(true, $.fn.dataTable?.defaults, {
    'ajax': ajax
})

$.fn.dataTable.ext.errMode = 'none'