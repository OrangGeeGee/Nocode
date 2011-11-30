{include file="header.tpl"}

<script type="text/javascript">
	//infoJSON;
	var chart;
	var selectionData = new Array();
        
		$.getJSON("index.php?ajax&p=ataskaita&divisions={foreach $padaliniai as $padalinys}{if $padalinys.selected}{$padalinys.id},{/if}{/foreach}-1{if $date_from}&date_from={$date_from}{/if}{if $date_till}&date_till={$date_till}{/if}", function(json) {
			var options = {
				chart: {
					renderTo: 'view',
					defaultSeriesType: 'line',
					height:400
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
			
			chart = new Highcharts.Chart(options);
		});
	$(document).ready(function() {
		$("#divisions").click(function(){
			$("#select-area").slideDown("fast"); 
                        return false;
		});
	});
		
</script>

<div id="view-select"><a href="" id="table-select">Lentelė</a> | <a href="" id="chart-select">Grafikas</a></div>
<div id="view"></div>
<div id="filters">
	<div id="wrapper">
                <form action="?p=ataskaita&src=padalinys" method="post">
                    <div class="update_chart" id="division-select">
                            Padaliniai: 
                            <a href="#" id="divisions">pasirinkti</a>
                            <div id="select-area">
                            {foreach $padaliniai as $padalinys}
                                    <input type="checkbox" {if $padalinys.selected}checked="checked" {/if}name="subdivision_{$padalinys@index+1}" value="{$padalinys.id}" />{$padalinys.pavadinimas}<br />
                            {/foreach}
                                    <input type="button" value="Išsaugoti" onclick="$('#select-area').hide();return false;"/>
                            </div>
                    </div>
                    <div class="update_chart" id="date-select">
                            Laikotarpis Nuo:<input {if $date_from}value="{$date_from}" {/if}name="date_from" class="datepicker" type="text" id="from" size="10" />
                            Iki: <input {if $date_till}value="{$date_till}" {/if}name="date_till" class="datepicker" type="text" id="until" size="10" />
                    </div>
                    <div class="update_chart">
                            Rodyti duomenis:<br/>
                            <input {if $show_data neq 'hours'}checked="checked" {/if}type="radio" name="show_data" value="number"> pagal apdorotą paraiškų skaičių<br/>
                            <input {if $show_data eq 'hours'}checked="checked" {/if}type="radio" name="show_data" value="hours"> pagal panaudotas jų apdorojimui valandas<br/>
                    </div>
                    <input type="submit" class="update_submit" value="Atnaujinti" name="update_chart"/>
                </form>
	</div>
        <br/>
        <br/>
        <br/>
	<div id="save">
		Išsaugoti duomenų bazėje? <input type="submit" value="Taip" /><input type="submit" value="Ne" />
	</div>
</div>

{include file="footer.tpl"}