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
	
	<title>ŽKS</title>
</head>
<body>

<div id="root">
<div id="header">
	<div id="username">
		<span>Sveiki, {$name}</span>
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
	
	<div id="display">