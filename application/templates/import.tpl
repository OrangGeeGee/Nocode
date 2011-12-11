{include file="header.tpl"}
{if $result_msg}
    <div class="return_msg">
        {$result_msg}
    </div>
{/if}
<form action="?p=import&cmd=insert_from_kb" method="post" id="keyboard_insert_form">
	<h2 class="title">Istorinio kiekio įvedimas iš klaviatūros</h2>
	<table cellspacing="0" cellpadding="0">
	<tr><td>Priemonės kodas:</td><td>
	<select name="priemoneskodas" id="priemone">
	{foreach $priemones as $p}
		<option value="{$p.kodas}">{$p.kodas}: {$p.pavadinimas}</option>
	{/foreach}
	</select>
	</td></tr>
	<tr><td>Nuo: </td><td><p class="rounded main-input-block"><input type="text" name="nuo" class="main-input datepicker"></p></td></tr>
	<tr><td>Iki: </td><td><p class="rounded main-input-block"><input type="text" name="iki" class="main-input datepicker"></p></td></tr>
	<tr><td>Kiekis: </td><td><p class="rounded main-input-block"><input type="text" class="main-input" name="kiekis"></p></td></tr>
	</table>
	<input type="button" value="Įvesti" class="login-submit" id="keyboard_insert_submit">
</form>
<br/>
<br/>
<br/>
<form id="import_file_form" action="?p=import&cmd=insert_from_file" enctype="multipart/form-data" method="post">
	<h2 class="title">Istorinio kiekio įvedimas importuojant excel failą</h2>
	<p>
		Ši funkcija leidžia įkelti didelį kiekį duomenų vienu metu.<br />
		Įkelinėti .xls formatu, atsisiųskite failo pavyzdį <a href="example.xls">čia</a>.
	</p>
        <br/>
	<p>	
		<input id="selected_file" class="file-input" type="file" name="file" size="20" data-help="Pasirinkite failą iš savo kompiuterio, kurio formatas būtų toks: priemone, nuo, iki, kiekis." />
		<input id="import_file" type="submit" class="login-submit" name="submit" value="Išsaugoti" data-help="Pasirinkę failą spustelkite šį mygtuką" />
	</p>
</form>
{include file="footer.tpl"}
