$(function() {
	$("[data-help]").each(function(){
                    $(this).qtip({
                       content: $(this).attr('data-help'),
                       position: { 
                          corner: {
                             target: 'topleft',
                             tooltip: 'bottomLeft'
                          }
                       },
                       style: { 
                          width: 200,
                          padding: 5,
                          background: '#ffffff',
                          color: 'black',
                          textAlign: 'center',
                          tip: true
                       },
                       show: { 
                           effect: { 
                               type: 'fade' 
                           } 
                       }
                    });
                });
                $("[data-help]").qtip("focus");
	$("#helpanchor").hover(function() {
		$("#helpoverlay").fadeIn(250);
                $("[data-help]").trigger('mouseover');
	}, function() {
		$("#helpoverlay").fadeOut(250);
                $("[data-help]").trigger('mouseout');
	});
	if($(".datepicker").size() > 0){    
	$(".datepicker").datepicker({
		dateFormat: 'yy-mm-dd',
		dayNamesMin: ['S', 'Pr', 'A', 'T', 'K', 'Pn', 'Š'],
		firstDay: 1,
		monthNames: ['Sausis', 'Vasaris', 'Kovas', 'Balandis', 'Gegužė', 'Birželis', 'Liepa', 'Rugpjūtis', 'Rugsėjis', 'Spalis', 'Lapkritis', 'Gruodis'],
		changeMonth: true,
		changeYear: true
	});
        }
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
	
    $('#import_file').click(function(e){
        e.preventDefault();
        if($('#selected_file').val()){
            $('#import_file_form').submit();
        }else{
            alert('Pasirinkite failą');
        }
    });
    
    $('#login-submit').click(function(e){
        e.preventDefault();
        var empty = false;
        if(!$('#user').val()){
            empty = true;
            if(!$('#user').parent().hasClass('empty')){
                $('#user').parent().addClass('empty');
            }
        }else{
            if($('#user').parent().hasClass('empty')){
                $('#user').parent().removeClass('empty');
            }
        }
        if(!$('#password').val()){
            empty = true;
            if(!$('#password').parent().hasClass('empty')){
                $('#password').parent().addClass('empty');
            }
        }else{
            if($('#password').parent().hasClass('empty')){
                $('#password').parent().removeClass('empty');
            }
        }
        if(empty == false){
            $('#login-form').submit();
        }
    });
});
