{include file="header.tpl"}

<form action="" method="post">
	<h2>Istorinio kiekio įvedimas iš klaviatūros</h2>
	<p><label for="priemone">Priemonė: </label><input type="text" id="priemone"></p>
	<p><label for="nuo">Nuo: </label><input type="text" id="nuo"></p>
	<p><label for="firstname">Iki: </label><input type="iki" id="iki"></p>
	<p><label for="kiekis">Kiekis: </label><input type="text" id="kiekis"></p>
	<input type="submit" value="Įvesti">
</form>


<form action="" enctype="multipart/form-data" method="post">
	<h2>Istorinio kiekio įvedimas importuojant excel failą</h2>
	<input type="file" name="file" size="20" data-help="Pasirinkite failą iš savo kompiuterio, kurio formatas būtų toks: priemone, nuo, iki, kiekis.">
	<input type="submit" value="Išsaugoti" data-help="Pasirinkė failą spustelkite šį mygtuką" />
</form>

{include file="footer.tpl"}