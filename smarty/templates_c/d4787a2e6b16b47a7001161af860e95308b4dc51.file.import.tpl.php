<?php /* Smarty version Smarty-3.1.5, created on 2011-12-12 20:15:36
         compiled from "C:\zend\Nocode\wwwroot/../application/templates\import.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30544edbd97a1614a9-86186052%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4787a2e6b16b47a7001161af860e95308b4dc51' => 
    array (
      0 => 'C:\\zend\\Nocode\\wwwroot/../application/templates\\import.tpl',
      1 => 1323713250,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30544edbd97a1614a9-86186052',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4edbd97a27541',
  'variables' => 
  array (
    'result_msg' => 0,
    'priemones' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4edbd97a27541')) {function content_4edbd97a27541($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if ($_smarty_tpl->tpl_vars['result_msg']->value){?>
    <div class="return_msg">
        <?php echo $_smarty_tpl->tpl_vars['result_msg']->value;?>

    </div>
<?php }?>
<form action="?p=import&cmd=insert_from_kb" method="post" id="keyboard_insert_form">
	<h2 class="title">Istorinio kiekio įvedimas iš klaviatūros</h2>
	<table cellspacing="0" cellpadding="0">
	<tr><td>Priemonės kodas:</td><td>
	<select name="priemoneskodas" id="priemone">
	<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['priemones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
		<option value="<?php echo $_smarty_tpl->tpl_vars['p']->value['kodas'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['kodas'];?>
: <?php echo $_smarty_tpl->tpl_vars['p']->value['pavadinimas'];?>
</option>
	<?php } ?>
	</select>
	</td></tr>
	<tr><td>Nuo: </td><td><p class="rounded main-input-block"><input type="text" name="nuo" class="main-input datepicker" data-help="Įvedamų duomenų laikotarpio pradžios data"></p></td></tr>
	<tr><td>Iki: </td><td><p class="rounded main-input-block"><input type="text" name="iki" class="main-input datepicker" data-help="Įvedamų duomenų laikotarpio pabaigos data"></p></td></tr>
	<tr><td>Kiekis: </td><td><p class="rounded main-input-block"><input type="text" class="main-input" name="kiekis" data-help="Įvedamų paraiškų kiekis"></p></td></tr>
	</table>
	<input type="button" value="Įvesti" class="login-submit" id="keyboard_insert_submit" data-help="Įvedus duomenis spausti šį mygtuką">
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
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>