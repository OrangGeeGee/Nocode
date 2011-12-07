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
        
        $("#keyboard_insert_submit").click(function(){
            var empty = false;
            $("#keyboard_insert_form").find("input[type='text']").each(function(){
                if(!$(this).val()){
                    empty = true;
                }
            });
            if(empty == true){
                alert("Visi laukai privalo būti užpildyti");
            } else {
                $("#keyboard_insert_form").submit();
            }
        });
}
$(function() {
	// inicijuojami iprasti elementai 
	init_common();
	
});
