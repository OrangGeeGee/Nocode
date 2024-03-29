{include file="header.tpl" js="chart.js"}

<div id="view-select">
	<a href="#" data-help="Pasirinkti kaip atvaizduoti duomenis, lentele ar grafiku" class="bottom_right" id="table-select">Lentelė</a> |
	<a href="#" id="chart-select">Grafikas</a>
	<span class="emptydataset ui-corner-all ui-state-error"">
		Duomenų pagal parinktus kriterijus nerasta
	</span>
</div>
<div class="view-wrap rounded">
	<div id="view-chart" class="views"></div>
	<div id="view-table" class="views hidden">
<table border="0" cellspacing="0" cellpadding="0">
	<caption></caption>
	<thead>
		<tr>
			<th></th>
		</tr>
	</thead>
	<tbody>
	
	</tbody>
</table>	
	</div>
</div>
<div id="filters">
	<div id="wrapper">
		<input type="hidden" id="p" value="{$smarty.get.p}" />
		<input type="hidden" id="src" value="{$src}" />
		{if $src!=""}
		<div class="update_chart" id="division-select">
			{if $src=="is"}Informacinės sistemos{else}Padaliniai{/if}
			<span class="count" title="PaÅ¾ymÄ—tÅ³ objektÅ³ kiekis">({count($checkboxes)})</span>: 
			<a href="#" id="divisions" data-help="Pasirinkti pagal kieno duomenis atvaizduoti">pasirinkti</a>
			<div id="select-area">
				<input checked="checked" type="checkbox" class="masterswitch" name="master" value="1" /> Visi<br />
			{foreach $checkboxes as $box}
				<input checked="checked" type="checkbox" class="subdivisions" name="subdivision[{$box.id}]" value="{$box.id}" />
				{$box.kodas} <i>{$box.pavadinimas}</i><br />
			{/foreach}
			</div>
		</div>
		{/if}
		{if isset($priemones)}
		<div class="update_chart">
			Paramos priemonė:<br />
			<select name="priemone" id="priemone">
			{foreach $priemones as $p}
				<option value="{$p.kodas}">{$p.pavadinimas}</option>				
			{/foreach}  
			</select>			
		</div>
		{/if}
		<div class="update_chart" id="date-select">
			Laikotarpis Nuo:<p class="rounded main-input-block"><input name="date_from" class="main-input datepicker top_right" type="text" id="from" size="10" data-help="Įvedamų duomenų laikotarpio pradžios data"/></p>
			Iki: <p class="rounded main-input-block"><input value="" name="date_till" class="main-input datepicker bottom_right" type="text" id="until" size="10" data-help="Įvedamų duomenų laikotarpio pabaigos data"/></p>
		</div>
		<div class="update_chart">
			Rodyti duomenis:<br/>
			<input class="top_left" data-help="Rodyti duomenis pagal valandas ar pagal apdorojimų skaičių" checked="checked" type="radio" name="show_data" value="number"> pagal apdorotų paraiškų skaičių<br/>
			<input type="radio" name="show_data" value="hours"> pagal panaudotas jų apdorojimui valandas<br/>
		</div>
	</div>
	<div id="debug" class="hidden"></div>
</div>

{include file="footer.tpl"}