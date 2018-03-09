<?php 
class nav
{
     public function Index()
    {
        foreach ($GLOBALS['module'] as $wert)
        {
            if ($wert->priority == 1 OR $wert->priority == "")
            {
                echo '<a href="index.php?id='.$wert->id.'"><div class="navline"><img class="navimage" class="navimage" border="0" height="50px" src="module/'.$wert->ordner.'/'.$wert->icon50.'" /><p class="navtext">'.$wert->name.'</p></div></a>';    
            }
         }
        foreach ($GLOBALS['module'] as $wert)
        {
            if ($wert->priority == 2)
            {
                echo '<a href="index.php?id='.$wert->id.'"><div class="navline"><img class="navimage" class="navimage" border="0" height="50px" src="module/'.$wert->ordner.'/'.$wert->icon50.'" /><p class="navtext">'.$wert->name.'</p></div></a>';
            }
         }
        foreach ($GLOBALS['module'] as $wert)
        {
            if ($wert->priority == 3)
            {
                echo '<a href="index.php?id='.$wert->id.'"><div class="navline"><img class="navimage" class="navimage" border="0" height="50px" src="module/'.$wert->ordner.'/'.$wert->icon50.'" /><p class="navtext">'.$wert->name.'</p></div></a>';
            }
         }
    }
}

 ?>