<?php

class ZIP
{
    
    public function __construct() {
        include('system/classes/pclzip.lib.php');
    }
    
    function extractFile($file, $to)
    {
        $archive = new PclZip($file);
        if ($archive->extract(PCLZIP_OPT_PATH, $to, PCLZIP_OPT_REPLACE_NEWER) == 0) {
            $GLOBALS['err'][] = "Error : ".$archive->errorInfo(true);
            return false;
        } 
        else
        {
            return true;
        }
    }
}
?>
