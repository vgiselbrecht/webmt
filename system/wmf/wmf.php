<?php

class wmf
{
   
    var $DB;
    var $ZIP;
    var $DATA_CONNECT;
    var $DISPLAY;
    var $INFO;
    var $JS;
    
    public function __construct() {
        $this->DB = new Database;
        $this->ZIP = new ZIP;
        $this->DATA_CONNECT = new DATA_CONNECT;
        $this->DISPLAY = new DISPLAY;
        $this->INFO = new INFO;
        $this->JS = new JS;
    }
}
?>
