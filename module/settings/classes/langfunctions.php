<?php 
class langfunctions
{
    function serverdata()
    {
        switch ($GLOBALS['WMF']->INFO->lang['code'])
        {
            case 'de':
                    $daten = $GLOBALS['WMF']->DATA_CONNECT->getXMLFile($GLOBALS["CONFIG"]["dataserver"].'lang.de.xml'); // Datei einlesen
                    break;
            case 'en':
                    $daten = $GLOBALS['WMF']->DATA_CONNECT->getXMLFile($GLOBALS["CONFIG"]["dataserver"].'lang.en.xml'); // Datei einlesen
                    break;
            default:
                    $daten = $GLOBALS['WMF']->DATA_CONNECT->getXMLFile($GLOBALS["CONFIG"]["dataserver"].'lang.en.xml'); // Datei einlesen
                    break;
        } 
    
        $langs = Array();
        if ($daten != "")
        {
            for($i=0,$size=count($daten);$i<$size;$i++)
            {
                $lang = new datenliste();
                $lang->name = $daten->lang[$i]->name;
                $lang->download = $daten->lang[$i]->download;
                $lang->size = $daten->lang[$i]->size;
                $lang->author = $daten->lang[$i]->author;
                $lang->code = $daten->lang[$i]->code;
                $langs[] = $lang;
            }
            return $langs;
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
    public $size = "";
    public $author = "";
    public $code = "";
}
 ?>