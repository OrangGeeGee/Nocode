<?php
session_start();
require_once 'default.php';

$admin = new Admin();
$admin->display();

?>