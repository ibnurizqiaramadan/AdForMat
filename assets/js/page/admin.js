var table
var baseUrl = $('meta[name="baseUrl"]').attr('content')
var menu = $('meta[name="menu"]').attr('content')
var subMenu = $('meta[name="subMenu"]').attr('content')
var token = $('meta[name="token"]').attr('content')
var upk = $('meta[name="upk"]').attr('content')

$('body').delegate('#logout', 'click', function (event) {
  var id = $(this).data('id');	
  window.location = baseUrl + 'logout/' + id
});

function disableButton(){
  $(':submit').append(' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>')
  $(':submit').attr('disabled', true)
}

function enableButton(){
  $(':submit').find('span').remove()
  $(':submit').removeAttr("disabled")
}

function errorCode(event){
  toastr.error(event.status + " " + event.statusText)

  // iziToast.error({
  // 	title: "Error",
  // 	message: event.status + " " + event.statusText,
  // 	position: 'topRight'
  // });
}

function toastInfo(msg, title = 'Info') {
    iziToast.info({
    	title: title,
    	message: msg,
    	position: 'topRight'
    });
}

function toastSuccess(msg, title = 'Success') {
	iziToast.success({
		title: title,
		message: msg,
		position: 'topRight'
	});
}

function toastWarning(msg, title = 'Warning') {
	iziToast.warning({
		title: title,
		message: msg,
		position: 'topRight'
	});
}

function toastError(msg, title = 'Error') {
	iziToast.error({
		title: title,
		message: msg,
		position: 'topRight'
	});
}

function msgSweetError(pesan, title = 'Error', timer = 1500) {
  return swal({
    icon: 'error',
    title: title,
    text: pesan,
    timer: timer,
    timerProgressBar: true,
  })
}

function msgSweetSuccess(pesan, title = 'Sukses', timer = 1500) {
  return swal({
    icon: 'success',
    title: title,
    text: pesan,
    timer: timer,
    timerProgressBar: true,
  })
}

function msgSweetWarning(pesan, title = 'Peringatan', timer = 1500) {
  return swal({
    icon: 'warning',
    title: title,
    text: pesan,
    timer: timer,
    timerProgressBar: true,
  })
}

function msgSweetInfo(pesan, title = 'Info', timer = 1500) {
  return swal({
    icon: 'info',
    title: title,
    text: pesan,
    timer: timer,
    timerProgressBar: true,
  })
}

function confirmSweet(pesan, title = 'Anda Yakin ?') {
  return swal({
    icon: 'warning',
    title: title,
    text: pesan,
    buttons: true,
    dangerMode: true,
  })
}

function post_data(url, data_, table = null) {
  $.ajax({
    url: baseUrl + url,
    type: "post",
    data: data_,
    processData: false,
    contentType: false,
    cache: false,
    beforeSend: function () {
      $(':submit').append(' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>')
      $(':submit').attr('disabled', true)
    },
    complete: function () {
      $(':submit').find('span').remove()
      $(':submit').removeAttr("disabled")
    },
    success: function (result) {
      
      console.log(result)
      
    },
    error: function () {
      toastr.error('Error')
    }
  });
}

function input_validate(inp) {
  var u = "",
    b = "";
    // console.log(inp);
  for (let index = inp.length; index > 0; index--) {
    if (inp[index - 1].required == true && inp[index - 1].value.trim() == "") {
      b += "b";
      inp[index - 1].select();
    } else {
      b += "u";
    }
    u += "u";
  }
  if (u == b) {
    return true;
  } else {
    toastr.error("Isi semua field !");
    return false;
  }
}

function clearInput(inp) {
  for (let index = 0; index < inp.length; index++) {
    inp[index].value = "";
  }
}

function getSelect() {
	$('#id_upk').find('option').remove().end()
	$.ajax({
		dataType: "json",
		url: baseUrl + "admin/user/upk/getUpk",
		success: function (result) {
			console.log(result);
			let response = jQuery.parseJSON(JSON.stringify(result));
			response.forEach(item => {
				$('#id_upk').append("<option value=" + item.id + ">" + item.upk + "</option>");
			})
		}
	})
}

$(document).ready(function(){
  $("#menu-" + menu).addClass('active')
  // $("#tree-" + menu).addClass('active')
  $("#tree-" + menu).addClass('menu-open')
  $("#sub-" + subMenu).addClass('active')
})

$("#btnKeluar").on('click', function(){
  confirmSweet("", 'Yakin ingin Keluar ?').then((result) => {
    // alert(result)
    if (result) {
      $(location).attr('href', baseUrl + 'admin/login/keluar/' + token)
    }
  })
})
