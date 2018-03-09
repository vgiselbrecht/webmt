<?php 
class settingfunctions
{
    function serverdata()
    {
        switch ($GLOBALS['WMF']->INFO->lang['code'])
        {
            case 'de':
                    $daten = $GLOBALS['WMF']->DATA_CONNECT->getXMLFile($GLOBALS["CONFIG"]["dataserver"].'system.de.xml'); // Datei einlesen
                    break;
            case 'en':
                    $daten = $GLOBALS['WMF']->DATA_CONNECT->getXMLFile($GLOBALS["CONFIG"]["dataserver"].'system.en.xml'); // Datei einlesen
                    break;
            default:
                    $daten = $GLOBALS['WMF']->DATA_CONNECT->getXMLFile($GLOBALS["CONFIG"]["dataserver"].'system.en.xml'); // Datei einlesen
                    break;
        } 
    
        $module = Array();
        if ($daten != "")
        {
            for($i=0,$size=count($daten);$i<$size;$i++)
            {
                $modul = new datenliste();
                $modul->download = $daten->system[$i]->download;
                $modul->info = $daten->system[$i]->info;
                $modul->version = $daten->system[$i]->version;
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
    public $download = "";
    public $info = "";
    public $version = "";
    }
 ?>