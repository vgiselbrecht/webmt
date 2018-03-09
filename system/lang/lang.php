<?php 

class lang
{

public function Index()
 {
    //Alle Sprachen herausfinden die möglich sind
    $langs = array();
    $handle = @opendir('system/lang');
    
    while ($file = @readdir ($handle)){
        if (preg_match("/^\.{1,2}$/",$file)){ 
            continue;
        }
        if(substr($file, -4) != '.php' AND file_exists('system/lang/'.$file.'/config.php'))
        {
            include_once 'system/lang/'.$file.'/config.php';
            $langs[] = $config;
        }
    }

     //Sprache laden
     if (!isset($_SESSION['lang']))
     {
            //Browser Sprache
            $long_lang = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
            list($kurz) = explode('-', $long_lang);
            foreach ($langs as $lang)
            {
                if ($lang[0] == $kurz)
                {
                    $_SESSION['lang'] = $lang[0];
                    break;
                }
            }
            if (!$_SESSION['lang'])
            {
                $_SESSION['lang'] = 'en';
            }
      }
      $GLOBALS['langs'] = $langs;
      if (isset($_REQUEST['lang']))
      {
          $_SESSION['lang'] = $_REQUEST['lang'];
      }
      if (file_exists("system/lang/".$_SESSION['lang']."/lang.php"))
      {
            require("system/lang/".$_SESSION['lang']."/lang.php");
      }
      else
      {
            if (file_exists("system/lang/en/lang.php"))
            {
                  require("system/lang/en/lang.php");
            }
      }
    }
}
 ?>