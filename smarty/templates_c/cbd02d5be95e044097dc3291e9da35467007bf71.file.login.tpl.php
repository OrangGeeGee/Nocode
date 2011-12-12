<?php /* Smarty version Smarty-3.1.5, created on 2011-12-12 20:16:33
         compiled from "C:\zend\Nocode\wwwroot/../application/templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:317804edbd8a90e4c83-71651258%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cbd02d5be95e044097dc3291e9da35467007bf71' => 
    array (
      0 => 'C:\\zend\\Nocode\\wwwroot/../application/templates\\login.tpl',
      1 => 1323706432,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '317804edbd8a90e4c83-71651258',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4edbd8a929b65',
  'variables' => 
  array (
    'badCombination' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4edbd8a929b65')) {function content_4edbd8a929b65($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
        <script src="js/jquery.qtip.js" type="text/javascript"></script>
        <script src="js/index.js" type="text/javascript"></script>
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
        <title>ŽKS</title>
    </head>
    <body>
        <div class="background">&nbsp;</div>
        <div id="content">
            <div class="login-main rounded-big">
                <div class="login-help" id="helpanchor"><img src="images/help.png" alt="Pagalba"/></div>
                <?php if ($_smarty_tpl->tpl_vars['badCombination']->value){?>
                    <div class="error">Neteisingi prisijungimo duomenys</div>
                <?php }?>
                <form id="login-form" action="login.php" method="post" class="login-form">
                    <label for="user">Prisijungimo vardas: </label><br/>
                    <p class="rounded login-input-block"><input class="login-input" type="text" name="name" id="user" /></p><br />
                    <label for="password">Slaptažodis: </label><br />
                    <p class="rounded login-input-block"><input class="login-input" type="password" name="password" id="password" /></p><br />
                    <input id="login-submit" class="login-submit" type="submit" value="Prisijungti" />
                </form>
            </div>
        </div>
        <div id="footer">
            &#169; NoCode, 2011
        </div>
        <div id="helpoverlay"></div>
    </body>
</html><?php }} ?>