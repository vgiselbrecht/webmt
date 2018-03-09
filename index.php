<?php
header('content-type: text/html; charset=utf-8');

//Klassen laden
require("system/register.php");

//Session starten
$Session = new Session();
$Session->SessionStart();

//�berpr�fen ob angemolden
if (isset($_SESSION['ma_status']) AND $_SESSION['ma_status']  == TRUE)
{
    //Wenn Ja
    $Main = new main();
    $Main->Index();   
}
else
{
    //Wenn Nein
    $Login = new login();
    $Login->Index();   
}




?>