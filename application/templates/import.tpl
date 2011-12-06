{include file="header.tpl"}
{if $result_msg}
    <div class="return_msg">
        {$result_msg}
    </div>
{/if}
<form action="?p=import&cmd=insert_from_kb" method="post" id="keyboard_insert_form">
	<p><label>Priemonės kodas: </label><input type="text" name="priemoneskodas"></p>
	<p><label>Nuo: </label><input type="text" name="nuo"></p>
	<p><label>Iki: </label><input type="text" name="iki"></p>
	<p><label>Kiekis: </label><input type="text" name="kiekis"></p>
	<input type="button" value="Įvesti" id="keyboard_insert_submit">
</form>
<br/>
<br/>
<br/>
<form action="?p=import&cmd=insert_from_file" enctype="multipart/form-data" method="post">
	Pasirinkite failą:<br/>
	<input type="file" name="file" size="20" data-help="Pasirinkite failą iš savo kompiuterio, kurio formatas būtų toks: priemone, nuo, iki, kiekis.">
	<input type="submit" value="Išsaugoti" data-help="Pasirinkė failą spustelkite šį mygtuką" />
</form>
{include file="footer.tpl"}