<?php 

class main
{
    function Index()
    {
        $Funktion = new mainfunktion();
        $Funktion->Index();
        
        $Layout = new mainlayout();
        $Layout->Design();
    }
}
?>