$(document).ready(function () {
    table = $('#list_dokumen').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": baseUrl + 'master/dokumen/data',
            "type": "POST",
            "error": function (error) {
                errorCode(error)
            }
        },

        "columnDefs": [{
                "sClass": "text-center",
                "targets": [0],
                "orderable": false
            },
            {
                "targets": [1],
                "orderable": true
            },
            {
                "targets": [2],
                "orderable": true
            },
            {
                "sClass": "text-center",
                "targets": [5],
            }
        ],
    });
    // getUser()
})

$('#list_dokumen').on('click', '#edit', function () {
    let id = $(this).data('id');
    $.ajax({
        url: baseUrl + 'master/dokumen/get/' + id,
        type: "GET",
        success: function (result) {
            response = JSON.parse(result)
            $("#idData").val(response.id)
            $("#nama").val(response.nama)
            $("#kode").val(response.kode)
            $("#kecocokan").val(response.kecocokan)
            $("#kata_kunci").val(response.kata_kunci)
            $("#modal-edit").modal('show')
        },
        error: function (error) {
            errorCode(error)
        }
    })
})

$('#list_dokumen').on('click', '#delete', function () {
    let id = $(this).data('id');
    confirmSweet("Data akan terhapus secara permanen !")
        .then(result => {
            if (result) {
                $.ajax({
                    url: baseUrl + 'master/dokumen/delete/' + id,
                    type: "GET",
                    success: function (result) {
                        response = JSON.parse(result)
                        if (response.status == 'ok') {
                            table.ajax.reload(null, false)
                            // msgSweetSuccess(response.msg)
                            toastr.success(response.msg)
                        } else {
                            // msgSweetWarning(response.msg)
                            toastr.warning(response.msg)
                        }
                    },
                    error: function (error) {
                        errorCode(error)
                    }
                })
            }
        })
})

$('#list_dokumen').on('click', '#reset', function () {
    let id = $(this).data('id');
    confirmSweet("Kata Sandi Akun akan direset !")
        .then(result => {
            if (result) {
                $.ajax({
                    url: baseUrl + 'master/dokumen/reset/' + id,
                    type: "GET",
                    success: function (result) {
                        response = JSON.parse(result)
                        if (response.status == 'ok') {
                            table.ajax.reload(null, false)
                            // msgSweetSuccess(response.msg)
                            toastSuccess(response.msg)
                        } else {
                            // msgSweetWarning(response.msg)
                            toastWarning(response.msg)
                        }
                    },
                    error: function (error) {
                        errorCode(error)
                    }
                })
            }
        })
})

$("#formAddDokumen").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: baseUrl + "master/dokumen/insert",
        type: "post",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            // disableButton()
        },
        complete: function () {
            // enableButton()
        },
        success: function (result) {
            let response = JSON.parse(result)
            if (response.status == "fail") {
                msgSweetError(response.msg, "File sudah ada !")
            } else {
                table.ajax.reload(null, false)
                toastr.success(response.msg)
                clearInput($("input"))
            }
        },
        error: function (event) {
            errorCode(event)
        }
    });
})

$("#formEditDokumen").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: baseUrl + "master/dokumen/update",
        type: "post",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            disableButton()
        },
        complete: function () {
            enableButton()
        },
        success: function (result) {
            let response = JSON.parse(result)
            if (response.status == "fail") {
                toastr.warning(response.msg)
                clearInput($("input"))
                $("#modal-edit").modal('hide')
            } else {
                table.ajax.reload(null, false)
                toastr.success(response.msg)
                clearInput($("input"))
                $("#modal-edit").modal('hide')
            }
        },
        error: function (event) {
            errorCode(event)
        }
    });
})

setInterval(() => {
    table.ajax.reload(null, false);
}, 30000);