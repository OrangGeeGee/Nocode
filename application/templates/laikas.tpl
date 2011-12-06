{include file="header.tpl"}

<script type="text/javascript">

	var chart;
	$(document).ready(function() {
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'view',
				defaultSeriesType: 'line',
				marginBottom: 25,
				height:300
			},
			credits: { enabled:false},
			title: { text:"Padalinio apkrova" },
			xAxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
					'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			},
			yAxis: {
				title: {
					text: 'Temperature (°C)'
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
						this.x +': '+ this.y +'°C';
				}
			},
			
			series: [{
				name: 'Tokyo',
				data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
			}, {
				name: 'New York',
				data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
			}, {
				name: 'Berlin',
				data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
			}, {
				name: 'London',
				data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
			}]
		});
		
		$("#from").datepicker({
			dayNames: ['Sekmadienis', 'Pirmadienis', 'Antradienis', 'Trečiadienis', 'Ketvirtadienis', 'Penktadienis', 'Šeštadienis']
		});
		$("#until").datepicker({
			dayNames: ['Sekmadienis', 'Pirmadienis', 'Antradienis', 'Trečiadienis', 'Ketvirtadienis', 'Penktadienis', 'Šeštadienis']
		});
		$("#divisions").focus(function(){
			$("#select-area").slideDown("fast"); 
		});
		$("#save-selection").click(function(){
			$("#select-area").slideUp("fast"); 
		});
	});
		
</script>

<div id="view"></div>
<div id="filters">
	<div id="wrapper">
		<div id="division-select">
			Padaliniai: 
			<input type="text" id="divisions" size="10" />
			<div id="select-area">
				<input type="checkbox" /> Padalinys nr 1<br>
				<input type="checkbox" /> Padalinys nr 2<br>
				<input type="checkbox" /> Padalinys nr 3<br>
				<input type="checkbox" /> Padalinys nr 4<br>
				<input type="checkbox" /> Padalinys nr 5<br>
				<input type="checkbox" /> Padalinys nr 6<br>
				<input type="checkbox" /> Padalinys nr 7<br>
				<input type="submit" id="save-selection" value="Išsaugoti" />
			</div>
		</div>
		<div id="date-select">Laikotarpis Nuo:<input type="text" id="from" size="10" />Iki:<input type="text" id="until" size="10" /></div>
	</div>
</div>
<input type="submit" value="Ieškoti" />
<div id="container" style="width: 100%; height: 400px"></div>

{include file="footer.tpl"}
