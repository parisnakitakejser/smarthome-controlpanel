$(document).ready(function() {
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });
});

window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(231,233,237)'
};

function onDocumentStart() {
	$('a[data-toggle=modal]').unbind('click');

	$("a[data-toggle=modal]").click(function(e) {
		$('#modalContent').html('');

		var target = $(this).attr('data-target');
		var dataTitle = $(this).attr('data-title');
		var urllink = $(this).attr('href');

    $('#modalContent').load(urllink, function() {
			onDocumentStart();
		});
	});

	$('[data-toggle="popover"]').popover({
		'trigger' : 'hover',
		'container' : 'body',
		'html' : true
	});

	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="modal"]').tooltip();
}

$(function() {
	onDocumentStart();
});
