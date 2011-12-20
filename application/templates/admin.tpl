{include file="header.tpl" js="admin.js" showMenu=false headingTitle="Admin panelė"}
<div class="bottom_left adminheader" data-help="Pasirinkite objektą, kurio duomenis norėtumėte koreguoti">
{foreach $tables as $key=>$table}
<a href="?table={$key}"
	{if isset($currentTable)&&$currentTable==$key}class='selected'{/if}>{$table}</a>
{/foreach}
</div>

{if isset($currentTable)}
<div class="admincontent">
	<h1 data-help="Objekto pavadinimas, kurį redaguojate" class="top_right">
			{$currentTableCaption}</h1>
	<table data-table="{$currentTable}">
		<thead>
			<tr>
			{foreach $keys as $key}
				<th>{$key}</th>
			{/foreach}
			</tr>
		</thead>
		<tbody>
		<tr>
			{foreach $keys as $key}
				<td><input type="text" name="{$key}" value="" class="insert" /></td>
			{/foreach}
			<td><input type="button" onclick="insert(this);" value="Įterpti naują įrašą" 
			 	data-help="Užpildžius laukelius, spauskite šį mygtuką, kad įterptumėte įrašą." class="bottom_right" /></td>
		</tr>
		{foreach $data as $d}
			{$whereValue=$d.id}
			{$whereField="id"}
			<tr>
				{foreach $d as $k=>$i}
					<td>
						<input type="text"
							data-field="{$k}"
							data-where-value="{$whereValue}"
							data-where-field="{$whereField}"
							data-original-value="{$i}"
							value="{$i}" class="edit" />
					</td>
				{/foreach}
				<td><a href="#" onclick="remove(this);return false;">trinti</a></td>
			</tr>
		{/foreach}
		<tr>
			{foreach $keys as $key}
				<td><input type="text" name="{$key}" value="" class="insert" /></td>
			{/foreach}
			<td><input type="button" onclick="insert(this);" value="Įterpti naują įrašą" /></td>
		</tr>
		</tbody>
	</table>
</div>
{/if}

{include file="footer.tpl"}