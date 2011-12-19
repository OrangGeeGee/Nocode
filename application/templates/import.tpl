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
        <tr><td>Nuo: </td><td><p class="rounded main-input-block"><input type="text" name="nuo" class="main-input datepicker top_right" data-help="Įvedamų duomenų laikotarpio pradžios data"></p></td></tr>
        <tr><td>Iki: </td><td><p class="rounded main-input-block"><input type="text" name="iki" class="main-input datepicker" data-help="Įvedamų duomenų laikotarpio pabaigos data"></p></td></tr>
        <tr><td>Kiekis: </td><td><p class="rounded main-input-block"><input type="text" class="main-input top_right" name="kiekis" data-help="Įvedamų paraiškų kiekis"></p></td></tr>
    </table>
    <input type="button" value="Įvesti" class="login-submit" id="keyboard_insert_submit" data-help="Įvedus duomenis spausti šį mygtuką">
</form>
<div class="keyboard_import_error"></div>
<br/>
<br/>
<br/>
<h2 class="title">Istorinio kiekio įvedimas importuojant excel failą</h2>
<p>
    Ši funkcija leidžia įkelti didelį kiekį duomenų vienu metu.<br />
    Įkelinėti .xls formatu, atsisiųskite failo pavyzdį <a href="example.xls">čia</a>.
</p>
<br/>
<p>	
<form id="file_import_form" action="?p=import&cmd=insert_from_file" enctype="multipart/form-data" method="post">
    <input id="selected_file" class="file-input" type="file" name="file" size="20" data-help="Pasirinkite failą iš savo kompiuterio, kurio formatas būtų toks: priemone, nuo, iki, kiekis." />
    <input id="fake_file" />
    <input id="search_button" type="button" value="Ieškoti failo" class="login-submit"/>
    <input id="import_file" type="submit" class="login-submit" value="Išsaugoti" data-help="Pasirinkę failą spustelkite šį mygtuką" />
</form>
</p>
<div class="import_error"></div>
{include file="footer.tpl"}
