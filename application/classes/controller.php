<?php

/**
 * Pagrindinė klasė, kuri atsakinga už template'ų sujungimą su 
 * duomenimis, taip pat už duomenų apdorojimą (arba bent jau
 * apdorojimo nukreipimą).
 * Ši klasė yra pati pati pradžia - tuo galime įsitikinti 
 * wwwroot/index.php faile 
 * @author Anthony
 *
 */
class Controller {
	/**
	 * Duomenu bazes kintamasis prienamas visoje programos eigoje
	 * @var db
	 */
	public $db;
    
	/**
	 * Konstruktorius prisijungiantis prie duombazes
	 */
    public function __construct() {
        if(!isset($_SESSION['uid'])) { 
			header("Location: login.php"); die;
        }
        $this->smarty = new MySmarty;
        $this->db = new db();
    }	
    
    public function display() {
    	echo "Hello world";
    	$name = "Antanas";
    	$queryExamples = array(
    		"fetch"=> $this->db->fetch("users", array("name"), array( "id"=>array(">="=>"2") )),
    		"insert"=> $this->db->update("users", array("name"=>"test", "password"=>"gogo")),
    		"update"=> $this->db->update("users", array("password"=>"updated"), array("name"=>"test")),
    		"delete"=> $this->db->delete("users", array("id"=>$this->db->lastinserted)),
    		"simple_query"=> $this->db->q("SELECT * FROM {p}users WHERE name = ?", $name)
		);
		
		echo "<pre>";
    	var_dump($queryExamples);
    	echo "</pre>";
    }
	
}

?>