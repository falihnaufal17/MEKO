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
        swal(textStatus.toUpperCase(), jqXHR.responseJSON.message, 'error')
        $("#eq-loader").hide();
    }
}

$.ajaxSetup(ajax)
$.extend(true, $.fn.dataTable?.defaults, {
    'ajax': ajax
})

$.fn.dataTable.ext.errMode = 'none'