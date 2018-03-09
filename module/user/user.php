<?php
class Modul
{
    function php_head()
    {
        require("seiten/neu.php");
        require("seiten/bearbeiten.php");
        if (isset($_REQUEST['seite']))
        {
            if ($_REQUEST['seite'] == "neu")
               {
                    $Funktion = new neu();
                    $Funktion->head();
               }
            if ($_REQUEST['seite'] == "bearbeiten")
               {
                    $Funktion = new bearbeiten();
                    $Funktion->head();
               }
        }    
    }
    function main ()
    {        
        if (isset($_REQUEST['seite']))
        {
            if ($_REQUEST['seite'] == "neu")
               {
                    $Funktion = new neu();
                    $Funktion->body();
               }
            if ($_REQUEST['seite'] == "bearbeiten")
               {
                    $Funktion = new bearbeiten();
                    $Funktion->body();
               }
        }
        else
        {
            //User
            echo '<div class="content_nav"><a href="?seite=neu&type=user">'.$GLOBALS['lang']['newuser'].'</a></div>';
            $DB = $GLOBALS['WMF']->DB;
            $where = Array();
            $where[] = $DB->where("id", "!=", "NULL");
            $data = $DB->select("user");
            if ($data)
            {
                echo '<table class="table" cellpadding="4" cellspacing="0">';
                echo '<tr class="firstline" ><td width="700px" class="tdleft">'.$GLOBALS['lang']['user'].'</td><td width="80px" class="tdnormal"></td>';
                echo '</tr>';
                foreach($data as $wert)
                {
                    echo '<tr class="line">';
                        echo '<td  class="tdleft">';
                                echo $wert['name'];
                                if ($wert['admin'] == 1)
                                {
                                    echo ' ('.$GLOBALS['lang']['admin'].')';
                                }
                        echo '</td>';
                        echo '<td class="tdnormal">';
                            echo '<div class="linkicon"><a href="?seite=bearbeiten&userid='.$wert['id'].'"><img title="'.$GLOBALS['lang']['edit'].'" src="html/icons/edit.png" border="0"  alt="Edit" /></a></div><div class="linkicon"><a onclick="javascript:del(\'user\', \''.$wert['id'].'\');"><img title="'.$GLOBALS['lang']['del'].'" src="html/icons/delete.png" border="0"  alt="Delete" /></a></div>';
                        echo '</td>';
                    echo '</tr>';
                }
            }
            echo '</table><br />';
            
            //Gruppen
            echo '<div class="content_nav"><a href="?seite=neu&type=group">'.$GLOBALS['lang']['newgroup'].'</a></div>';
            $DB = $GLOBALS['WMF']->DB;
            $where = Array();
            $where[] = $DB->where("id", "!=", "NULL");
            $data = $DB->select("groups");
            if ($data)
            {
                echo '<table class="table" cellpadding="4" cellspacing="0">';
                echo '<tr class="firstline" ><td width="700px" class="tdleft">'.$GLOBALS['lang']['group'].'</td><td width="80px" class="tdnormal"></td>';
                echo '</tr>';
                foreach($data as $wert)
                {
                    echo '<tr class="line">';
                        echo '<td  class="tdleft">';
                                echo $wert['name'];
                        echo '</td>';
                        echo '<td class="tdnormal">';
                            echo '<div class="linkicon"><a href="?seite=bearbeiten&groupid='.$wert['id'].'"><img title="'.$GLOBALS['lang']['edit'].'" src="html/icons/edit.png" border="0"  alt="Edit" /></a></div><div class="linkicon"><a onclick="javascript:del(\'groups\', \''.$wert['id'].'\');"><img title="'.$GLOBALS['lang']['del'].'" src="html/icons/delete.png" border="0"  alt="Delete" /></a></div>';
                        echo '</td>';
                    echo '</tr>';
                }
            }
            else
            {
                echo $GLOBALS['lang']['nogroup'];
            }
            echo '</table>';
        }
    }
}
 ?>