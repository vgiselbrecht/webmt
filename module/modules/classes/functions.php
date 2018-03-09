<?php 
class modulfunctions
{
    function serverdata()
    {
    switch ($GLOBALS['WMF']->INFO->lang['code'])
    {
        case 'de':
                $daten = $GLOBALS['WMF']->DATA_CONNECT->getXMLFile($GLOBALS["CONFIG"]["dataserver"].'module.de.xml'); // Datei einlesen
        break;
        case 'en':
                $daten = $GLOBALS['WMF']->DATA_CONNECT->getXMLFile($GLOBALS["CONFIG"]["dataserver"].'module.en.xml'); // Datei einlesen
        break;
        default:
                $daten = $GLOBALS['WMF']->DATA_CONNECT->getXMLFile($GLOBALS["CONFIG"]["dataserver"].'module.en.xml'); // Datei einlesen
        break;
    } 

    $module = Array();
    if ($daten != "")
    {
        for($i=0,$size=count($daten);$i<$size;$i++) 
        {
            $modul = new datenliste();
            $modul->name = $daten->modul[$i]->name;
            $modul->archive = $daten->modul[$i]->archive;
            $modul->download = $daten->modul[$i]->download;
            $modul->lang = $daten->modul[$i]->lang;
            $modul->size = $daten->modul[$i]->size;
            $modul->info = $daten->modul[$i]->info;
            $modul->version = $daten->modul[$i]->version;
            $module[] = $modul;  
        }
        return $module;
    }
    else
    {
        return false;
    }

    }
}
class datenliste
{
    public $name = "";
    public $archive = "";
    public $download = "";
    public $lang = "";
    public $size = "";
    public $info = "";
    public $version = "";
    }
 ?>