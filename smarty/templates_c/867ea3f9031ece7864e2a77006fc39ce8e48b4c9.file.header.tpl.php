<?php /* Smarty version Smarty-3.1.5, created on 2011-11-28 23:35:56
         compiled from "C:\Users\Anthony\GIT\Nocode\wwwroot/../application/templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135034ed407bcee43b1-22741499%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '867ea3f9031ece7864e2a77006fc39ce8e48b4c9' => 
    array (
      0 => 'C:\\Users\\Anthony\\GIT\\Nocode\\wwwroot/../application/templates\\header.tpl',
      1 => 1322523355,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '135034ed407bcee43b1-22741499',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4ed407bd01b8e',
  'variables' => 
  array (
    'name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ed407bd01b8e')) {function content_4ed407bd01b8e($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<link href="css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<script src="js/highcharts.js" type="text/javascript"></script>
	<script src="js/modules/exporting.js" type="text/javascript"></script>
	<script src="js/index.js" type="text/javascript"></script>
	
	<title>ŽKS</title>
</head>
<body>

<div id="root">
<div id="header">
	<div id="username">
		<span>Sveiki, <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span>
	</div>
	<div id="top-menu">
		<a href="index.php">Grįžti į pradžią</a> |
		<a href="#help" class="help">Pagalba</a> |
		<a href="login.php?logout">Atsijungti</a>
	</div>
	
</div>
<div id="content">
	<div id="main-menu">
		<ul>
			<li>Ataskaita pagal apkrovą
				<ul>
					<li><a href="?p=ataskaita&src=padalinys">Padalinio apkrova</a></li>
					<li><a href="?p=ataskaita&src=is">IS apkrova</a></li>
					<li><a href="?p=ataskaita">Bendra apkrova</a></li>
				</ul>
			</li>
			<li>Paramos priemonių poveikio analizė
				<ul>
				<!-- ppp = paramos priemoniu poveikis -->
					<li><a href="?p=ppp&src=padalinys">IS poveikių analizė</a></li>
					<li><a href="?p=ppp&src=is">Padalinių apkrovimo poveikių analizė</a></li>
					<li><a href="?p=ppp">Bendra poveikių analizė</a></li>
				</ul>
			</li>
		    <li>Paraiškų istorinio kiekio pateikimas
				<ul>
					<li><a href="?p=import&from=kb">Įvesti duomenis klaviatūra</a></li>
					<li><a href="?p=import&from=file">Importuoti duomenis iš failo</a></li>
				</ul>
			</li>
			<li>Rasti tinkamiausią laiką
				<ul>
					<li><a href="?p=laikas&target=is">IS atnaujinimui</a></li>
					<li><a href="?p=laikas&target=requalify">Kvalifikacijos kėlimui</a></li>
					<li><a href="?p=laikas&target=repair">Patalpų remontui</a></li>
				</ul>
			</li>
		</ul>
	</div>
	
	<div id="display"><?php }} ?>