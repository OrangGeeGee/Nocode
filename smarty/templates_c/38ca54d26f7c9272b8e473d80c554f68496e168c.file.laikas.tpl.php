<?php /* Smarty version Smarty-3.1.5, created on 2011-12-12 18:27:42
         compiled from "C:\zend\Nocode\wwwroot/../application/templates\laikas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:176034ee62b7e792d72-23222191%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38ca54d26f7c9272b8e473d80c554f68496e168c' => 
    array (
      0 => 'C:\\zend\\Nocode\\wwwroot/../application/templates\\laikas.tpl',
      1 => 1323706374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '176034ee62b7e792d72-23222191',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'target' => 0,
    'subdivisions' => 0,
    'subdivision' => 0,
    'selected' => 0,
    'date_from' => 0,
    'date_till' => 0,
    'result' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4ee62b7eaf3bb',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ee62b7eaf3bb')) {function content_4ee62b7eaf3bb($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if ($_smarty_tpl->tpl_vars['target']->value=='is'){?>
<div class="is_time">
    <form action="?p=laikas&target=is&action=find_time" method="post">
        <div class="find_time_form">
            <label class="find_time">Pasirinkite informacinę sistemą: </label><select name="is_time" ><?php  $_smarty_tpl->tpl_vars['subdivision'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subdivision']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subdivisions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subdivision']->key => $_smarty_tpl->tpl_vars['subdivision']->value){
$_smarty_tpl->tpl_vars['subdivision']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['subdivision']->value['id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['selected']->value)){?><?php if ($_smarty_tpl->tpl_vars['selected']->value==$_smarty_tpl->tpl_vars['subdivision']->value['id']){?> selected<?php }?><?php }?>><?php echo $_smarty_tpl->tpl_vars['subdivision']->value['pavadinimas'];?>
</option><?php } ?></select><br/>
        </div>
        <div class="find_time_submit"><input class="login-submit" type="submit" value="Rasti laiką"/></div>
        <div style="clear: both">&nbsp;</div>
        <div class="show-advanced">
            <a href="#" onclick="$('.advanced-search').toggle(); return false;">Detali paieška</a>
        </div>
        <div class="advanced-search"<?php if (!$_smarty_tpl->tpl_vars['date_from']->value&&!$_smarty_tpl->tpl_vars['date_till']->value){?> style="display:none;"<?php }?>>
             Laikotarpis Nuo:<p class="rounded main-input-block"><input <?php if (isset($_smarty_tpl->tpl_vars['date_from']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['date_from']->value;?>
" <?php }?>name="date_from" class="main-input datepicker is_from" type="text" id="from" size="10" /></p>
             Iki: <p class="rounded main-input-block"><input <?php if (isset($_smarty_tpl->tpl_vars['date_till']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['date_till']->value;?>
" <?php }?>name="date_till" class="main-input datepicker is_till" type="text" id="until" size="10" /></p>
        </div>
    </form>
</div>
<?php }elseif($_smarty_tpl->tpl_vars['target']->value=='requalify'){?>
<div class="is_time">
    <form action="?p=laikas&target=requalify&action=find_time" method="post">
        <div class="find_time_form">
            <label class="find_time">Pasirinkite padalinį: </label><select name="requalify_time" ><?php  $_smarty_tpl->tpl_vars['subdivision'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subdivision']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subdivisions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subdivision']->key => $_smarty_tpl->tpl_vars['subdivision']->value){
$_smarty_tpl->tpl_vars['subdivision']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['subdivision']->value['id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['selected']->value)){?><?php if ($_smarty_tpl->tpl_vars['selected']->value==$_smarty_tpl->tpl_vars['subdivision']->value['id']){?> selected<?php }?><?php }?>><?php echo $_smarty_tpl->tpl_vars['subdivision']->value['pavadinimas'];?>
</option><?php } ?></select><br/>
        </div>
        <div class="find_time_submit"><input class="login-submit" type="submit" value="Rasti laiką"/></div>
        <div style="clear: both">&nbsp;</div>
        <div class="show-advanced">
            <a href="#" onclick="$('.advanced-search').toggle(); return false;">Detali paieška</a>
        </div>
        <div class="advanced-search"<?php if (!$_smarty_tpl->tpl_vars['date_from']->value&&!$_smarty_tpl->tpl_vars['date_till']->value){?> style="display:none;"<?php }?>>
             Laikotarpis Nuo:<p class="rounded main-input-block"><input <?php if (isset($_smarty_tpl->tpl_vars['date_from']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['date_from']->value;?>
" <?php }?>name="date_from" class="main-input datepicker is_from" type="text" id="from" size="10" /></p>
             Iki: <p class="rounded main-input-block"><input <?php if (isset($_smarty_tpl->tpl_vars['date_till']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['date_till']->value;?>
" <?php }?>name="date_till" class="main-input datepicker is_till" type="text" id="until" size="10" /></p>
        </div>
    </form>
</div>        
<?php }elseif($_smarty_tpl->tpl_vars['target']->value=='repair'){?>
<div class="is_time">
    <form action="?p=laikas&target=repair&action=find_time" method="post">
        <div class="find_time_form">
            <label class="find_time">Pasirinkite padalinį: </label><select name="repair_time" ><?php  $_smarty_tpl->tpl_vars['subdivision'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subdivision']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subdivisions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subdivision']->key => $_smarty_tpl->tpl_vars['subdivision']->value){
$_smarty_tpl->tpl_vars['subdivision']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['subdivision']->value['id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['selected']->value)){?><?php if ($_smarty_tpl->tpl_vars['selected']->value==$_smarty_tpl->tpl_vars['subdivision']->value['id']){?> selected<?php }?><?php }?>><?php echo $_smarty_tpl->tpl_vars['subdivision']->value['pavadinimas'];?>
</option><?php } ?></select><br/>
        </div>
        <div class="find_time_submit"><input class="login-submit" type="submit" value="Rasti laiką"/></div>
        <div style="clear: both">&nbsp;</div>
        <div class="show-advanced">
            <a href="#" onclick="$('.advanced-search').toggle(); return false;">Detali paieška</a>
        </div>
        <div class="advanced-search"<?php if (!$_smarty_tpl->tpl_vars['date_from']->value&&!$_smarty_tpl->tpl_vars['date_till']->value){?> style="display:none;"<?php }?>>
             Laikotarpis Nuo:<p class="rounded main-input-block"><input <?php if (isset($_smarty_tpl->tpl_vars['date_from']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['date_from']->value;?>
" <?php }?>name="date_from" class="main-input datepicker repair_from" type="text" id="from" size="10" /></p>
             Iki: <p class="rounded main-input-block"><input <?php if (isset($_smarty_tpl->tpl_vars['date_till']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['date_till']->value;?>
" <?php }?>name="date_till" class="main-input datepicker repair_till" type="text" id="until" size="10" /></p>
        </div>
    </form>
</div>       
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['result']->value)){?>
    <div class="best_time">
        <?php echo $_smarty_tpl->tpl_vars['result']->value;?>

    </div>
<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>