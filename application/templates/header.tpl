<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	{if isset($js)}<script src="js/{$js}" type="text/javascript"></script>{/if}
        <!--[if lt IE 9]>
	<script src="js/dd_roundies.js"></script>
        <script>
          DD_roundies.addRule('.rounded', '5px');
        DD_roundies.addRule('.rounded-big', '10px');
        </script>
        <![endif]-->
	<title>ŽKS</title>
</head>
<body>

<div id="root">
<div id="header" class="rounded">
	<div id="username">
		<span>Sveiki, {$name}</span>
	</div>
	<div id="top-menu">
		<a href="index.php">Grįžti į pradžią</a> |
		<a href="#help" id="helpanchor">Pagalba</a> |
		<a href="login.php?logout">Atsijungti</a>
	</div>
	
</div>
<div id="content">
	<div id="main-menu" class="rounded white">
		<ul>
			<li><div class="first-level">Ataskaita pagal apkrovą</div>
				<ul class="bottom-line">
					<li><a href="?p=ataskaita&src=padalinys">Padalinių apkrova</a></li>
					<li><a href="?p=ataskaita&src=is">IS apkrova</a></li>
					<li><a href="?p=ataskaita">Bendra apkrova</a></li>
				</ul>
			</li>
			<li><div class="first-level">Paramos priemonių poveikio analizė</div>
				<ul class="bottom-line">
				<!-- ppp = paramos priemoniu poveikis -->
					<li><a href="?p=ppp&src=padalinys">Poveikio padaliniams analizė</a></li>
					<li><a href="?p=ppp&src=is">Poveikio IS analizė</a></li>
					<li><a href="?p=ppp">Bendra poveikių analizė</a></li>
				</ul>
			</li>
		    <li><div class="first-level">Paraiškų istorinio kiekio pateikimas</div>
				<ul class="bottom-line">
					<li><a href="?p=import">Įvesti duomenis</a></li>
				</ul>
			</li>
			<li><div class="first-level">Rasti tinkamiausią laiką</div>
				<ul>
					<li><a href="?p=laikas&target=is">IS atnaujinimui</a></li>
					<li><a href="?p=laikas&target=requalify">Kvalifikacijos kėlimui</a></li>
					<li><a href="?p=laikas&target=repair">Patalpų remontui</a></li>
				</ul>
			</li>
		</ul>
	</div>
	
	<div id="display" class="rounded white">