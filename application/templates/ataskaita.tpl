{include file="header.tpl"}

<script type="text/javascript">
	//infoJSON;
	var chart;
	var selectionData = new Array();
	function updateView() {
		$.getJSON("index.php?ajax&p=ataskaita", function(json) {
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
	}
	$(document).ready(function() {
		updateView();
		
		$("#divisions").focus(function(){
			$("#select-area").slideDown("fast"); 
		});
		$("#save-selection").click(function(){
			$("#select-area").slideUp("fast");
			$("#select-area input:checked").each(function(){
				selectionData.push($(this).val());
			});
			updateView();
		});
	});
		
</script>

<div id="view-select"><a href="" id="table-select">Lentelė</a> | <a href="" id="chart-select">Grafikas</a></div>
<div id="view"></div>
<div id="filters">
	<div id="wrapper">
		<div id="division-select">
			Padaliniai: 
			<input type="text" id="divisions" size="10" />
			<div id="select-area">
			{foreach $padaliniai as $padalinys}
				<input type="checkbox" value="{$padalinys.id}" />{$padalinys.pavadinimas}<br />
			{/foreach}
				<input type="submit" id="save-selection" value="Išsaugoti" />
			</div>
		</div>
		<div id="date-select">
			Laikotarpis Nuo:<input class="datepicker" type="text" id="from" size="10" />
			Iki: <input class="datepicker" type="text" id="until" size="10" />
		</div>
	</div>
	
	<div id="show-by">
		Rodyti duomenis:<br/>
		<input type="radio" name="group1" value="number"> pagal apdorotą paraiškų skaičių<br/>
		<input type="radio" name="group1" value="hours"> pagal panaudotas jų apdorojimui valandas<br/>
	</div>
	<div id="save">
		Išsaugoti duomenų bazėje? <input type="submit" value="Taip" /><input type="submit" value="Ne" />
	</div>
</div>

{include file="footer.tpl"}