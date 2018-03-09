<?php
class Modul
{
    function php_head()
    {
    }
    function main()
    {
        require("seiten/neu.php"); 
        require("classes/functions.php"); 
         
        if (isset($_REQUEST['seite']))
        {
            if ($_REQUEST['seite'] == "neu")
               {
                    $Funktion = new neu();
                    $Funktion->Index();
               }   
        }
        else
        {
            echo '<div class="content_nav"><a href="?seite=neu">'.$GLOBALS['lang']['newapp'].'</a></div>';
            $data = $GLOBALS['WMF']->DB->select("apps");
            if($data)
            {
                echo '<table class="table" cellpadding="4" cellspacing="0">';
                echo '<tr class="firstline" ><td width="700px" class="tdleft">'.$GLOBALS['lang']['name'].'</td><td class="tdnormal">'.$GLOBALS['lang']['status'].'</td>';
                echo '</tr>';
                foreach($data as $wert)
                {
                    if (is_dir("../".$wert['name']) == true)
                    {
                        echo '<tr class="line">';
                        echo '<td  class="tdleft">';
                        echo '<a target="blank" href="/'.$wert['name'].'">'.$wert['name'].'</a>';
                        echo '</td>';
                        echo '<td class="tdnormal">';
                        switch ($wert['zustand'])
                        {
                            case 0:
                                echo $GLOBALS['lang']['statusinstall'];
                                break;
                            case 1:
                                echo $GLOBALS['lang']['statusfinish'];
                                break;
                            default :
                                echo $GLOBALS['lang']['statusundefinied'];
                                break;
                        }
                        echo '</td>';	
                        echo '</tr>';
                      }
                      else
                      {
                        $GLOBALS['WMF']->DB->delete('apps', $wert['id']);
                      }
                   }
                echo '</table>';
            }
            else
            {
                echo $GLOBALS['lang']['noapp'];
            }
        }
    }        
}
?>