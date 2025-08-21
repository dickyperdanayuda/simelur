var path = window.location.pathname.split("/");
// var base_link = window.location.protocol + "//" + window.location.hostname + ":" + window.location.port + "/" + path[1] + "/";
var x;
var n = 0;
var base_link = $("#base_link").val();

function buka_changelog() {
	event.preventDefault();
	$.ajax({
		url: base_link + "Changelog.txt",
		dataType: "text",
		success: function (data) {
			console.log(data);
			var string = data.replace(/\n/g, "<br>");
			$("#pesan_info_ok").html(string);
			$('#info_ok').modal({
				show: true,
				keyboard: false,
				backdrop: 'static'
			});
		}
	});

}

$(document).ready(function () {
	$("#up_passlama").focusout(function () {
		var isi = $(this).val();
		var nama = $(this).attr("nama");
		alert(nama);
		if (isi == "") {
			$(this).prop("tooltiptext", nama + "tidak boleh kosong");
			$(this).tooltip();
		}
	});
});