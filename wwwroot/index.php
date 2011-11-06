<?php
session_start();
require_once 'default.php';

$ctrl = new Controller();
$ctrl->display();
?>