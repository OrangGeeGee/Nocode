{include file="header.tpl"}
{if $target eq 'is'}
<div class="is_time">
    <form action="?p=laikas&target=is&action=find_time" method="post">
        <div class="find_time_form">
            <label class="find_time">Pasirinkite informacinę sistemą: </label><select name="is_time" >{foreach $subdivisions as $subdivision}<option value="{$subdivision.id}"{if isset($selected)}{if $selected eq $subdivision.id} selected{/if}{/if}>{$subdivision.pavadinimas}</option>{/foreach}</select><br/>
        </div>
        <div class="find_time_submit"><input class="login-submit" type="submit" value="Rasti laiką"/></div>
        <div style="clear: both">&nbsp;</div>
        <div class="show-advanced">
            <a href="#" onclick="$('.advanced-search').toggle(); return false;">Detali paieška</a>
        </div>
        <div class="advanced-search"{if not $date_from and not $date_till} style="display:none;"{/if}>
             Laikotarpis Nuo:<p class="rounded main-input-block"><input {if isset($date_from)}value="{$date_from}" {/if}name="date_from" class="main-input datepicker is_from" type="text" id="from" size="10" /></p>
             Iki: <p class="rounded main-input-block"><input {if isset($date_till)}value="{$date_till}" {/if}name="date_till" class="main-input datepicker is_till" type="text" id="until" size="10" /></p>
        </div>
    </form>
</div>
{else if $target eq 'requalify'}
<div class="is_time">
    <form action="?p=laikas&target=requalify&action=find_time" method="post">
        <div class="find_time_form">
            <label class="find_time">Pasirinkite padalinį: </label><select name="requalify_time" >{foreach $subdivisions as $subdivision}<option value="{$subdivision.id}"{if isset($selected)}{if $selected eq $subdivision.id} selected{/if}{/if}>{$subdivision.pavadinimas}</option>{/foreach}</select><br/>
        </div>
        <div class="find_time_submit"><input class="login-submit" type="submit" value="Rasti laiką"/></div>
        <div style="clear: both">&nbsp;</div>
        <div class="show-advanced">
            <a href="#" onclick="$('.advanced-search').toggle(); return false;">Detali paieška</a>
        </div>
        <div class="advanced-search"{if not $date_from and not $date_till} style="display:none;"{/if}>
             Laikotarpis Nuo:<p class="rounded main-input-block"><input {if isset($date_from)}value="{$date_from}" {/if}name="date_from" class="main-input datepicker is_from" type="text" id="from" size="10" /></p>
             Iki: <p class="rounded main-input-block"><input {if isset($date_till)}value="{$date_till}" {/if}name="date_till" class="main-input datepicker is_till" type="text" id="until" size="10" /></p>
        </div>
    </form>
</div>        
{else if $target eq 'repair'}
<div class="is_time">
    <form action="?p=laikas&target=repair&action=find_time" method="post">
        <div class="find_time_form">
            <label class="find_time">Pasirinkite padalinį: </label><select name="repair_time" >{foreach $subdivisions as $subdivision}<option value="{$subdivision.id}"{if isset($selected)}{if $selected eq $subdivision.id} selected{/if}{/if}>{$subdivision.pavadinimas}</option>{/foreach}</select><br/>
        </div>
        <div class="find_time_submit"><input class="login-submit" type="submit" value="Rasti laiką"/></div>
        <div style="clear: both">&nbsp;</div>
        <div class="show-advanced">
            <a href="#" onclick="$('.advanced-search').toggle(); return false;">Detali paieška</a>
        </div>
        <div class="advanced-search"{if not $date_from and not $date_till} style="display:none;"{/if}>
             Laikotarpis Nuo:<p class="rounded main-input-block"><input {if isset($date_from)}value="{$date_from}" {/if}name="date_from" class="main-input datepicker repair_from" type="text" id="from" size="10" /></p>
             Iki: <p class="rounded main-input-block"><input {if isset($date_till)}value="{$date_till}" {/if}name="date_till" class="main-input datepicker repair_till" type="text" id="until" size="10" /></p>
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
