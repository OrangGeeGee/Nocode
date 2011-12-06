$(function() {
	// inicijuojami iprasti elementai 
	init_common();
	
});

function init_common() {
	$("#helpanchor").hover(function() {
		$("#helpoverlay").show(250);
	}, function() {
		$("#helpoverlay").hide(250);
	});
	
	$(".datepicker").datepicker({
		dateFormat: 'yy-mm-dd',
		dayNamesMin: ['S', 'Pr', 'A', 'T', 'K', 'Pn', 'Š'],
		firstDay: 1,
		monthNames: ['Sausis', 'Vasaris', 'Kovas', 'Balandis', 'Gegužė', 'Birželis', 'Liepa', 'Rugpjūtis', 'Rugsėjis', 'Spalis', 'Lapkritis', 'Gruodis'],
		changeMonth: true,
		changeYear: true
		
	});
}