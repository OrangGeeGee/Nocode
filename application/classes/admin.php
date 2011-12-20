<?php

/**
 * Pagrindinė klasė, kuri atsakinga už template'ų sujungimą… su 
 * duomenimis, taip pat už duomenų apdorojimą (arba bent jau
 * apdorojimo nukreipimą).
 * Ši klasė yra pati pati pradžia - tuo galime įsitikinti 
 * wwwroot/index.php faile 
 * @author Anthony
 *
 */
class Admin {
	/**
	 * Duomenu bazes kintamasis prienamas visoje programos eigoje
	 * @var db
	 */
	public $db;
	
	/**
	 * Smarty template variklio kintamasis
	 * @var MySmarty
	 */
	private $smarty;
    
	private $tables;
	
	/**
	 * Konstruktorius prisijungiantis prie duombazes
	 */
    public function __construct() {
        if(!isset($_SESSION['uid'])) { 
			header("Location: login.php"); die;
        }
        $this->smarty = new MySmarty;
        $this->smarty->assign("name", $_SESSION['user']['name']);
        $this->smarty->assign("userPrivilleges", $_SESSION['user']['privilleges']);
        $this->db = new db();
        date_default_timezone_set("Europe/Helsinki");
		$this->tables = array(
    		"users"=>"Vartotojai",
			"priemones"=>"Paramos priemonės",
			"padaliniai"=>"Padaliniai",
			"is"=>"Informacinės sistemos",
			"ispadaliniai"=>"Ryšys tarp inofrmacinių sistemų ir padalinių",
			"priemonepadaliniai"=>"Ryšys tarp paramos priemonių ir padalinių",
			"history"=>"Istoriniai duomenys"
    	);
    }	
    
    /**
     * Pagrindine paskirtymo funkcija
     */
    public function display() {
    	if(isset($_GET['action'])) {
    		$this->perform();
    	} else {
	    	$this->smarty->assign("tables", $this->tables);
	    	
	    	if(isset($_GET['table'])) {
	    		$data = $this->db->fetch($_GET['table'], "*");
	    		$this->smarty->assign("data", $data);
	    		$this->smarty->assign("keys", array_keys($data[0]));
	    		$this->smarty->assign("currentTable", $_GET['table']);
	    		$this->smarty->assign("currentTableCaption", $this->tables[$_GET['table']]);
	    	}
	    	
	    	$this->smarty->display("admin.tpl");
    	}
    }
	
	public function perform() {
		if($_GET['action']=="set") {
			$resp = $this->db->update(
				$_GET['table'],
				array($_GET['field']=>$_GET['value']),
				array($_GET["whereField"]=>$_GET['whereValue']) );
		} elseif($_GET['action']=="insert") {
			$resp = $this->db->update(
				$_GET['table'],
				$_GET['fields']);
		} elseif($_GET['action']=="delete") {
			$resp = $this->db->delete($_GET['table'],
				array($_GET["whereField"]=>$_GET['whereValue']) );
		}
		
		if($resp!=0) echo "Operacija neįvykdyta.";
		if(!empty($this->db->lasterror)) echo $this->db->lasterror;
	}
}

?>