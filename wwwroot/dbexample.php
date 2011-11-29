<?php
session_start();
require_once 'default.php';
$db = new db();
// Pavyzdziai kaip susikalbeti su duombaze

echo "Hello world";
$name = "Antanas";

$queryExamples = array(
	"fetch"=> $db->fetch("users", array("id","name"), array( "id"=>array(">="=>"2") )),
	"insert"=> $db->update("users", array("name"=>"test", "password"=>"gogo")),
	"update"=> $db->update("users", array("password"=>"updated"), array("name"=>"test")),
	"delete"=> $db->delete("users", array("id"=>$db->lastinserted)),
	"simple_query"=> $db->q("SELECT * FROM {p}users WHERE name = ?", $name)
);

var_dump($queryExamples);
?>