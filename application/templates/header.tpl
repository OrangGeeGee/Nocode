<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	{if isset($js)}<script src="js/{$js}" type="text/javascript"></script>{/if}
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
	<title>Nocode - {$headingTitle}</title>
</head>
<body>
    <div class="background">&nbsp;</div>
<!--[if lte IE 8]><div id="IElte8"><![endif]--> 
<div id="header">
	<div id="username">
		<span>Sveiki, {$name|capitalize}</span>
	</div>
	<div id="top-menu">
		{if $userPrivilleges==1}<a href="admin.php">Admin panelė</a> |{/if}
		<a href="index.php">Grįžti į pradžią</a> |
		<a href="#help" onclick="return false;" id="helpanchor"><img class="top_image" src="images/help.png" alt="Pagalba"/></a> |
		<a href="login.php?logout" class="logout_parent"><img class="top_image" src="images/logout.png" alt="Atsijungti"/></a>
	</div>
	
</div>
<div id="root">
<div id="content" class="{if (isset($showMenu)&&$showMenu==false)}nomenu{/if}">{if !(isset($showMenu)&&$showMenu==false)} 
	<div id="main-menu" class="rounded white">
		<ul>
			<li><div class="first-level">Ataskaita pagal apkrovą</div>
				<ul class="bottom-line">
					<li{if $menu eq 1} class="current_page"{/if}><a href="?p=ataskaita&src=padalinys">Padalinių apkrova</a></li>
					<li{if $menu eq 2} class="current_page"{/if}><a href="?p=ataskaita&src=is">IS apkrova</a></li>
					<li{if $menu eq 3} class="current_page"{/if}><a href="?p=ataskaita">Bendra apkrova</a></li>
				</ul>
			</li>
			<li><div class="first-level">Paramos priemonių poveikio analizė</div>
				<ul class="bottom-line">
				<!-- ppp = paramos priemoniu poveikis -->
					<li{if $menu eq 4} class="current_page"{/if}><a href="?p=ppp&src=padalinys">Poveikio padaliniams analizė</a></li>
					<li{if $menu eq 5} class="current_page"{/if}><a href="?p=ppp&src=is">Poveikio IS analizė</a></li>
					<li{if $menu eq 6} class="current_page"{/if}><a href="?p=ppp">Bendra poveikių analizė</a></li>
				</ul>
			</li>
		    <li><div class="first-level">Paraiškų istorinio kiekio pateikimas</div>
				<ul class="bottom-line">
					<li{if $menu eq 7} class="current_page"{/if}><a href="?p=import">Įvesti duomenis</a></li>
				</ul>
			</li>
			<li><div class="first-level">Rasti tinkamiausią laiką</div>
				<ul>
					<li{if $menu eq 8} class="current_page"{/if}><a href="?p=laikas&target=is">IS atnaujinimui</a></li>
					<li{if $menu eq 9} class="current_page"{/if}><a href="?p=laikas&target=requalify">Kvalifikacijos kėlimui</a></li>
					<li{if $menu eq 10} class="current_page"{/if}><a href="?p=laikas&target=repair">Patalpų remontui</a></li>
				</ul>
			</li>
		</ul>
	</div>
	{/if}
	<div id="display" class="rounded white">