<?php

class mainfunktion
{
    function Index()
    {        
        //id anfügen
        if (!isset($_REQUEST['id']))
        {
            if(strpos($_SERVER['REQUEST_URI'],"?")!==false)
                {
                    header('Location: '.$_SERVER['REQUEST_URI'].'&id='.$_SESSION['id']);  
                } 
                else 
                {
                    header('Location: '.$_SERVER['REQUEST_URI'].'?id=home');  
                } 
        }
        
        //Logout
        if (isset($_REQUEST['f']))
        {
            if ($_REQUEST['f'] == "logout")
            {
                $Logout = new loginfunktion();
                $Logout->Logout();
            }
        }
        
        //Globale Variabeln
        $GLOBALS['DB'] = new Database();
        $GLOBALS['WMF'] = new WMF();
        
        //Module einfügen
        $Modules = new modulefunction();
        $Modules->search();
        $Modules->includes();
        
        $Start = new start();
        $Start->del();    
    }
}

 ?>