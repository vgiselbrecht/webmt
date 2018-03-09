<?php
class Modul
{ 
    function php_head()
    {
        if (isset($_REQUEST['delmod']) AND $_REQUEST['delmod'] == true)
        {
            Modul::delete_directory('module/'.$_REQUEST['name']);
            header("Location: ?result=true");
        }
        
        require("seiten/neu.php");
        require("classes/functions.php");
        if (isset($_REQUEST['seite']))
        {
            if ($_REQUEST['seite'] == "neu")
               {
                    $Funktion = new neu();
                    $Funktion->head();
               }
        }
    }        
    function main()
    {       
        if (isset($_REQUEST['seite']))
        {
            if ($_REQUEST['seite'] == "neu")
               {
                    $Funktion = new neu();
                    $Funktion->body();
               }
        }
        else
        {
            $Funktion = new modulfunctions();
            $data = $Funktion->serverdata();
            if ($data == false)
            {
                $xmlerror = true;   
            }
            else
            {
                $xmlerror = false;
            }
            echo '<div class="content_nav"><a href="?seite=neu">'.$GLOBALS['lang']['newmodul'].'</a></div>';
            echo '<table class="table" cellpadding="4" cellspacing="0">';
            echo '<tr class="firstline" ><td width="700px" class="tdleft">'.$GLOBALS['lang']['name'].'</td>';
            if (!$xmlerror)
            {
                echo '<td width="40px" class="tdnormal">'.$GLOBALS['lang']['status'].'</td>';
            }
            echo '<td class="tdnormal"></td>';
            echo '</tr>';
            foreach ($GLOBALS['module'] as $wert)
            {
                  echo '<tr class="line">';
                  echo '<td  class="tdleft">';
                          echo $wert->name;
                          echo ' ';
                          echo $wert->version;
                  echo '</td>';
                  if (!$xmlerror)
                  {
                      echo '<td class="tdnormal">';
                      foreach ($data as $allmoduls)
                      {
                          if ($allmoduls->archive == $wert->ordner)
                          {
                              if ($allmoduls->version == $wert->version)
                              {
                                  echo $GLOBALS['lang']['actual'];
                              }
                              if ($allmoduls->version > $wert->version)
                              {
                                  echo '<div class="down"><a href="?mf=1&archive='.$allmoduls->archive.'&seite=neu&link='.$allmoduls->download.'">'.$GLOBALS['lang']['update'].'</a>';   
                              }
                          }
                      }
                      echo '</td>';
                  }
                  echo '<td class="tdnormal">';
                  if ($wert->ordner != 'modules' AND $wert->ordner != 'user' AND $wert->ordner != 'settings')
                  {
                      echo '<a class="linkicon" onclick="javascript:delmod(\''.$wert->ordner.'\');"><img title="'.$GLOBALS['lang']['del'].'" src="html/icons/delete.png" border="0"  alt="'.$GLOBALS['lang']['del'].'" /></a>';
                  }
                  echo '</td>';
                  echo '</tr>';
            }
            echo '</table>';
        }
    }
    function end()
    {
        ?>
        <script>
        function delmod(name){
        var eingabe=confirm ("<?php echo $GLOBALS['lang']['delete']; ?>")
            if(eingabe==true){
                window.location.href = "?id=<?php echo $_REQUEST['id']; ?>&delmod=true&name="+name;
                }
            }
        </script>
<?php 
    }
    function delete_directory($dirname) {
           if (is_dir($dirname))
              $dir_handle = opendir($dirname);
           if (!$dir_handle)
              return false;
           while($file = readdir($dir_handle)) {
              if ($file != "." && $file != "..") {
                 if (!is_dir($dirname."/".$file))
                    unlink($dirname."/".$file);
                 else
                    Modul::delete_directory($dirname.'/'.$file);
              }
           }
           closedir($dir_handle);
           rmdir($dirname);
        }
}
 ?>