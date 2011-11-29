$(function() {
	// sukuriami iprasti elementai 
	init_common();
	
});

function init_common() {
	$(".datepicker").datepicker({
		dateFormat: 'yy-mm-dd',
		dayNamesMin: ['S', 'Pr', 'A', 'T', 'K', 'Pn', 'Š'],
		firstDay: 1,
		monthNames: ['Sausis', 'Vasaris', 'Kovas', 'Balandis', 'Gegužė', 'Birželis', 'Liepa', 'Rugpjūtis', 'Rugsėjis', 'Spalis', 'Lapkritis', 'Gruodis']
	});
}