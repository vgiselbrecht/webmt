<?php
class Session
{
    public function SessionStart()
    {
     session_start();
     
     //Konfiguration laden
     require("config/localconfig.php");
     
    $Lang = new lang();
    $Lang->Index();
    }
}
?>