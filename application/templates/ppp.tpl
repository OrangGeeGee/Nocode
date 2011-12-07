{include file='header.tpl'}
<h1>Paramos priemonių poveikio analizė</h1>

<div id="view-select">
	<a href="" id="table-select">Lentelė</a> |
	<a href="" id="chart-select">Grafikas</a>
	<span class="emptydataset ui-corner-all ui-state-error"">
		Duomenų pagal parinktus kriterijus nerasta
	</span>
</div>
<div id="view"></div>
{*<div id="filters">
	<div id="wrapper">
		<form action="?p=ataskaita&src=padalinys" method="post">
			<div class="update_chart" id="division-select">
				Padaliniai <span class="count" title="Pažymėtų padalinių kiekis">({count($padaliniai)})</span>: 
				<a href="#" id="divisions">pasirinkti</a>
				<div id="select-area">
					<input checked="checked" type="checkbox" class="masterswitch" name="master" value="1" /> Visi<br />
				{foreach $padaliniai as $padalinys}
					<input checked="checked" type="checkbox" class="subdivisions" name="subdivision[{$padalinys.id}]" value="{$padalinys.id}" />
					{$padalinys.pavadinimas}<br />
				{/foreach}
				</div>
			</div>
			<div class="update_chart" id="date-select">
				Laikotarpis Nuo:<input name="date_from" class="datepicker" type="text" id="from" size="10" />
				Iki: <input value="" name="date_till" class="datepicker" type="text" id="until" size="10" />
			</div>
			<div class="update_chart">
				Rodyti duomenis:<br/>
				<input checked="checked" type="radio" name="show_data" value="number"> pagal apdorotą paraiškų skaičių<br/>
				<input type="radio" name="show_data" value="hours"> pagal panaudotas jų apdorojimui valandas<br/>
			</div>
		</form>
	</div>
		<br/>
		<br/>
		<br/>
	<div id="save">
		Išsaugoti duomenų bazėje? <input type="submit" value="Taip" /><input type="submit" value="Ne" />
	</div>
</div>*}

{include file="footer.tpl"}