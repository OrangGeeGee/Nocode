$(function() {
    $("[data-help]").each(function(){
        if($(this).hasClass('top_right')){
            $(this).qtip({
                content: {
                    text: $(this).attr('data-help'),
                    prerender: true
                },
                position: { 
                    corner: {
                        target: 'topright',
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
            }else if($(this).hasClass('bottom_right')){
                $(this).qtip({
                content: {
                    text: $(this).attr('data-help'),
                    prerender: true
                },
                position: { 
                    corner: {
                        target: 'bottomright',
                        tooltip: 'topLeft'
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
        }else if($(this).hasClass('bottom_left')){
                $(this).qtip({
                content: {
                    text: $(this).attr('data-help'),
                    prerender: true
                },
                position: { 
                    corner: {
                        target: 'bottomleft',
                        tooltip: 'topRight'
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
        }else{
                $(this).qtip({
                content: {
                    text: $(this).attr('data-help'),
                    prerender: true
                },
                position: { 
                    corner: {
                        target: 'topleft',
                        tooltip: 'bottomRight'
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
        }
    });
    $("#helpanchor").hover(function() {
        $("[data-help]").each(function(){
            if(!$(this).hasClass('date_from_qtip') && !$(this).hasClass('date_till_qtip')){
                $(this).qtip("enable");
            }
        });
        $("#helpoverlay").fadeIn(250);
        $("[data-help]").trigger('mouseover');
    }, function() {
        $("#helpoverlay").fadeOut(250);
        $("[data-help]").trigger('mouseout');
        $("[data-help]").qtip("disable");
    });
    if($(".datepicker").size() > 0){    
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            dayNamesMin: ['S', 'Pr', 'A', 'T', 'K', 'Pn', 'Š'],
            firstDay: 1,
            monthNames: ['Sausis', 'Vasaris', 'Kovas', 'Balandis', 'Gegužė', 'Birželis', 'Liepa', 'Rugpjūtis', 'Rugsėjis', 'Spalis', 'Lapkritis', 'Gruodis'],
            monthNamesShort: ['Sau','Vas','Kov','Bal','Geg','Bir','Lie','Rgp','Rgs','Spa','Lap','Gru'],
            changeMonth: true,
            changeYear: true
        });
        $('.repair_from').change(function(){
            var date_from = $(this).datepicker("getDate");
            var month = date_from.getMonth();
            var year = date_from.getFullYear();
            var next;
            if(month == 11){
                next = 3;
                date_from.setFullYear(year+1);
            }else if(month == 10){
                next = 2;
                date_from.setFullYear(year+1);
            }else if(month == 9){
                next = 1;
                date_from.setFullYear(year+1);
            }else if(month == 8){
                next = 0;
                date_from.setFullYear(year+1);
            }else{
                next = month + 4;
            }
            date_from.setMonth(next);
            $('.repair_till').datepicker("option", "minDate", date_from);
        });
        $('.repair_till').change(function(){
            var date_till = $(this).datepicker("getDate");
            var month = date_till.getMonth();
            var year = date_till.getFullYear();
            var next;
            if(month == 0){
                next = 8;
                date_till.setFullYear(year-1);
            }else if(month == 1){
                next = 9;
                date_till.setFullYear(year-1);
            }else if(month == 2){
                next = 10;
                date_till.setFullYear(year-1);
            }else if(month == 3){
                next = 11;
                date_till.setFullYear(year-1);
            }else{
                next = month - 4;
            }
            date_till.setMonth(next);
            $('.repair_from').datepicker("option", "maxDate", date_till);
        });
        $('.is_from').change(function(){
            var date_from = $(this).datepicker("getDate");
            var month = date_from.getMonth();
            var year = date_from.getFullYear();
            var next;
            if(month == 11){
                next = 1;
                date_from.setFullYear(year+1);
            }else if(month == 10){
                next = 0;
                date_from.setFullYear(year+1);
            }else{
                next = month + 2;
            }
            date_from.setMonth(next);
            $('.is_till').datepicker("option", "minDate", date_from);
        });
        $('.is_till').change(function(){
            var date_till = $(this).datepicker("getDate");
            var month = date_till.getMonth();
            var year = date_till.getFullYear();
            var next;
            if(month == 0){
                next = 10;
                date_till.setFullYear(year-1);
            }else if(month == 1){
                next = 11;
                date_till.setFullYear(year-1);
            }else{
                next = month - 2;
            }
            date_till.setMonth(next);
            $('.is_from').datepicker("option", "maxDate", date_till);
        });
    }
    $('.date_from_qtip').qtip('disable');
    $('.date_till_qtip').qtip('disable');
    $("#keyboard_insert_submit").click(function(){
        var empty = false;
        $("#keyboard_insert_form").find("input[type='text']").each(function(){
            if(!$(this).val()){
                empty = true;
            }
        });
        if(empty == true){
            $('.keyboard_import_error').html('Visi laukai privalo būti užpildyti');
        } else {
            $("#keyboard_insert_form").submit();
        }
    });
	
    $('#import_file').click(function(e){
        e.preventDefault();
        if($('#selected_file').val()){
            $('#file_import_form').submit();
        }else{
            $('.import_error').html('Pasirinkite failą');
        }
    });
    
    $('#login-submit').click(function(e){
        e.preventDefault();
        var empty = false;
        if(!$('#user').val()){
            empty = true;
            if(!$('#user').parent().hasClass('empty')){
                $('#user').parent().addClass('empty');
                $('#user').parent().after('<p class="warning empty-field1">* Privalomas laukas</p>');
            }
        }else{
            if($('#user').parent().hasClass('empty')){
                $('#user').parent().removeClass('empty');
                $('.empty-field1').remove();
            }
        }
        if(!$('#password').val()){
            empty = true;
            if(!$('#password').parent().hasClass('empty')){
                $('#password').parent().addClass('empty');
                $('#password').parent().after('<p class="warning empty-field2">* Privalomas laukas</p>');
            }
        }else{
            if($('#password').parent().hasClass('empty')){
                $('#password').parent().removeClass('empty');
                $('.empty-field2').remove();
            }
        }
        if(empty == false){
            $('#login-form').submit();
        }
    });
    $("[data-help]").qtip("disable");
    $(".show-advanced-search").click(function(){
        if($(".advanced-search:visible").size() > 0){
            $('.date_from_qtip').qtip('disable');
            $('.date_till_qtip').qtip('disable');
            $(".advanced-search").hide();
        }else{
            $('.date_from_qtip').qtip('enable');
            $('.date_till_qtip').qtip('enable');
            $(".advanced-search").show();
        }
        return false;
    });
});
$(document).ready(function() {
	$('#selected_file').change(function() {
		$('#fake_file').val($(this).val());
	});
});
