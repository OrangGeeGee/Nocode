<?php /* Smarty version Smarty-3.1.5, created on 2011-12-19 22:50:46
         compiled from "C:\zend\Nocode\wwwroot/../application/templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:134304edbd8b82b4f26-02218989%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a5b50efa4f3d541dd74b0495cafd996c676d799' => 
    array (
      0 => 'C:\\zend\\Nocode\\wwwroot/../application/templates\\index.tpl',
      1 => 1324327554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '134304edbd8b82b4f26-02218989',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4edbd8b83a99c',
  'variables' => 
  array (
    'divisionTotal' => 0,
    'usersTotal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4edbd8b83a99c')) {function content_4edbd8b83a99c($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


Bendroji statistika
<br>
<br>
<div id="total-statistics">
	<p>Per visą laikotarpį padaliniuose apdorotų paraiškų skaičius: <b><?php echo $_smarty_tpl->tpl_vars['divisionTotal']->value;?>
</b></p>
	<p>Per visą laikotarpį IS apdorotų paraiškų skaičius: <b>pakeisti <?php echo $_smarty_tpl->tpl_vars['divisionTotal']->value;?>
</b></p>
	<br>
	<p>Labiausiai apkrautas padalinys šiais metais: <b>padalinio pavadinimas</b></p>
	<p>Labiausiai apkrauta IS šiais metais: <b>IS pavadinimas</b></p>
	<br>
	<p>Registruotų naudotojų: <b><?php echo $_smarty_tpl->tpl_vars['usersTotal']->value;?>
</b></p>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>