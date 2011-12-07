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
    		if(isset($_GET['src'])) {
    			if($_GET['src']=="is") {
	    			$this->paruostiIS("checkboxes");
    			} else {
    				$this->paruostiPadalinius("checkboxes");
    			}
    		} else {
    			$_GET['src'] = "";
    			$checkboxes = array(
    				array("id"=>1, "pavadinimas"=>"Padalinių apkrova","kodas"=>""),
    				array("id"=>2, "pavadinimas"=>"IS apkrova","kodas"=>"")
    			);
    			$this->smarty->assign("checkboxes", $checkboxes);
    		}
    		$this->smarty->assign("src", $_GET['src']);
    	} elseif($_GET['p']=="ppp") {
    		// ppp = paramos priemoniu poveikis
    		// Paramos priemonių poveikio analizė
    		
    	} elseif($_GET['p']=="import") {
    		// Paraiškų istorinio kiekio pateikimas
    		$this->paruostiPriemones();
    		
                if(isset($_GET['cmd'])){
                    if($_GET['cmd'] == 'insert_from_kb'){
                        $this->insertFromKeyboardPost();
                    }elseif($_GET['cmd'] == 'insert_from_file'){
                        $this->insertFromFilePost();
                    }
                }
    		if(isset($_SESSION['result_msg'])){
                    $this->smarty->assign("result_msg", $_SESSION["result_msg"]);
                    unset($_SESSION["result_msg"]);
                }else{
                    $this->smarty->assign("result_msg", '');
                }
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
    	// atvaizdavimas valandomis ir vienetais
    	$src = $_GET['src']; $from = ""; $till = "";
    	if(!empty($_GET['show_data']) && $_GET['show_data']=="hours") {
    		$unit = "val.";
    		$hours = "*pp.valandos";
    	} else {
    		$unit = "vnt.";
    		$hours = "";
    	}
    	
        if(!empty($_GET['date_from'])){
            $from = " AND ist.nuo >= '".$_GET['date_from']."'";
        } else {
            $from = " AND ist.nuo >= '".date('Y')."-01-01'";
        }
        if(!empty($_GET['date_till'])){
            $till = " AND ist.iki <= '".$_GET['date_till']."'";
        }
        
        $padaliniuquery =
    		"SELECT pad.kodas, pad.pavadinimas, pp.priemoneskodas, SUM(ist.kiekis){$hours} as kiekis, ist.nuo ".
			"FROM app_padaliniai as pad, app_priemonepadaliniai as pp, app_history as ist ".
			"WHERE pad.kodas = pp.padaliniokodas".$from.$till." AND ist.priemoneskodas = pp.priemoneskodas ".
    		( $src=="padalinys" ? "AND pad.id IN ({$_GET['checked']}) " : "" ).
			"GROUP BY pad.kodas, ist.nuo";
    	$isquery =
    		"SELECT inf.kodas, inf.pavadinimas, pp.priemoneskodas, SUM(ist.kiekis){$hours} as kiekis, ist.nuo ".
			"FROM app_padaliniai as pad, app_priemonepadaliniai as pp, app_history as ist, app_ispadaliniai as infsys, app_is as inf ".
			"WHERE infsys.iskodas = inf.kodas AND infsys.padaliniokodas = pad.kodas AND pad.kodas = pp.padaliniokodas".$from.$till." AND ist.priemoneskodas = pp.priemoneskodas ".
    		( $src!="" ? "AND inf.id IN ({$_GET['checked']}) " : "" ).
			"GROUP BY infsys.iskodas, ist.nuo";	
    		
    	if($src=="is") {
    		$title = "Informacinių Sistemų apkrova";
    		$rawdata = $this->db->qKey(array("kodas","nuo"), $isquery);
    		$data = $this->gautiAtasaitaSuvirskinta($rawdata);
    	} elseif($src=="padalinys") {
    		$title = "Padalinių apkrova";
    		$rawdata = $this->db->qKey(array("kodas","nuo"), $padaliniuquery);
    		$data = $this->gautiAtasaitaSuvirskinta($rawdata);
    	} else {
    		$title = "Bendra apkrova";
    		$rawdata = $this->db->qKey(array("kodas","nuo"), $padaliniuquery);
    		$rawisdata = $this->db->qKey(array("kodas","nuo"), $isquery);
    		$padaliniudata = $this->gautiAtasaitaSuvirskinta($rawdata);
    		$isdata = $this->gautiAtasaitaSuvirskinta($rawisdata);
    		$data = array(
    			array(
    				"name"=>"Padlinių apkrova",
    				"data"=>$this->gautiAtaskaitosSuvirskintaSuplota($padaliniudata)
    			),
    			array(
    				"name"=>"Informacinių Sistemų apkrova",
    				"data"=>$this->gautiAtaskaitosSuvirskintaSuplota($isdata)
    			)    			
    		);
    	}
    	$xAxis = $this->gautiAtasaitosXAxis($rawdata);

    		
    	ob_start();
    	var_dump($this->db->lasterror, $this->db->lastquery);
    	$c = ob_get_contents();
    	ob_end_clean();
    		
		$return = array(
			"unit"=>$unit,
			"title"=>$title,
			"yCaption"=>"Apdorotų paraiškų skaičius ($unit)",
			"xAxis"=>$xAxis,
			"data"=>$data,
			"debug"=>$c
		);
		echo json_encode($return);
    }
    private function gautiAtasaitosXAxis($ataskaitaIsDB) {
        $xAxis = array();
    	
    	if(is_array($ataskaitaIsDB)) {
    		$datapoints = array_shift($ataskaitaIsDB);
    		foreach($datapoints as $point) {
    			$xAxis[] = $point["nuo"];
    		}
    	}
    	return $xAxis;    	
    }
    private function gautiAtasaitaSuvirskinta($ataskaitaIsDB) {
        $data = array();
    	
    	if(is_array($ataskaitaIsDB)) {
    		foreach($ataskaitaIsDB as $padalinys=>$datapoints) {
    			$tmp = array();
    			foreach($datapoints as $point) {
    				$tmp[] = intval($point["kiekis"]);
    			}
    			$data[] = array(
    				"name"=>$padalinys." ".$point["pavadinimas"],
    				"data"=>$tmp
    			); 
    		}
    	}
    	return $data;
    }
    private function gautiAtaskaitosSuvirskintaSuplota($data) {
    	$result = array();
    	
    	if(is_array($data))
    		foreach($data as $datapoint) {
    			foreach($datapoint["data"] as $index=>$atom) {
    				if(!isset($result[$index])) {
    					$result[$index] = $atom;
    				} else $result[$index]+=$atom;
    			}
    		}
    		
    	return $result;
    }
    
    /**
     * Template variklyje Smarty atsiranda kintamasis
     * 'padaliniai', kuriame yra visi padaliniai
     */
    public function paruostiPadalinius($varName="padaliniai") {
    	$padaliniai = $this->db->qKey("id", "SELECT * FROM {p}padaliniai");
    	$this->smarty->assign($varName, $padaliniai);
    }
    /**
     * Template variklyje Smarty atsiranda kintamasis
     * 'priemones', kuriame yra visos priemones
     */    
    public function paruostiPriemones() {
    	$priemones = $this->db->qKey("id", "SELECT * FROM {p}priemones");
    	$this->smarty->assign("priemones", $priemones);
    }
    /**
     * Template variklyje Smarty atsiranda kintamasis
     * 'is', kuriame yra visos informacinės sistemos
     */    
    public function paruostiIS($varName="is") {
    	$is = $this->db->qKey("id", "SELECT * FROM {p}is");
    	$this->smarty->assign($varName, $is);
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
    	list($history) = $this->db->qKey("SELECT count(id) as count FROM app_history");
    	$history["count"];
    }
    
    public function insertFromKeyboardPost() {
    	if($this->db->update("history", $_POST)){
            $_SESSION['result_msg'] = 'Duomenys sėkmingai įkelti.';
        }else{
            $_SESSION['result_msg'] = 'Duomenų įkelti nepavyko.';
        }
        header('Location: ?p=import');
        die;
    }
    
    public function insertFromFilePost() {
        require_once APP_PATH.'/classes/reader.php';
        $data = new Spreadsheet_Excel_Reader($_FILES['file']['tmp_name']);
        $import_data = array();
        $success = true;
        foreach($data->sheets as $sheet){
            if($sheet['numRows'] > 1){
                $columns = 0;
                $query = 'INSERT INTO '.$this->db->prefix.'history ('.implode(',', $sheet['cells'][1]).')';
                $query .= ' VALUES ';
                foreach($sheet['cells'] as $key=>$value){
                    if($key != 1){
                        $query .= '("'.implode('","', $value).'"),';
                    }
                }
                if(!$this->db->q(substr($query, 0, strlen($query)-1))) {
                    $success = false;
                }
            }
        }
        if($success == true){
            $_SESSION['result_msg'] = 'Duomenys sėkmingai įkelti.';
        } else {
            $_SESSION['result_msg'] = 'Duomenų įkelti nepavyko. Patikrinkite ar tikrai šis failas yra tokio formato kaip pavyzdys';
        }
        header('Location: ?p=import');
        die;
    }
}

?>
