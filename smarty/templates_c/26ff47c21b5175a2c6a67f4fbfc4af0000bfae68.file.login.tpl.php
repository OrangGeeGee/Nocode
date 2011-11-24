<?php /* Smarty version Smarty-3.1.5, created on 2011-11-24 22:13:55
         compiled from "C:\Users\Anthony\GIT\Nocode\wwwroot/../application/templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:286584ecec19a2a4608-03023922%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '26ff47c21b5175a2c6a67f4fbfc4af0000bfae68' => 
    array (
      0 => 'C:\\Users\\Anthony\\GIT\\Nocode\\wwwroot/../application/templates\\login.tpl',
      1 => 1322172834,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '286584ecec19a2a4608-03023922',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4ecec19a38562',
  'variables' => 
  array (
    'badCombination' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ecec19a38562')) {function content_4ecec19a38562($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<title>ŽKS</title>
</head>
<body>

<div id="header">
	<div id="username">
		<span></span>
	</div>
	<div id="top-menu">
		<ul>
			<li>Pagalba</li>	
		</ul>
	</div>
	
</div>
<div id="content">
	<?php if ($_smarty_tpl->tpl_vars['badCombination']->value){?>
		<div class="error">Bloga vartotojo vardo ir slaptažodžio kombinacija</div>
	<?php }?>
	<form id="login-form" action="login.php" method="post">
		<label for="user">Prisijungimo vardas: </label>
			<input type="text" name="name" id="user" /><br />
		<label for="password">Slaptažodis: </label>
			<input type="password" name="password" id="password" /><br />
		<input type="submit" value="Prisijungti" />
	</form>
</div>
<div id="footer">
	&#169; nocode, 2011
</div>
</body>
</html><?php }} ?>