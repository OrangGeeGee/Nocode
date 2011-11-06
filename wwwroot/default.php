<?php
define('ROOT', getcwd());
function autoload($className) {
    $folders = array("classes", "model", "controller");
    $done = false; $i = 0;
    while(!$done) {
        if(isset($folders[$i])) {
            $fn = ROOT."/".$folders[$i]."/".strtolower($className).".php";
            if(file_exists($fn)) {
                require_once $fn;
                $done = true;
            }      
        } else {
            $done = true;
            //die("No class '{$className}' found");
        }
        $i++;
    }
}
spl_autoload_register('autoload');

?>