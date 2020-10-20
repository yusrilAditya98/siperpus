var url = $(location).attr("href");
var segments = url.split("/");

//membuat nav - link pada sidebar active
$('a.nav-link').each(function () {

	if ($(this).attr('href') == url) {
		$(this).addClass('active')
	}
})

$('ul li a.nav-link').each(function () {

	if ($(this).attr('href') == url) {
		$(this).addClass('active')
		$(this).parent().parent().parent().addClass('menu-open')
		$(this).parent().parent().parent().children().addClass('active')
	}
})

function previewImg() {
	const sampul = document.querySelector('#foto');
	const sampulLabel = document.querySelector('.custom-file-label');
	const imgPreview = document.querySelector('.img-preview');

	sampulLabel.textContent = sampul.files[0].name;

	const fileSampul = new FileReader();
	fileSampul.readAsDataURL(sampul.files[0]);

	fileSampul.onload = function (e) {
		imgPreview.src = e.target.result
	}
}

$('table').on('click', '.ubah-password', function () {
	console.log('cek')
	let id = $(this).data('id')
	$('#ubah_password').val(id)
})

$('#submit_baca_ditempat').on('click', function () {
	let username = $('#username').val()
	let register = $('#register').val()
	let urlSampul = ""
	let data = [];
	$.ajax({
		url: segments[0] + '/' + segments[3] + '/sirkulasi/baca_ditmpt/tambah',
		data: {
			'username': username,
			'register': register,
		},
		method: "post",
		dataType: 'json',
		success: function (result) {
			$('#username').val("")
			$('#register').val("")
			$('.detail-buku').html(``)
			if (result['status'] == true) {
				data = result['message']
				urlSampul = segments[0] + '/' + segments[3] + '/assets/sampul_buku/' + data['sampul']
				$('.detail-buku').html(`
				<div class="col-lg-5">
					<img src="` + urlSampul + `" class="img-thumbnail" alt="" srcset="">
				</div>
				<div class="col-lg-7">
					<p class="text-muted" style="margin-bottom: 1px;">
						Register
					</p>
					<h5>` + data['register'] + `</h5>
					<hr>
					<p class="text-muted" style="margin-bottom: 1px;">
						Judul
					</p>
					<h5>Buku Education</h5>
					<hr>
					<p class="text-muted" style="margin-bottom: 1px;">
						Pengarang
					</p>
					<h5>` + data['pengarang'] + `</h5>
					<hr>
					<p class="text-muted" style="margin-bottom: 1px;">
						Penerbit
					</p>
					<h5>` + data['penerbit'] + `</h5>
					<hr>
					<p class="text-muted" style="margin-bottom: 1px;">
						ISBN
					</p>
					<h5>` + data['isbn'] + `</h5>
					<hr>
				</div>
				`)
			} else {
				$('.detail-buku').html(`<div class="col-lg-12">
				<h6 class="text-center text-danger">` + result['message'] + `</h6>
				</div>`)
			}
		}
	})
})

$(document).ready(function () {
	$('#register').keypress(function (e) {
		if (e.keyCode == 13)
			$('#submit_baca_ditempat').click();
	});
});
