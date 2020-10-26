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


// cek denda pelanggaran
$('#pelanggaran').on('change', function () {
	let pelanggaran = $('#pelanggaran').val();
	console.log(pelanggaran)

	if (pelanggaran != '') {
		$.ajax({
			url: segments[0] + '/' + segments[3] + '/data/denda/get_ajax',
			method: "get",
			dataType: 'json',
			success: function (result) {
				console.log(result)
				let option = '';
				for (var i in result) {
					option += '<option value="' + result[i]['id_denda'] + '">' + result[i]['nama_denda'] + '</option>'
				}
				console.log(option)
				$('#denda').html('' + option)
			}
		})
	} else {
		console.log('cek')
		$('#denda').html('<option value="null">--tidak ada denda--</option>')
	}
})

$('#validasi_peminjaman').on('click', function () {
	let pelanggaran = $('#pelanggaran').val();
	let denda = $('#denda').val();
	if (pelanggaran != '') {
		if (denda != '') {} else {
			return alert('denda harap diisikan')
		}
	}
})

$('#p_username').keyup(function () {
	let username = $('#p_username').val()

	$('#kode_pinjam').html('')
	$.ajax({
		url: segments[0] + '/' + segments[3] + '/sirkulasi/peminjaman/ajax_perpanjangan/' + username,
		method: "get",
		dataType: 'json',
		success: function (result) {
			let data = result['data']
			let option = ''
			if (result['message'] == true) {
				for (var i in data) {
					option = '<option value="' + data[i]['id_sirkulasi'] + '">(' + data[i]['nama'] + ') ' + data[i]['register'] + ' - ' + data[i]['judul_buku'] + '</option>'
				}
				$('#kode_pinjam').html('' + option)
			} else {
				console.log(data)
				$('#kode_pinjam').html('<option value="">-- Pilih Register --</option>')
			}
		}
	})

})
