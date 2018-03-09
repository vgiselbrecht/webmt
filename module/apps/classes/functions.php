<?php 
class appfunctions
{
    function serverdata()
    {   
        switch ($GLOBALS['WMF']->INFO->lang['code'])
        {
            case 'de':
                $daten = $GLOBALS['WMF']->DATA_CONNECT->getXMLFile($GLOBALS["CONFIG"]["dataserver"].'apps.de.xml');
                break;
            case 'en':
                $daten = $GLOBALS['WMF']->DATA_CONNECT->getXMLFile($GLOBALS["CONFIG"]["dataserver"].'apps.en.xml');
                break;
            default:
                $daten = $GLOBALS['WMF']->DATA_CONNECT->getXMLFile($GLOBALS["CONFIG"]["dataserver"].'apps.en.xml');
                break;
        } 
    
        $module = Array();
        if ($daten != "")
        {
            for($i=0,$size=count($daten);$i<$size;$i++)
            {
                $modul = new datenliste();
                $modul->name = $daten->apps[$i]->name;
                $modul->download = $daten->apps[$i]->download;
                $modul->lang = $daten->apps[$i]->lang;
                $modul->size = $daten->apps[$i]->size;
                $modul->info = $daten->apps[$i]->info;
                $modul->version = $daten->apps[$i]->version;
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
    public $download = "";
    public $lang = "";
    public $size = "";
    public $info = "";
    public $version = "";
}
 ?>