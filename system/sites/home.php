<?php

class home
{
 public function Index()
    {
        //Level1    
        $i = 0;  
        $first = true;
        foreach ($GLOBALS['module'] as $wert)
        { 
            if ($wert->priority == 1 OR $wert->priority == "")
            {
                if ($first)
                {
                    echo '<h3>'.$GLOBALS['lang']['generalmodul'].'</h3><table><tr>';
                    $first = false;
                }
                if ($i == 4)
                {
                    echo '</tr><tr>';
                    $i = 0;
                }
                echo '<td><a class="start_moduls" href="index.php?id='.$wert->id.'"><img border="0" height="100px" src="module/'.$wert->ordner.'/'.$wert->icon100.'"><p>'.$wert->name.'</p></a></td>';
                $i = $i + 1;
            }
        }
        if (!$first)
        {
            echo '</tr></table>';
        }
        //Level2
        $i = 0;
        $first = true;
        foreach ($GLOBALS['module'] as $wert)
        {    
            if ($wert->priority == 2)
            {
                if ($first)
                {
                    echo '<h3>'.$GLOBALS['lang']['helpmodul'].'</h3><table><tr>';
                    $first = false;
                }
                if ($i == 4)
                    {
                        echo '</tr><tr>';
                        $i = 0;
                    }
                echo '<td><a class="start_moduls" href="index.php?id='.$wert->id.'"><img border="0" height="100px" src="module/'.$wert->ordner.'/'.$wert->icon100.'"><p>'.$wert->name.'</p></a></td>';
                $i = $i + 1;
            }    
        }
        if (!$first)
        {
            echo '</tr></table>';
        }
        //Level3
        $i = 0;
        $first = true;
        foreach ($GLOBALS['module'] as $wert)
        {    
            if ($wert->priority == 3)
            {
                if ($first)
                {
                    echo '<h3>'.$GLOBALS['lang']['systemmodul'].'</h3><table><tr>';
                    $first = false;
                }
                if ($i == 4)
                    {
                        echo '</tr><tr>';
                        $i = 0;
                    }
                echo '<td><a class="start_moduls" href="index.php?id='.$wert->id.'"><img border="0" height="100px" src="module/'.$wert->ordner.'/'.$wert->icon100.'"><p>'.$wert->name.'</p></a></td>';
                $i = $i + 1;
            }    
        }
        if (!$first)
        {
            echo '</tr></table>';
        }
        $_SESSION['id'] = 'home';
    }
    
 }
?>
