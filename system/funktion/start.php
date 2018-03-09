<?php 
class start
{
    function del()
    {
        if (isset($_REQUEST['del']) AND $_REQUEST['del'] == true)
        {
            $DB = $GLOBALS['WMF']->DB;
            $DB->delete($_REQUEST['table'], $_REQUEST['dataid']);
        }
    }
}

 ?>