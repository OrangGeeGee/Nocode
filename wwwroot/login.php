<?php

session_start();
require "default.php";
if(isset($_SESSION['uid'])) {
	header("Location: index.php"); die;
}

$badCombination = false;
if(isset($_POST['name'])) {
	$db = new db();
	$user = $db->q("SELECT * FROM {p}users WHERE name = ? AND password = ?", $_POST['name'], $_POST['password']);
	
	// jeigu atitinka nors vienas irasas formos duomenis, tai $user kintamasis yra array'us array'u.
	// kitaip sakant pirmame lygyje yra tik vienas elementas (viena eilute is duombazes)
	// o antrame lygyje yra eiluciu stulpeliai.
	// kadangi mes galime gauti tik viena irasa, tai galime ir tikrinti ar sis kintamasis yra ne tuscias,
	// o veliau kreiptis i $user[0]
	if(!empty($user)) {
		$_SESSION['user'] = $user[0];
		$_SESSION['uid'] = $user[0]["id"];
		header("Location: index.php"); die;
	} else {
		$badCombination = true;
	}
}

$smarty = new MySmarty();
$smarty->assign("badCombination", $badCombination);
$smarty->display("login.tpl");

?>