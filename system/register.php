<?php
//SeitenLayout         
require("html/seitenlayout/loginlayout.php"); 
require("html/seitenlayout/mainlayout.php");
require("html/seitenlayout/installlayout.php");  

//Wichtige Klassen
require("system/session.php");

//Screens
require("login.php");
require("main.php");

//Funktionen
require("system/funktion/login.php");
require("system/funktion/main.php");
require("system/funktion/module.php");
require("system/funktion/content.php");
require("system/funktion/nav.php");
require("system/lang/lang.php");
require("system/funktion/end.php");
require("system/funktion/start.php");   

//Sites
require("system/sites/home.php");   
require("system/sites/password.php");   

//Datenbank Klasse
require("system/db/db.php");
require("system/db/dbmuster.php"); 

//WMF
require("system/wmf/wmf.php");
require("system/wmf/zip.php"); 
require("system/wmf/data_connect.php"); 
require("system/wmf/display.php"); 
require("system/wmf/info.php"); 
require("system/wmf/js.php"); 
?>