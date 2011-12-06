var chart;

/**
 * Grafo atnaujinimo funkcija
 */
function updateGraph() {
    var get = { ajax: 1, p:"ataskaita" };
    
    get["divisions"] = new Array();
    $("#select-area .subdivisions:checked").each(function() {
		get["divisions"].push($(this).val());
    });
    get["divisions"] = get["divisions"].join(",");

    var from = $("#from").val();
    var until = $("#until").val();
    if(from.length>0) get["date_from"] = from;
    if(until.length>0) get["date_till"] = until;

    get["show_data"] = $("input[name='show_data']:checked").val();
    
	//divisions={foreach $padaliniai as $padalinys}{if $padalinys.selected}{$padalinys.id},{/if}{/foreach}-1{if $date_from}&date_from={$date_from}{/if}{if $date_till}&date_till={$date_till}{/if}
    
	$.getJSON("index.php", get, function(json) {
		var options = {
			chart: {
				renderTo: 'view',
				defaultSeriesType: 'line',
				height: 400,
                                    width: 700
			},
			credits: { enabled:false },
			title: { text:"Padalinio apkrova" },
			xAxis: {
				categories: json.xAxis,
				labels: {
		            rotation: -45
				}
			},
			
			yAxis: {
				title: {
					text: json.yCaption,
					rotation: 270
				},
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}]
			},
			legend: {
				enabled:false
			},
			tooltip: {
				formatter: function() {
		                return '<b>'+ this.series.name +'</b><br/>'+
						this.x +': '+ this.y +' '+json.unit;
				}
			},
			series: json.data
		};
		
		if(json.data.length==0) {
			$(".emptydataset").show();
		} else {
			$(".emptydataset").hide();
		}
		chart = new Highcharts.Chart(options);
	});
}
$(document).ready(function() {
	$("#divisions").click(function(e) {
		var anchor = $(this);
		var selectarea = $("#select-area");
		// kad paspaudus bet kur, nei ant menu, padaliniu menu pasisleptu
		if(selectarea.is(":hidden")) {
            $(document).bind("click.tmp", function(e) {
            	var target = $(e.target);
            	//if clicking anywhere outside the selectarea
            	if(target.attr("id")!="divisions" && target.closest(selectarea).length <= 0) {
					$(document).unbind("click.tmp");
					$("#select-area").slideUp("fast");
            	} 		            
            });
		} else {
			$(document).unbind("click.tmp");
		}
		selectarea.slideToggle("fast");
        e.preventDefault();
	});
	
	var masterswitch = $("#select-area .masterswitch");
	var subdivisions = $("#select-area .subdivisions");
	subdivisions.click(function() {
		var count = subdivisions.length;
		var checkedcount = subdivisions.filter(":checked").length;
		masterswitch.attr("checked", checkedcount == count);
		updateSubdivisionCount();
	});
	masterswitch.click(function() {
		subdivisions.each(function() {
			$(this).attr("checked", masterswitch.is(':checked'));
		});
		updateSubdivisionCount();
	});
	
	$("#wrapper input").bind("keyup change", function(e) {
		updateGraph();
	});
	
	updateGraph();
});
function updateSubdivisionCount() {
	var countSpan = $("#division-select .count");
	var count = $("#select-area .subdivisions:checked").length;
	countSpan.html("("+count+")");
	if(count>0) {
		countSpan.removeClass("error");
	} else {
		countSpan.addClass("error");
	}
	
}