{include file="header.tpl"}
{if $result_msg}
    <div class="return_msg">
        {$result_msg}
    </div>
{/if}
<form action="?p=import&cmd=insert_from_kb" method="post" id="keyboard_insert_form">
	<h2>Istorinio kiekio įvedimas iš klaviatūros</h2>
	<table cellspacing="0" cellpadding="0">
	<tr><td>Priemonės kodas:</td><td>
	<select name="priemoneskodas">
	{foreach $priemones as $p}
		<option value="{$p.kodas}">{$p.kodas}: {$p.pavadinimas}</option>
	{/foreach}
	</select>
	</td></tr>
	<tr><td>Nuo: </td><td><input type="text" name="nuo" class="datepicker"></td></tr>
	<tr><td>Iki: </td><td><input type="text" name="iki" class="datepicker"></td></tr>
	<tr><td>Kiekis: </td><td><input type="text" name="kiekis"></td></tr>
	</table>
	<input type="button" value="Įvesti" id="keyboard_insert_submit">
</form>
<br/>
<br/>
<br/>
<form action="?p=import&cmd=insert_from_file" enctype="multipart/form-data" method="post">
	<h2>Istorinio kiekio įvedimas importuojant excel failą</h2>
	<p>
		Ši funkcija leidžia įkelti didelį kiekį duomenų vienu metu.<br />
		Įkelinėti .xls formatu, atsisiųskite failo pavyzdį <a href="example.xls">čia</a>.
	</p>
	<p>	
		<input type="file" name="file" size="20" data-help="Pasirinkite failą iš savo kompiuterio, kurio formatas būtų toks: priemone, nuo, iki, kiekis.">
		<input type="submit" value="Išsaugoti" data-help="Pasirinkę failą spustelkite šį mygtuką" />
	</p>
</form>
{include file="footer.tpl"}
