<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	{if $badCombination}
		<div class="error">Bloga vartotojo vardo ir slaptažodžio kombinacija</div>
	{/if}
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
</html>