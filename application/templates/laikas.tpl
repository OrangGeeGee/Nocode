{include file="header.tpl"}
{if $target eq 'is'}
<div class="is_time">
    <form action="?p=laikas&target=is&action=find_time" method="post">
        <div class="find_time_form">
            <label class="find_time">Pasirinkite informacinę sistemą: </label><select name="is_time" >{foreach $subdivisions as $subdivision}<option value="{$subdivision.id}"{if isset($selected)}{if $selected eq $subdivision.id} selected{/if}{/if}>{$subdivision.pavadinimas}</option>{/foreach}</select><br/>
        </div>
        <div class="find_time_submit"><input type="submit" value="Rasti laiką"/></div>
    </form>
</div>
{else if $target eq 'requalify'}
<div class="is_time">
    <form action="?p=laikas&target=requalify&action=find_time" method="post">
        <div class="find_time_form">
            <label class="find_time">Pasirinkite padalinį: </label><select name="requalify_time" >{foreach $subdivisions as $subdivision}<option value="{$subdivision.id}"{if isset($selected)}{if $selected eq $subdivision.id} selected{/if}{/if}>{$subdivision.pavadinimas}</option>{/foreach}</select><br/>
        </div>
        <div class="find_time_submit"><input type="submit" value="Rasti laiką"/></div>
    </form>
</div>        
{else if $target eq 'repair'}
<div class="is_time">
    <form action="?p=laikas&target=repair&action=find_time" method="post">
        <div class="find_time_form">
            <label class="find_time">Pasirinkite padalinį: </label><select name="repair_time" >{foreach $subdivisions as $subdivision}<option value="{$subdivision.id}"{if isset($selected)}{if $selected eq $subdivision.id} selected{/if}{/if}>{$subdivision.pavadinimas}</option>{/foreach}</select><br/>
        </div>
        <div class="find_time_submit_double"><input type="submit" value="Rasti laiką"/></div>
    </form>
</div>            
{/if}
{if isset($result)}
    <div class="best_time">
        {$result}
    </div>
{/if}
{include file="footer.tpl"}
