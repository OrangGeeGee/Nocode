<?php /* Smarty version Smarty-3.1.5, created on 2011-12-04 22:35:06
         compiled from "C:\zend\Nocode\wwwroot/../application/templates\import.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30544edbd97a1614a9-86186052%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4787a2e6b16b47a7001161af860e95308b4dc51' => 
    array (
      0 => 'C:\\zend\\Nocode\\wwwroot/../application/templates\\import.tpl',
      1 => 1322552982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30544edbd97a1614a9-86186052',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4edbd97a27541',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4edbd97a27541')) {function content_4edbd97a27541($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<form action="" method="post">
	<p><label for="priemone">Priemonė: </label><input type="text" id="priemone"></p>
	<p><label for="nuo">Nuo: </label><input type="text" id="nuo"></p>
	<p><label for="firstname">Iki: </label><input type="iki" id="iki"></p>
	<p><label for="kiekis">Kiekis: </label><input type="text" id="kiekis"></p>
	<input type="submit" value="Įvesti">
</form>


<form action="" enctype="multipart/form-data" method="post">
	Pasirinkite failą:<br/>
	<input type="file" name="file" size="20" data-help="Pasirinkite failą iš savo kompiuterio, kurio formatas būtų toks: priemone, nuo, iki, kiekis.">
	<input type="submit" value="Išsaugoti" data-help="Pasirinkė failą spustelkite šį mygtuką" />
</form>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>