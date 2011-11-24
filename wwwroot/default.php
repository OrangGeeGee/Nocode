<?php
define('WWW_ROOT', getcwd());
define('APP_PATH', WWW_ROOT . "/../application");
define('SMARTY_PATH', WWW_ROOT . "/../smarty");
define('SMARTY_TEMPLATE_PATH', APP_PATH . "/templates");
define('SMARTY_COMPILED_PATH', SMARTY_PATH . "/templates_c");
define('SMARTY_CACHE_PATH', SMARTY_PATH . "/cache");
define('SMARTY_CONFIG_PATH', SMARTY_PATH . "/configs");

function autoload($className) {
    $folders = array("classes", "model", "controller");
    $done = false; $i = 0;
    while(!$done) {
        if(isset($folders[$i])) {
            $fn = APP_PATH."/".$folders[$i]."/".strtolower($className).".php";
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