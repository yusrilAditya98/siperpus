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
