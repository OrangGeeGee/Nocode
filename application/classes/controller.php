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
    	} elseif($_GET['p']=="ataskaita" || $_GET['p']=="ppp") {
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
    		$tpl = "ataskaita";
    		$this->smarty->assign("src", $_GET['src']);
    		
    		// ppp = paramos priemoniu poveikis
    		// Papildomos funkcijos paramos priemonių poveikio analizei
    		if($_GET['p']=="ppp") {
    			$paramosPriemones = $this->db->q("SELECT * FROM {p}priemones");
    			$this->smarty->assign("priemones", $paramosPriemones);
    		}
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
    		if(isset($_GET['target'])){
                    $this->smarty->assign("target", $_GET['target']);
                    if($_GET['target'] == 'is'){
                        $subdivisions = $this->db->q("SELECT * FROM {p}is");
                        $this->smarty->assign("subdivisions", $subdivisions);
                        if(isset($_POST['is_time'])){
                            $this->smarty->assign("selected", $_POST['is_time']);
                        }
                    }else{
                        $subdivisions = $this->db->q("SELECT * FROM {p}padaliniai");
                        $this->smarty->assign("subdivisions", $subdivisions);
                        if(isset($_POST['requalify_time'])){
                            $this->smarty->assign("selected", $_POST['requalify_time']);
                        }
                        if(isset($_POST['repair_time'])){
                            $this->smarty->assign("selected", $_POST['repair_time']);
                        }
                    }
                }
                if(isset($_GET['action'])){
                    if($_GET['action'] == 'find_time'){
                        $this->findTime($_GET['target']);
                    }
                }
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
			if($_GET['p']=="ataskaita"||$_GET['p']=="ppp") {
				$this->rodytiAtaskaita($_GET['p']);
			}
		}
		
	}
    
	/**
     * Informacijos grafikui pateikimo funkcija
	 * @param string $pilnaArPoveikiu Reikšmės "ataskaita" arba "ppp" nurodo ar skaičiuoti poveikį ar rodyti pilną ataskaitą
	 */
    public function rodytiAtaskaita($pilnaArPoveikiu) {
    	// atvaizdavimas valandomis ir vienetais
    	$src = $_GET['src']; $from = ""; $till = ""; $pp = "";
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
        
        if(!empty($_GET['priemone'])) $pp = $_GET['priemone'];
        
        
        $padaliniuQuery =
    		"SELECT pad.kodas, pad.pavadinimas, pp.priemoneskodas, SUM(ist.kiekis){$hours} as kiekis, ist.nuo ".
			"FROM app_padaliniai as pad, app_priemonepadaliniai as pp, app_history as ist ".
			"WHERE pad.kodas = pp.padaliniokodas".$from.$till." AND ist.priemoneskodas = pp.priemoneskodas ".
    		( $src=="padalinys" ? "AND pad.id IN ({$_GET['checked']}) " : "" ).
    		( $pp!="" ? "AND ist.priemoneskodas = '{$pp}' " : "" ).
			"GROUP BY pad.kodas, ist.nuo";
    	$isQuery =
    		"SELECT inf.kodas, inf.pavadinimas, pp.priemoneskodas, SUM(ist.kiekis){$hours} as kiekis, ist.nuo ".
			"FROM app_padaliniai as pad, app_priemonepadaliniai as pp, app_history as ist, app_ispadaliniai as infsys, app_is as inf ".
			"WHERE infsys.iskodas = inf.kodas AND infsys.padaliniokodas = pad.kodas AND pad.kodas = pp.padaliniokodas".$from.$till." AND ist.priemoneskodas = pp.priemoneskodas ".
    		( $src!="" ? "AND inf.id IN ({$_GET['checked']}) " : "" ).
    		( $pp!="" ? "AND ist.priemoneskodas = '{$pp}' " : "" ).
			"GROUP BY infsys.iskodas, ist.nuo";	
    		
    	if($src=="is") {
    		$title = ($pp == "" ? "Informacinių Sistemų apkrova" : "Paramos priemonės $pp poveikis Informacinėms Sistemoms");
    		$rawdata = $this->db->qKey(array("kodas","nuo"), $isQuery);
    		$data = $this->gautiAtasaitaSuvirskinta($rawdata);
    	} elseif($src=="padalinys") {
    		$title = "Padalinių apkrova";
    		$rawdata = $this->db->qKey(array("kodas","nuo"), $padaliniuQuery);
    		$data = $this->gautiAtasaitaSuvirskinta($rawdata);
    	} else {
    		$title = "Bendra apkrova";
    		$rawdata = $this->db->qKey(array("kodas","nuo"), $padaliniuQuery);
    		$rawisdata = $this->db->qKey(array("kodas","nuo"), $isQuery);
    		$padaliniudata = $this->gautiAtasaitaSuvirskinta($rawdata);
    		$isdata = $this->gautiAtasaitaSuvirskinta($rawisdata);
    		$data = array(
    			array(
    				"name"=>"Padalinių apkrova",
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
    	
		
		//Istrina senas prognozes
		$this->db->delete("history", array("prognoze"=>1));
    	 	
    	//Paselektinami kiekvienos priemones kodai
    	$history = $this->db->q("SELECT distinct(priemoneskodas) as name FROM app_history");
		
		//Einama per kiekviena priemone
    	for($i = 0; $i < count($history); $i++) {
		
			$query = "INSERT INTO `nocode`.`app_history` (`priemoneskodas`, `nuo`, `iki`, `kiekis`, `prognoze`) VALUES";
			$priemonesKodas = $history[$i]['name'];

			//Visu menesiu prognoze, konkreciai priemonei
			for($men = 1; $men < 13; $men++) {
				
				$queryMen = '';
				if ($men < 10) {
				
					$queryMen = '0'.$men;
				
				} else $queryMen = $men;
				
				$priemone = $this->db->q("SELECT distinct(kiekis), nuo FROM app_history WHERE priemoneskodas = '".$priemonesKodas."' AND nuo like '%-".$queryMen."-01' LIMIT 3");

				$prognozeKiekis = 0;
				$n = 0;
				
				//Sudedami kiekiai, pritaikant keikvienos priemones reiksmesParametra
				for($k = 0; $k < count($priemone); $k++) {
					
					$reiksmesParametras = $k + 1;
					$prognozeKiekis += $priemone[$k]['kiekis'] * $reiksmesParametras;
					$n += $reiksmesParametras;
				
				}
				
				//Isskaiciuojamas prognozes kiekis
				$prognozeKiekis = round($prognozeKiekis / $n);
				$metai = date('Y');
				$data = $metai.'-'.$queryMen;
				
				if ($men != 1) {
				
					$query .= ',';
				
				}
				
				$query .=" ('".$priemonesKodas."', '".$data."-01', '".$data.'-'.date('t', strtotime($data.'-01'))."', '".$prognozeKiekis."', 1)";
				
			}
			
			//Irasas i duomenu baze, uz 12 menesiu
			$this->db->q($query);
			
		}

    }
    
    public function insertFromKeyboardPost() {
    	if($this->db->update("history", $_POST)){
            $_SESSION['result_msg'] = 'Duomenys sėkmingai įkelti.';
        }else{
            $_SESSION['result_msg'] = 'Duomenų įkelti nepavyko.';
        }
        $this->prognozuotiAteiti();
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
		$this->prognozuotiAteiti();
        header('Location: ?p=import');
        die;
    }
    
    public function findTime($target){
        if(isset($_POST['is_time']) || isset($_POST['requalify_time']) || isset($_POST['repair_time'])){
            if(isset($_POST['is_time']) && $target == 'is'){
                $query =
    		"SELECT inf.kodas, inf.pavadinimas, pp.priemoneskodas, SUM(ist.kiekis) as kiekis, ist.nuo ".
			"FROM app_padaliniai as pad, app_priemonepadaliniai as pp, app_history as ist, app_ispadaliniai as infsys, app_is as inf ".
			"WHERE inf.id = '".$_POST['is_time']."' AND infsys.iskodas = inf.kodas AND infsys.padaliniokodas = pad.kodas AND pad.kodas = pp.padaliniokodas AND ist.priemoneskodas = pp.priemoneskodas ".
			"GROUP BY infsys.iskodas, ist.nuo";	
            }elseif(isset($_POST['requalify_time']) && $target == 'requalify'){
                $query =
    		"SELECT pad.kodas, pad.pavadinimas, pp.priemoneskodas, SUM(ist.kiekis) as kiekis, ist.nuo ".
			"FROM app_padaliniai as pad, app_priemonepadaliniai as pp, app_history as ist ".
			"WHERE pad.id = '".$_POST['requalify_time']."' AND pad.kodas = pp.padaliniokodas AND ist.priemoneskodas = pp.priemoneskodas ".
			"GROUP BY pad.kodas, ist.nuo";
            }elseif(isset($_POST['repair_time']) && $target == 'repair'){
                $query =
    		"SELECT pad.kodas, pad.pavadinimas, pp.priemoneskodas, SUM(ist.kiekis) as kiekis, ist.nuo ".
			"FROM app_padaliniai as pad, app_priemonepadaliniai as pp, app_history as ist ".
			"WHERE pad.id = '".$_POST['repair_time']."' AND pad.kodas = pp.padaliniokodas AND ist.priemoneskodas = pp.priemoneskodas ".
			"GROUP BY pad.kodas, ist.nuo";
            }
            $rawdata = $this->db->qKey(array("nuo"), $query);
            $diff = '';
            $jobs = array('01'=>array('data'=>0,'count'=>0),
                            '02'=>array('data'=>0,'count'=>0),
                            '03'=>array('data'=>0,'count'=>0),
                            '04'=>array('data'=>0,'count'=>0),
                            '05'=>array('data'=>0,'count'=>0),
                            '06'=>array('data'=>0,'count'=>0),
                            '07'=>array('data'=>0,'count'=>0),
                            '08'=>array('data'=>0,'count'=>0),
                            '09'=>array('data'=>0,'count'=>0),
                            '10'=>array('data'=>0,'count'=>0),
                            '11'=>array('data'=>0,'count'=>0),
                            '12'=>array('data'=>0,'count'=>0));
            
            foreach($rawdata as $key=>$value){
                if(empty($diff)){
                    $diff = date('Y') - substr($key, 0, 4) + 1;
                }
                $jobs[substr($key, 5, 2)]['data'] = $jobs[substr($key, 5, 2)]['data'] + $value['kiekis']*(-1*(date('Y')-substr($key, 0, 4))+$diff);
                $jobs[substr($key, 5, 2)]['count'] = $jobs[substr($key, 5, 2)]['count'] + 1*(-1*(date('Y')-substr($key, 0, 4))+$diff);
            }
            if($target == 'repair'){
                foreach($jobs as $key=>$value){
                    if($key < 3 || $key > 11){
                        $jobs[$key]['data'] = $jobs[$key]['data']*(3/2);
                    }
                }
            }
            foreach($jobs as $key=>$value){
                if(!isset($best_time)){
                    $best_time = $value['data']/$value['count'];
                    $best = $key;
                }else{
                    if($value['data']/$value['count'] < $best_time){
                        $best_time = $value['data']/$value['count'];
                        $best = $key;
                    }
                }
            }
            $prev = $best-1;
            if($prev == 0){
                $prev = '12';
            }elseif($prev < 10){
                $prev = '0'.$prev;
            }
            $next = $best+1;
            if($next == 13){
                $next = '01';
            }elseif($next < 10){
                $next = '0'.$next;
            }
            if($target == 'repair' && ($best < 3 || $best > 11)){
                 if($jobs[$next] < $jobs[$prev]){
                    $final_result = 'Tinkamiausias laikotarpis informacinės sistemos atnaujinimui yra: '.$best.'.01 - '.$best.'.21';
                }else{
                    $final_result = 'Tinkamiausias laikotarpis informacinės sistemos atnaujinimui yra: '.$prev.'.07 - '.$best.'.01';
                }
            }else{
                if($jobs[$next] < $jobs[$prev]){
                    $final_result = 'Tinkamiausias laikotarpis informacinės sistemos atnaujinimui yra: '.$best.'.01 - '.$best.'.14';
                }else{
                    $final_result = 'Tinkamiausias laikotarpis informacinės sistemos atnaujinimui yra: '.$prev.'.15 - '.$best.'.01';
                }
            }
            $this->smarty->assign('result', $final_result);
        }
    }
}

?>
