<?php /* Smarty version Smarty-3.1.5, created on 2011-12-20 01:12:25
         compiled from "C:\zend\Nocode\wwwroot/../application/templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77314edbd8b83d1bf3-35091037%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3671eeb3ec9a7f6d6e53cefebd45ad6a53be10e5' => 
    array (
      0 => 'C:\\zend\\Nocode\\wwwroot/../application/templates\\header.tpl',
      1 => 1324336290,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77314edbd8b83d1bf3-35091037',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4edbd8b850004',
  'variables' => 
  array (
    'js' => 0,
    'headingTitle' => 0,
    'name' => 0,
    'menu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4edbd8b850004')) {function content_4edbd8b850004($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include 'C:\\zend\\Nocode\\smarty\\plugins\\modifier.capitalize.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<link href="css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<script src="js/highcharts.js" type="text/javascript"></script>
        <script src="js/jquery.qtip.js" type="text/javascript"></script>
	<script src="js/modules/exporting.js" type="text/javascript"></script>
	<script src="js/index.js" type="text/javascript"></script>
	<?php if (isset($_smarty_tpl->tpl_vars['js']->value)){?><script src="js/<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
" type="text/javascript"></script><?php }?>
        <!--[if lt IE 9]>
	<script src="js/dd_roundies.js"></script>
        <script>
          DD_roundies.addRule('.rounded', '5px');
        DD_roundies.addRule('.rounded-big', '10px');
        </script>
        <![endif]-->
        <!--[if IE 8]>
        <link rel="stylesheet" href="css/ie8.css" type="text/css" />
        <![endif]-->
        <!--[if IE 7]>
        <link rel="stylesheet" href="css/ie7.css" type="text/css" />
        <![endif]-->
	<title>Nocode - <?php echo $_smarty_tpl->tpl_vars['headingTitle']->value;?>
</title>
</head>
<body>
    <div class="background">&nbsp;</div>
<!--[if lte IE 8]><div id="IElte8"><![endif]--> 
<div id="header">
	<div id="username">
		<span>Sveiki, <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['name']->value);?>
</span>
	</div>
	<div id="top-menu">
		<a href="index.php">Grįžti į pradžią</a> |
		<a href="#help" onclick="return false;" id="helpanchor"><img class="top_image" src="images/help.png" alt="Pagalba"/></a> |
		<a href="login.php?logout" class="logout_parent"><img class="top_image" src="images/logout.png" alt="Atsijungti"/></a>
	</div>
	
</div>
<div id="root">
<div id="content">
	<div id="main-menu" class="rounded white">
		<ul>
			<li><div class="first-level">Ataskaita pagal apkrovą</div>
				<ul class="bottom-line">
					<li<?php if ($_smarty_tpl->tpl_vars['menu']->value==1){?> class="current_page"<?php }?>><a href="?p=ataskaita&src=padalinys">Padalinių apkrova</a></li>
					<li<?php if ($_smarty_tpl->tpl_vars['menu']->value==2){?> class="current_page"<?php }?>><a href="?p=ataskaita&src=is">IS apkrova</a></li>
					<li<?php if ($_smarty_tpl->tpl_vars['menu']->value==3){?> class="current_page"<?php }?>><a href="?p=ataskaita">Bendra apkrova</a></li>
				</ul>
			</li>
			<li><div class="first-level">Paramos priemonių poveikio analizė</div>
				<ul class="bottom-line">
				<!-- ppp = paramos priemoniu poveikis -->
					<li<?php if ($_smarty_tpl->tpl_vars['menu']->value==4){?> class="current_page"<?php }?>><a href="?p=ppp&src=padalinys">Poveikio padaliniams analizė</a></li>
					<li<?php if ($_smarty_tpl->tpl_vars['menu']->value==5){?> class="current_page"<?php }?>><a href="?p=ppp&src=is">Poveikio IS analizė</a></li>
					<li<?php if ($_smarty_tpl->tpl_vars['menu']->value==6){?> class="current_page"<?php }?>><a href="?p=ppp">Bendra poveikių analizė</a></li>
				</ul>
			</li>
		    <li><div class="first-level">Paraiškų istorinio kiekio pateikimas</div>
				<ul class="bottom-line">
					<li<?php if ($_smarty_tpl->tpl_vars['menu']->value==7){?> class="current_page"<?php }?>><a href="?p=import">Įvesti duomenis</a></li>
				</ul>
			</li>
			<li><div class="first-level">Rasti tinkamiausią laiką</div>
				<ul>
					<li<?php if ($_smarty_tpl->tpl_vars['menu']->value==8){?> class="current_page"<?php }?>><a href="?p=laikas&target=is">IS atnaujinimui</a></li>
					<li<?php if ($_smarty_tpl->tpl_vars['menu']->value==9){?> class="current_page"<?php }?>><a href="?p=laikas&target=requalify">Kvalifikacijos kėlimui</a></li>
					<li<?php if ($_smarty_tpl->tpl_vars['menu']->value==10){?> class="current_page"<?php }?>><a href="?p=laikas&target=repair">Patalpų remontui</a></li>
				</ul>
			</li>
		</ul>
	</div>
	
	<div id="display" class="rounded white"><?php }} ?>