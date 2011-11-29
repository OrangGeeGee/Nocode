<?php
session_start();
require_once 'default.php';

$ctrl = new Controller();
if(isset($_GET['ajax'])) {
	$ctrl->ajax();
} else {
	$ctrl->display();
}

?>