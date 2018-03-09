<?php

class INFO 
{
    var $lang;
    var $user;
    public function __construct() {
        foreach ($GLOBALS['langs'] as $lang)
        {
            if ($lang[0] == $_SESSION['lang'])
            {
                $this->lang = array('name' => $lang[1], 'code' => $lang[0]);
                break;
            }
        }
        
        $this->user = array('name' => $_SESSION['name'], 'id' => $_SESSION['user_id'], 'admin' => $_SESSION['admin']);
    }
}
?>
