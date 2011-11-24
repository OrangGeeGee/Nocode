<?php
require_once SMARTY_PATH.'/Smarty.class.php';

class MySmarty extends Smarty {
    public function __construct() {
        parent::__construct();        
        $this->setTemplateDir(SMARTY_TEMPLATE_PATH);
        $this->setCompileDir(SMARTY_COMPILED_PATH);
        $this->setCacheDir(SMARTY_CACHE_PATH);
        $this->setConfigDir(SMARTY_CONFIG_PATH);
    }   
}
?>