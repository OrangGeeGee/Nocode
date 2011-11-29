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
	 * Smarty template variklio kintamasis
	 * @var MySmarty
	 */
	private $smarty;
    
	/**
	 * Konstruktorius prisijungiantis prie duombazes
	 */
    public function __construct() {
        if(!isset($_SESSION['uid'])) { 
			header("Location: login.php"); die;
        }
        $this->smarty = new MySmarty;
        $this->smarty->assign("name", $_SESSION['user']['name']);
        $this->db = new db();
    }	
    
    /**
     * Pagrindine paskirtymo funkcija
     */
    public function display() {
    	$tpl = "";
    	if(!isset($_GET['p'])) {
    		$tpl = "index";
    	} elseif($_GET['p']=="ataskaita") {
    		// Ataskaita pagal apkrovą
    		$this->paruostiPadalinius();
    	} elseif($_GET['p']=="ppp") {
    		// ppp = paramos priemoniu poveikis
    		// Paramos priemonių poveikio analizė
    		
    	} elseif($_GET['p']=="import") {
    		// Paraiškų istorinio kiekio pateikimas
    		
    	} elseif($_GET['p']=="laikas") {
    		// Rasti tinkamiausią laiką
    		
    	} else {
    		$this->smarty->assign("url", $_SERVER['REQUEST_URI']);
    		$tpl = "404";
    	}
    	if($tpl == "") { $tpl = $_GET['p']; }
    	
    	$this->smarty->display($tpl.".tpl");
    	
    }
	
    /**
     * Jeigu reikia AJAX informacijos programai, tai kreipiames is javascripto adresu
     * index.php?ajax&... , o apdorojame cia.
     */
    public function ajax() {
    	if(isset($_GET['p'])) {
    		if($_GET['p']=="ataskaita") {
    			$this->rodytiAtaskaita();
    		}
    	}
    	
    }
    
    /**
     * Informacijos grafikui pateikimo funkcija
     */
    public function rodytiAtaskaita() {
    	$query =
    		"SELECT pad.kodas, pp.priemoneskodas, SUM(ist.kiekis) as kiekis, ist.nuo ".
			"FROM app_padaliniai as pad, app_priemonepadaliniai as pp, app_history as ist ".
			"WHERE pad.kodas = pp.padaliniokodas AND ist.priemoneskodas = pp.priemoneskodas AND ist.nuo > '2010-12-30' ".
			"GROUP BY pad.kodas, ist.nuo";
    	
    	$ataskaitosDuomenys = $this->db->qKey(array("kodas","nuo"), $query);
    	$first = true; $xAxis = array();
    	
    	if(is_array($ataskaitosDuomenys))
    		foreach($ataskaitosDuomenys as $padalinys=>$datapoints) {
    			$tmp = array();
    			foreach($datapoints as $point) {
    				$tmp[] = intval($point["kiekis"]);
    				if($first) {
    					$xAxis[] = $point["nuo"];
    				}
    			}
    			$data[] = array(
    				"name"=>$padalinys,
    				"data"=>$tmp
    			); 
    			
    			$first = false;
    		}
    		
		// jeigu duomenu tasku daugiau nei 15, tai praretinti    		
    	if(count($xAxis)>15) {
    	}
    	
		$return = array(
			"unit"=>"vnt.",
			"yCaption"=>"Apdorotų paraiškų skaičius",
			"xAxis"=>$xAxis,
			"data"=>$data
		);
		echo json_encode($return);
    }
    
    /**
     * Template variklyje Smarty atsiranda kintamasis
     * 'padaliniai', kuriame yra visi padaliniai
     */
    public function paruostiPadalinius() {
    	$padaliniai = $this->db->q("SELECT * FROM {p}padaliniai");
    	$this->smarty->assign("padaliniai", $padaliniai);
    }
    
    /**
     * Prognozuoja pagal turimus duomenis 12 men i priekiu
     * turedamas omenyje, kad yra kas met mėnesių tendencija.
     * @author Tadas
     */
    public function prognozuotiAteiti() {
    	// Įrašas duombazėj turi atrodyti maždaug šitaip:
    	// INSERT INTO `nocode`.`app_history` (`priemoneskodas`, `nuo`, `iki`, `kiekis`, `prognoze`)
    	// VALUES ('p4-3', '2008-09-01', '2008-09-30', '31', 1);
    	// atkreipk dėmėsį į paskutinį vienetą, jis yra ten tam, kad
    	// nusakytų, jog šis įrašas yra prognozė. Pradžioj gal net gi galim ištrinti
    	// visas senas prognozes
    	$this->db->delete("history", array("prognoze"=>1));
    	
    	
    	// prognozuoti.... sekmes!
    	
    }
}

?>