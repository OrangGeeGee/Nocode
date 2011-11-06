<?php
// sql failu direktorija 
$dir = 'sql';
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>DB paruošimas</title>
	<style>
	.error, .success {
		margin:5px; padding:5px;	
	}
	.error {
		background:#f00; color: #fff;
	}
	.success {
		background:#0a0; color: #fff;	
	}
	</style>
</head>
<body>
<?php 
if(isset($_GET['file'])) {
	echo date("Y-m-d H:i:s");
	$err = "";
		
	require_once 'default.php';
	$db = new db();
	
	$path = $dir."/".$_GET['file'];
	if(file_exists($path)) {
		$queries = file_get_contents($path);
		$i = 1;
		if($db->multi_query($queries)) {
			while ($db->next_result()) { $i ++; }
			echo "<div class='success'>";
			echo "Komandos ($i) ivykdytos faile `$path` sekmingai<br />";
			echo "</div>";
			if($db->errno) $err = "MySQL error ({$db->errno}): ".$db->error."<br />";
		} else {
			$err = "MySQL error ({$db->errno}): ".$db->error."<br />";
		}
	} else {
		$err = "File `$path` not found"; 
	}
	
	if(!empty($err)) {
		echo "<div class='error'>Vykdant komandas `$path` faile gauta klaida:<br />$err</div>";
	}
}
?>
<p>Spausk ant failo, kad įvykdytum SQL komandas esančias jame.</p>
<?php
$sqlfiles = scandir($dir);
foreach($sqlfiles as $fn) {
	if($fn!=".."&&$fn!=".") {
		echo "<a href='?file=$fn'>$fn</a><br />"; 
	}
}
?>
</body>
</html>
 


