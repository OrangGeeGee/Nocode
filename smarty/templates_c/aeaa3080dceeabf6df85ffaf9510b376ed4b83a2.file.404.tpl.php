<?php /* Smarty version Smarty-3.1.5, created on 2011-11-28 22:54:34
         compiled from "C:\Users\Anthony\GIT\Nocode\wwwroot/../application/templates\404.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105514ed40fb0af25c4-02463713%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aeaa3080dceeabf6df85ffaf9510b376ed4b83a2' => 
    array (
      0 => 'C:\\Users\\Anthony\\GIT\\Nocode\\wwwroot/../application/templates\\404.tpl',
      1 => 1322520589,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105514ed40fb0af25c4-02463713',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4ed40fb0b36e3',
  'variables' => 
  array (
    'url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ed40fb0b36e3')) {function content_4ed40fb0b36e3($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<h1>Puslapis nerastas 404</h1>
<p>
Puslapis adresu <i><?php echo $_smarty_tpl->tpl_vars['url']->value;?>
</i> nerastas. <br />
Pamėginkite pasiekti tikslą dar kartą.
</p>


<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>