var statusNa = $("#statusNa").val()

$(document).ready(function () {
    table = $(`#list_${statusNa}`).DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url":`${baseUrl}surat/${statusNa}/data`,
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
                "targets": [4],
            },
            {
                "sClass": "text-center",
                "targets": [5],
                "orderable": false
            }, 
            {
                "sClass": "text-center",
                "targets": [6],
                "orderable": false
            }
        ],
    });
    // getUser()
})

$(`#list_${statusNa}`).on('click', '#delete', function () {
    let id = $(this).data('id');
    confirmSweet("Data akan terhapus secara permanen !")
        .then(result => {
            if (result) {
                $.ajax({
                    url: baseUrl + 'surat/delete/' + id,
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

$("#formAddPermintaan").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: baseUrl + "surat/action/tambah",
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
                $("textarea").val("")
            } else {
                table.ajax.reload(null, false)
                toastr.success(response.msg)
                $("textarea").val("")
            }
        },
        error: function (event) {
            errorCode(event)
        }
    });
})

$(`#list_${statusNa}`).on('click', '#konfirmasi', function () {
    let id = $(this).data('id');
    $.ajax({
        url: baseUrl + 'surat/action/acc/' + id,
        type: "GET",
        success: function (result) {
            let response = JSON.parse(result)
            if (response.status == "fail") {
                toastr.warning(response.msg)
            } else {
                table.ajax.reload(null, false)
                toastr.success(response.msg)
            }
        },
        error: function (error) {
            errorCode(error)
        }
    })
})

$(`#list_${statusNa}`).on('click', '#tolak', function () {
    let id = $(this).data('id');
    $.ajax({
        url: baseUrl + 'surat/action/ditolak/' + id,
        type: "GET",
        success: function (result) {
            let response = JSON.parse(result)
            if (response.status == "fail") {
                toastr.warning(response.msg)
            } else {
                table.ajax.reload(null, false)
                toastr.success(response.msg)
            }
        },
        error: function (error) {
            errorCode(error)
        }
    })
})

$(`#list_${statusNa}`).on('click', '#unduh', function () {
    let id = $(this).data('id');
    window.open(`${baseUrl}surat/unduh/${id}`, '_blank');
    table.ajax.reload(null, false)
})

setInterval(() => {
    table.ajax.reload(null, false);
}, 30000);