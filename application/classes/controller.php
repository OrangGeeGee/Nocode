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
        $this->smarty->assign("userPrivilleges", $_SESSION['user']['privilleges']);
        $this->db = new db();
        date_default_timezone_set("Europe/Helsinki");
    }	
    
    /**
     * Pagrindine paskirtymo funkcija
     */
    public function display() {
    	$tpl = "";
    	$menu = 0;
    	if(!isset($_GET['p'])) {
    		$tpl = "index";
    		$this->smarty->assign('divisionTotal', $this->getTotalDivision());
    		$this->smarty->assign('usersTotal', $this->getTotalUsers());
    		$this->smarty->assign('headingTitle', 'Pagrindinis');
    		// jeigu nera prognozuotu duomenu,
    		// bet yra istoriniu duomenu,
    		// tai atlikti prognoze
    		$prognoze = $this->db->q("SELECT * FROM {p}history WHERE prognoze = 1 LIMIT 0,1");
    		if(empty($prognoze)) {
    			$prognoze = $this->db->q("SELECT * FROM {p}history LIMIT 0,1");
    			if(!empty($prognoze)) {
    				$this->prognozuotiAteiti();
    			}
    		}
                $this->smarty->assign("menu", 0);
    	} elseif($_GET['p']=="ataskaita" || $_GET['p']=="ppp") {
    			$this->smarty->assign('headingTitle', $this->getHeadingTitle());
                if($_GET['p'] == "ataskaita"){
                    if(isset($_GET['src'])){
                        if($_GET['src'] == "padalinys"){
                            $menu = 1;
                        }elseif($_GET['src'] == "is"){
                            $menu = 2;
                        }
                    }else{
                        $menu = 3;
                    }
                }
                if($_GET['p'] == "ppp"){
                    if(isset($_GET['src'])){
                        if($_GET['src'] == "padalinys"){
                            $menu = 4;
                        }elseif($_GET['src'] == "is"){
                            $menu = 5;
                        }
                    }else{
                        $menu = 6;
                    }
                }
    		// Ataskaita pagal apkrova
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
    		$this->smarty->assign("menu", $menu);
    	} elseif($_GET['p']=="import") {
    		// Paraiškų istorinio kiekio pateikimas
    		$this->smarty->assign('headingTitle', $this->getHeadingTitle());
    		$this->paruostiPriemones();
                $this->smarty->assign("menu", 7);
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
    			$this->smarty->assign('headingTitle', $this->getHeadingTitle());
                if($_GET['target'] == "is"){
                    $this->smarty->assign("menu", 8);
                }elseif($_GET['target'] == "requalify"){
                    $this->smarty->assign("menu", 9);
                }else{
                    $this->smarty->assign("menu", 10);
                }
    		// Rasti tinkamiausia laika
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
                    $this->smarty->assign('date_from', '');
                    $this->smarty->assign('date_till', '');
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
	 * @param string $pilnaArPoveikiu Reiksmes "ataskaita" arba "ppp" nurodo ar skaiciuoti poveiki ar rodyti pilna ataskaita
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
     * 'is', kuriame yra visos informacines sistemos
     */    
    public function paruostiIS($varName="is") {
    	$is = $this->db->qKey("id", "SELECT * FROM {p}is");
    	$this->smarty->assign($varName, $is);
    }
        
    /**
     * Prognozuoja pagal turimus duomenis 12 men i priekiu
     * turedamas omenyje, kad yra kas met menesiu tendencija.
     * @author Tadas
     */
    public function prognozuotiAteiti() {
    	// Irasas duombazej turi atrodyti mazdaug sitaip:
    	// INSERT INTO `nocode`.`app_history` (`priemoneskodas`, `nuo`, `iki`, `kiekis`, `prognoze`)
    	// VALUES ('p4-3', '2008-09-01', '2008-09-30', '31', 1);
    	// atkreipk demesi i paskutini vieneta, jis yra ten tam, kad
    	// nusakytu, jog sis irasas yra prognoze. Pradzioj gal net gi galim istrinti
    	// visas senas prognozes
    	
		
		//Istrina senas prognozes
		$this->db->delete("history", array("prognoze"=>1));
    	 	
    	//Paselektinami kiekvienos priemones kodai
    	$history = $this->db->q("SELECT distinct(priemoneskodas) as name FROM app_history");
		
		//Einama per kiekviena priemone
    	for($i = 0; $i < count($history); $i++) {
		
			$query = "INSERT INTO `nocode`.`app_history` (`priemoneskodas`, `nuo`, `iki`, `kiekis`, `prognoze`) VALUES";
			$priemonesKodas = $history[$i]['name'];

			//Gaunama data nuo kurios pradeti prognozavima
			$lastMonth = $this->db->q("SELECT nuo FROM app_history WHERE priemoneskodas = '".$priemonesKodas."' order by nuo DESC LIMIT 1");
			$nextMonth = date('m', strtotime($lastMonth[0]['nuo'])) + 1;
			
			//Visu menesiu prognoze, konkreciai priemonei
			for($men = $nextMonth; $men < ($nextMonth + 12); $men++) {
				
				$queryMen = '';
				$metaiAdd = 0;
				
				if ($men > 12) {
				
					$metaiAdd++;
					$queryMen = $men - 12;
				
				} else $queryMen = $men;
				
				if ($queryMen < 10) {
				
					$queryMen = '0'.$queryMen;
				
				}
				
				$priemone = $this->db->q("SELECT distinct(kiekis), nuo FROM app_history WHERE priemoneskodas = '".$priemonesKodas."' AND nuo like '%-".$queryMen."-01' LIMIT 3");

				$prognozeKiekis = 0;
				$n = 0;
				
				//Sudedami kiekiai, pritaikant keikvienos priemones reiksmesParametra
				for($k = 0; $k < count($priemone); $k++) {
					
					$reiksmesParametras = $k + 1;
					$prognozeKiekis += $priemone[$k]['kiekis'] * $reiksmesParametras;
					$n += $reiksmesParametras;
				
				}
				
				//Isskaiciuojamas prognozes kiekis bei data
				$prognozeKiekis = round($prognozeKiekis / $n);
				$metai = date('Y') + $metaiAdd;
				$data = $metai.'-'.$queryMen;
				
				if ($men != $nextMonth) {
				
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
        if(!empty($_FILES['file']['tmp_name']) && substr($_FILES['file']['name'], strlen($_FILES['file']['name'])-3, 3) == 'xls'){
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
        }else{
            $success = false;
        }
        if($success == true){
            $_SESSION['result_msg'] = 'Duomenys sėkmingai įkelti.';
        } else {
            $_SESSION['result_msg'] = 'Duomenų įkelti nepavyko. Patikrinkite ar tikrai šis failas yra tokio formato kaip pavyzdys.';
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
            if(empty($_POST['date_from']) && !empty($_POST['date_till'])){
                if(substr($_POST['date_till'], 0, 4) == date('Y')){
                    $month_from = date('m');
                    $month_till = substr($_POST['date_till'], 5, 2);
                }else{
                    if(substr($_POST['date_till'], 0, 4) > date('Y')){
                        if(substr($_POST['date_till'], 0, 4) - date('Y') == 1){
                            $month_till = date('m');
                            $month_from = substr($_POST['date_from'], 5, 2);
                        }else{
                            $month_till = 12;
                            $month_from = 0;
                        }
                    }else{
                        $month_till = 12;
                        $month_from = 0;
                    }
                }
            }
            if(!empty($_POST['date_from']) && empty($_POST['date_till'])){
                $month_till = 12;
                $month_from = 0;
            }
            if(!empty($_POST['date_from']) && !empty($_POST['date_till'])){
                if(substr($_POST['date_till'], 0, 4) == substr($_POST['date_from'], 0, 4)){
                    $month_from = substr($_POST['date_from'], 5, 2);
                    $month_till = substr($_POST['date_till'], 5, 2);
                }else{
                    if(substr($_POST['date_till'], 0, 4) > substr($_POST['date_from'], 0, 4)){
                        if(substr($_POST['date_till'], 0, 4) - substr($_POST['date_from'], 0, 4) == 1){
                            $month_till = substr($_POST['date_till'], 5, 2);
                            $month_from = substr($_POST['date_from'], 5, 2);
                        }else{
                            $month_till = 12;
                            $month_from = 0;
                        }
                    }else{
                        $month_till = 12;
                        $month_from = 0;
                    }
                }
            }
            if(empty($_POST['date_from']) && empty($_POST['date_till'])){
                $month_till = 12;
                $month_from = 0;
            }
            //$from
            //3=01-07
            //2=07-15
            //1=15-22
            //0=22-30
            //$till
            //3=22-31
            //2=15-22
            //1=07-15
            //0=01-07
            if(!empty($_POST['date_from'])){
                if(substr($_POST['date_from'], 8, 2) > 22 ){
                    $from = 0;
                }elseif(substr($_POST['date_from'], 8, 2) > 14 ){
                    $from = 1;
                }elseif(substr($_POST['date_from'], 8, 2) > 6 ){
                    $from = 2;
                }else{
                    $from = 3;
                }
            }else{
                $from = 0;
            }
            if(!empty($_POST['date_till'])){
                if(substr($_POST['date_till'], 8, 2) > 22 ){
                    $till = 3;
                }elseif(substr($_POST['date_till'], 8, 2) > 14 ){
                    $till = 2;
                }elseif(substr($_POST['date_till'], 8, 2) > 6 ){
                    $till = 1;
                }else{
                    $till = 0;
                }
            }else{
                $till = 0;
            }

			$best_for = "";
			$best_date_from = "";
            $best_date_until = "";
			$best_stops = 0;
            
            if($_REQUEST['target'] != 'repair'){
                foreach($jobs as $key=>$value){
                    $ok = false;
                    if($from > 0 && $till > 0){
                        if($month_till >= $month_from){
                                if($key <= $month_till && $key >= $month_from){
                                    $ok = true;
                                }
                        }else{
                                if($key <= $month_till || $key >= $month_from){
                                    $ok = true;
                                }
                        }
                    }elseif($from > 0 && $till == 0){
                        if($month_till >= $month_from){
                                if($key < $month_till && $key >= $month_from){
                                    $ok = true;
                                }
                        }else{
                                if($key < $month_till || $key >= $month_from){
                                    $ok = true;
                                }
                        }
                    }elseif($from == 0 && $till > 0){
                        if($month_till >= $month_from){
                                if($key <= $month_till && $key > $month_from){
                                    $ok = true;
                                }
                        }else{
                                if($key <= $month_till || $key > $month_from){
                                    $ok = true;
                                }
                        }
                    }else{
                        if($month_till >= $month_from){
                                if($key < $month_till && $key > $month_from){
                                    $ok = true;
                                }
                        }else{
                                if($key < $month_till || $key > $month_from){
                                    $ok = true;
                                }
                        }
                    }
                    if($ok){
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
                if($best > date('m')){
                    $days = cal_days_in_month(CAL_GREGORIAN, $best, date('Y'));
                }else{
                    $days = cal_days_in_month(CAL_GREGORIAN, $best, (date('Y')+1));
                }
                
                $best_stops = (integer) ($best_time/$days)*7;

                if($target == 'requalify') {
                    $query = "SELECT pavadinimas FROM app_padaliniai WHERE id = '".$_POST['requalify_time']."'";
                    $is = $this->db->q($query);
                    
                	$best_for =  "darbuotojų kvalifikacijos kėlimui";
                }else{
                    $query = "SELECT pavadinimas FROM app_is WHERE id = '".$_POST['is_time']."'";
                    $is = $this->db->q($query);

                	$best_for =  "informacinės sistemos atnaujinimui";
                }
                
				$best_date_from = $best.".";
				$best_date_until = $best.".";
				
				if($best != $month_from && $best != $month_till){
					if($jobs[$next] < $jobs[$prev]){
						$best_date_from .= "15";
						$best_date_until .= "22";
					}else{
						$best_date_from .= "07";
						$best_date_until .= "14";
					}
				}elseif($best == $month_from){
					if($from == '1'){
						if(substr($_POST['date_till'], 5, 2) != '02'){
							$best_date_from .= "23";
							$best_date_until .= "30";
						}else{
							$best_date_from .= "23";
							$best_date_until = $next.".02";
						} 
					}elseif($from == '2'){
						$best_date_from .= "15";
						$best_date_until .= "22";
					}elseif($from == '3'){
						if($jobs[$next] < $jobs[$prev]){
							$best_date_from .= "15";
							$best_date_until .= "22";
						}else{
							$best_date_from .= "07";
							$best_date_until .= "14";
						}
					}
				}else{
					if($till == '1'){
						$best_date_from .= "01";
						$best_date_until .= "07";
					}elseif($till == '2'){
						$best_date_from .= "08";
						$best_date_until .= "15";
					}elseif($till == '3'){
						if($jobs[$next] < $jobs[$prev]){
							$best_date_from .= "15";
							$best_date_until .= "22";
						}else{
							$best_date_from .= "07";
							$best_date_until .= "14";
						}
					}
				}
            }else{
                foreach($jobs as $key=>$value){
                    $ok = false;
                    if($key < 11){
                        $key2 = $key + 2;
                    }elseif($key == '11'){
                        $key2 = '01';
                    }else{
                        $key2 = '02';
                    }
                    if($month_till >= $month_from){
                        if($key == '11' || $key == '12'){
                            if($key+2 < $month_till && $key > $month_from){
                                $ok = true;
                            }
                        }else{
                            if($key2 < $month_till && $key > $month_from){
                                $ok = true;
                            }
                        }
                    }else{
                        if($key == '11' || $key == '12'){
                            if($key2 < $month_till && $key > $month_from){
                                $ok = true;
                            }
                        }else{
                            if($key2 < $month_till || $key > $month_from){
                                $ok = true;
                            }
                        }
                    }
                    if($ok){
                        if($key < 7){
                            $key1 = '0'.($key+1);
                            $key2 = '0'.($key+2);
                            $key3 = '0'.($key+3);
                        }elseif($key == '07'){
                            $key1 = '08';
                            $key2 = '09';
                            $key3 = '10';
                        }elseif($key == '08'){
                            $key1 = '09';
                            $key2 = '10';
                            $key3 = '11';
                        }elseif($key == '09'){
                            $key1 = '10';
                            $key2 = '11';
                            $key3 = '12';
                        }elseif($key == '10'){
                            $key1 = '11';
                            $key2 = '12';
                            $key3 = '01';
                        }elseif($key == '11'){
                            $key1 = '12';
                            $key2 = '01';
                            $key3 = '02';
                        }elseif($key == '12'){
                            $key1 = '01';
                            $key2 = '02';
                            $key3 = '03';
                        }
                        if($key > 2 && $key < 11){
                            if(!isset($best_time)){
                                $best_time = $jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count'];
                                $best_from = $key.'.01';
                                $best_end = $key2.'.01';
                            }else{
                                if($jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count'] < $best_time){
                                    $best_time = $jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count'];
                                    $best_from = $key.'.01';
                                    $best_end = $key2.'.01';
                                }
                            }
                        }elseif($key == '11'){
                            if(!isset($best_time)){
                                $best_time = $jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count'] + $jobs[$key2]['data']/$jobs[$key2]['count']/2;
                                $best_from = $key.'.01';
                                $best_end = $key2.'.15';
                            }else{
                                if($jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count']  + $jobs[$key2]['data']/$jobs[$key2]['count']/2 < $best_time){
                                    $best_time = $jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count']  + $jobs[$key2]['data']/$jobs[$key2]['count']/2;
                                    $best_from = $key.'.01';
                                    $best_end = $key2.'.15';
                                }
                            }
                        }elseif($key == '12'){
                            if(!isset($best_time)){
                                $best_time = $jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count'] + $jobs[$key2]['data']/$jobs[$key2]['count'];
                                $best_from = $key.'.01';
                                $best_end = $key3.'.01';
                            }else{
                                if($jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count']  + $jobs[$key2]['data']/$jobs[$key2]['count'] < $best_time){
                                    $best_time = $jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count']  + $jobs[$key2]['data']/$jobs[$key2]['count'];
                                    $best_from = $key.'.01';
                                    $best_end = $key3.'.01';
                                }
                            }
                        }elseif($key == '01'){
                            if(!isset($best_time)){
                                $best_time = $jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count'] + $jobs[$key2]['data']/$jobs[$key2]['count']*2/3;
                                $best_from = $key.'.01';
                                $best_end = $key2.'.20';
                            }else{
                                if($jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count']  + $jobs[$key2]['data']/$jobs[$key2]['count']*2/3 < $best_time){
                                    $best_time = $jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count']  + $jobs[$key2]['data']/$jobs[$key2]['count']*2/3;
                                    $best_from = $key.'.01';
                                    $best_end = $key2.'.20';
                                }
                            }
                        }elseif($key == '02'){
                            if(!isset($best_time)){
                                $best_time = $jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count'] + $jobs[$key2]['data']/$jobs[$key2]['count']*1/3;
                                $best_from = $key.'.01';
                                $best_end = $key2.'.10';
                            }else{
                                if($jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count']  + $jobs[$key2]['data']/$jobs[$key2]['count']*1/3 < $best_time){
                                    $best_time = $jobs[$key]['data']/$jobs[$key]['count'] + $jobs[$key1]['data']/$jobs[$key1]['count']  + $jobs[$key2]['data']/$jobs[$key2]['count']*1/3;
                                    $best_from = $key.'.01';
                                    $best_end = $key2.'.10';
                                }
                            }
                        }
                    }
                }
                $query = "SELECT pavadinimas FROM app_padaliniai WHERE id = '".$_POST['repair_time']."'";
                $is = $this->db->q($query);
                
                $best_for = "patalpų remontui";
                $best_date_from = $best_from;
                $best_date_until = $best_end;
                $best_stops = (integer)$best_time;
            }
            if(isset($_POST['date_from'])){
                $this->smarty->assign('date_from', $_POST['date_from']);
            }else{
                $this->smarty->assign('date_from', '');
            }
            if(isset($_POST['date_till'])){
                $this->smarty->assign('date_till', $_POST['date_till']);
            }else{
                $this->smarty->assign('date_till', '');
            }
            $final_result = "Tinkamiausias laikotarpis \"{$is[0]['pavadinimas']}\" {$best_for}: {$best_date_from} - {$best_date_until}<br/>Numatomas sustabdytų paraiškų skaičius: ".$best_stops;
            $this->smarty->assign('result', $final_result);
        }
    }
    
    public function getTotalDivision(){
    	$query="SELECT SUM(kiekis) AS count FROM `app_history` WHERE priemoneskodas IN (SELECT kodas FROM app_priemones)";
    	$totalCount = $this->db->q($query);
    	return $totalCount[0]['count'];
    }
	public function getTotalUsers(){
    	$query="SELECT COUNT(*) AS count FROM `app_users`";
    	$totalCount = $this->db->q($query);
    	return $totalCount[0]['count'];
    }
    public function getHeadingTitle(){
    	$arr = explode("?", $_SERVER["REQUEST_URI"]);
    	//return $arr[1];
    	$arr = explode("&", $arr[1]);
    	//return $arr[0];
    	$p = substr($arr[0], 2, strlen($arr[0])-2);
    	
    	$titleArray = array('ataskaita' => 'Ataskaita pagal apkrovą', 'ppp' => 'Paramos priemonių poveikio analizė', 'import' => 'Paraiškų istorinio kiekio pateikimas', 'laikas' => 'Rasti tinkamiausią laiką');
    	
    	return $titleArray[$p];
    }
}

?>
