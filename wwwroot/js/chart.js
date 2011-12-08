var chart;

$(document).ready(function() {
	initEvents();	
	updateGraph();
});

/**
 * Grafo atnaujinimo funkcija
 */
function updateGraph() {
    var get = { ajax: 1, p:$("#p").val(), src:$("#src").val() };
    
    get["checked"] = new Array();
    $("#select-area .subdivisions:checked").each(function() {
		get["checked"].push($(this).val());
    });
    get["checked"] = get["checked"].join(",");
    
    var priemone = $("#priemone");
    if(priemone.length>0) get["priemone"] = priemone.val();

    var from = $("#from").val();
    var until = $("#until").val();
    if(from.length>0) get["date_from"] = from;
    if(until.length>0) get["date_till"] = until;

    get["show_data"] = $("input[name='show_data']:checked").val();
    
	//divisions={foreach $padaliniai as $padalinys}{if $padalinys.selected}{$padalinys.id},{/if}{/foreach}-1{if $date_from}&date_from={$date_from}{/if}{if $date_till}&date_till={$date_till}{/if}
    
	$.getJSON("index.php", get, function(json) {
		if(json.debug!=undefined) $("#debug").html(json.debug);
		var options = {
			chart: {
				renderTo: 'view-chart',
				defaultSeriesType: 'line',
				height: 400,
                //width: 700
			},
			credits: { enabled:false },
			title: { text:json.title },
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
//			legend: {
//				enabled:false
//			},
			tooltip: {
				formatter: function() {
					var x = this.x;
					var y = this.y;
		            var s = '<b>'+ x +'</b>';
		            		            
		            $.each(chart.series, function(i, serie) {
		            	$.each(serie.data, function(j, point) {
		            		if(point.category == x && point.y == y) {
		            			s += '<br/>'+ serie.name +': '+
		            			y +' '+json.unit;
		            		}
		            	});
		            });
		            
		            return s;
	                /*return '<b>'+ this.series.name +'</b><br/>'+
					this.x +': '+ this.y +' '+json.unit;*/
				}
			},
			legend: {
		         layout: 'vertical',
		         align: 'right',
		         verticalAlign: 'middle',
		         //x: -10,
		         //y: 100,
		         //borderWidth: 0
		      },
			series: json.data
		};
		
		if(json.data.length==0) {
			$(".emptydataset").show();
		} else {
			$(".emptydataset").hide();
		}
		
		updateTable(json)
		
		chart = new Highcharts.Chart(options);
	});
}
/**
 * Lenteles atnaujinimo funkcija
 * @param response
 */
function updateTable(response) {
	/* Susirandam reikiamas lenteles dalis */
	var table = $("#view-table table");
	var caption = table.find("caption");
	var headerRow = table.find("thead tr");
	var tableBody = table.find("tbody");
	
	/* Resetinam lentele */
	table.find(".dynamic").remove();
	
	
	/* Atnaujinam caption */
	caption.html(response.title+". "+response.yCaption);
	/* Atnaujinam headeri */
	var i, j, str;
	for(i in response.data) {
		str = response.data[i].name;
		
		headerRow.append("<th class='dynamic'>"+str.split(" ")[0]+"</th>");
	}
	/* Atnaujinam body */
	for(i in response.xAxis) {
		str = "<tr class='dynamic'><td class='date'>"+response.xAxis[i]+"</td>";	
		for(j in response.data) {
			str+= "<td>"+response.data[j].data[i]+"</td>";
		}
		str+= "</tr>";
		tableBody.append(str)
	}
	table.find(".dynamic:even").addClass("even");
}
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

function initEvents() {
	$("#table-select").click(function(e) {
		if($("#view-chart").is(":visible")) {
			$(".views").slideToggle();
		}
		e.preventDefault();
	});
	$("#chart-select").click(function(e) {
		if($("#view-table").is(":visible")) {
			$(".views").slideToggle();
		}
		e.preventDefault();
	});
	
	// kad paspaudus bet kur, nei ant menu, padaliniu menu pasisleptu
	$("#divisions").click(function(e) {
		var anchor = $(this);
		var selectarea = $("#select-area");
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
		updateGraph();
	});
	masterswitch.click(function() {
		subdivisions.each(function() {
			$(this).attr("checked", masterswitch.is(':checked'));
		});
		updateSubdivisionCount();
		updateGraph();
	});
	
	$("#filters").find(".subdivisions, input[type='text'], input[type='radio'], select").
		bind("keyup change", function(e) {
			updateGraph();
		});
}