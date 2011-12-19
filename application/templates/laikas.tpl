{include file="header.tpl"}
{if $target eq 'is'}
<div class="is_time">
    <form action="?p=laikas&target=is&action=find_time" method="post">
        <div class="find_time_form">
            <label class="find_time">Pasirinkite informacinę sistemą: </label><select name="is_time" data-help="Pasirinkti norimą IS">{foreach $subdivisions as $subdivision}<option value="{$subdivision.id}"{if isset($selected)}{if $selected eq $subdivision.id} selected{/if}{/if}>{$subdivision.pavadinimas}</option>{/foreach}</select><br/>
        </div>
        <div class="find_time_submit"><input class="login-submit top_right" type="submit" value="Rasti laiką" data-help="Pasirinkus - spausti šį mygtuką ir laukti rezultato"/></div>
        <div style="clear: both">&nbsp;</div>
        <div class="show-advanced">
            <a href="#" class="show-advanced-search bottom_left" data-help="Ieškoti įvedant konkretų laikotarpį">Detali paieška</a>
        </div>
        <div class="advanced-search"{if not $date_from and not $date_till} style="display:none;"{/if}>
             Laikotarpis Nuo:<p class="rounded main-input-block"><input {if isset($date_from)}value="{$date_from}" {/if}name="date_from" class="main-input datepicker is_from bottom_right date_from_qtip" type="text" id="from" size="10" data-help="Ieškomo laikotarpio pradžia"/></p>
             Iki: <p class="rounded main-input-block"><input {if isset($date_till)}value="{$date_till}" {/if}name="date_till" class="main-input datepicker is_till top_right date_till_qtip" type="text" id="until" size="10" data-help="Ieškomo laikotarpio pabaiga"/></p>
        </div>
    </form>
</div>
{else if $target eq 'requalify'}
<div class="is_time">
    <form action="?p=laikas&target=requalify&action=find_time" method="post">
        <div class="find_time_form">
            <label class="find_time">Pasirinkite padalinį: </label><select name="requalify_time" data-help="Pasirinkti norimą padalinį">{foreach $subdivisions as $subdivision}<option value="{$subdivision.id}"{if isset($selected)}{if $selected eq $subdivision.id} selected{/if}{/if}>{$subdivision.pavadinimas}</option>{/foreach}</select><br/>
        </div>
        <div class="find_time_submit"><input class="login-submit top_right" type="submit" value="Rasti laiką" data-help="Pasirinkus - spausti šį mygtuką ir laukti rezultato"/></div>
        <div style="clear: both">&nbsp;</div>
        <div class="show-advanced">
            <a href="#" class="show-advanced-search bottom_left" data-help="Ieškoti įvedant konkretų laikotarpį">Detali paieška</a>
        </div>
        <div class="advanced-search"{if not $date_from and not $date_till} style="display:none;"{/if}>
             Laikotarpis Nuo:<p class="rounded main-input-block"><input {if isset($date_from)}value="{$date_from}" {/if}name="date_from" class="main-input datepicker is_from bottom_right date_from_qtip" type="text" id="from" size="10" data-help="Ieškomo laikotarpio pradžia"/></p>
             Iki: <p class="rounded main-input-block"><input {if isset($date_till)}value="{$date_till}" {/if}name="date_till" class="main-input datepicker is_till top_right date_till_qtip" type="text" id="until" size="10" data-help="Ieškomo laikotarpio pabaiga"/></p>
        </div>
    </form>
</div>        
{else if $target eq 'repair'}
<div class="is_time">
    <form action="?p=laikas&target=repair&action=find_time" method="post">
        <div class="find_time_form">
            <label class="find_time">Pasirinkite padalinį: </label><select name="repair_time" data-help="Pasirinkti norimą padalinį">{foreach $subdivisions as $subdivision}<option value="{$subdivision.id}"{if isset($selected)}{if $selected eq $subdivision.id} selected{/if}{/if}>{$subdivision.pavadinimas}</option>{/foreach}</select><br/>
        </div>
        <div class="find_time_submit"><input class="login-submit top_right" type="submit" value="Rasti laiką" data-help="Pasirinkus - spausti šį mygtuką ir laukti rezultato"/></div>
        <div style="clear: both">&nbsp;</div>
        <div class="show-advanced">
            <a href="#" class="show-advanced-search bottom_left" data-help="Ieškoti įvedant konkretų laikotarpį">Detali paieška</a>
        </div>
        <div class="advanced-search"{if not $date_from and not $date_till} style="display:none;"{/if}>
             Laikotarpis Nuo:<p class="rounded main-input-block"><input {if isset($date_from)}value="{$date_from}" {/if}name="date_from" class="main-input datepicker repair_from bottom_right date_from_qtip" type="text" id="from" size="10" data-help="Ieškomo laikotarpio pradžia"/></p>
             Iki: <p class="rounded main-input-block"><input {if isset($date_till)}value="{$date_till}" {/if}name="date_till" class="main-input datepicker repair_till top_right date_till_qtip" type="text" id="until" size="10" data-help="Ieškomo laikotarpio pabaiga"/></p>
        </div>
    </form>
</div>       
{/if}
{if isset($result)}
    <div class="best_time">
        {$result}
    </div>
{/if}
{include file="footer.tpl"}
