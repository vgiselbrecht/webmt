<?php
class Modul 
{
    function php_head()
    {
        require("seiten/newlang.php");
        if (isset($_REQUEST['seite']))
        {
            if ($_REQUEST['seite'] == "newlang")
               {
                    $Funktion = new newlang();
                    $Funktion->head();
               }
        }
        else
        {
            if (isset($_REQUEST['mf']))
            {
                if ($_REQUEST['mf'] == 1)
                {
                    $daten = "<?php ";
                    $daten = $daten.'$GLOBALS["CONFIG"]["dataserver"] = "'.$_POST['dataserver'].'";';
                    $daten = $daten." ?>";
                    $handle = fopen ("system/config/system.php", "w");
                    fwrite ($handle, $daten);
                    fclose ($handle);
                    header("Location: ?result=true");
                }
                if ($_REQUEST['mf'] == 2)
                {
                    @set_time_limit(1000); 
                    if ($GLOBALS['WMF']->DATA_CONNECT->downloadFile($GLOBALS["CONFIG"]["dataserver"].$_REQUEST['link'], 'module/settings/tmp/system.zip'))
                    {
                        if ($GLOBALS['WMF']->ZIP->extractFile('module/settings/tmp/system.zip', './'))
                        {
                           unlink('module/settings/tmp/system.zip');
                           $DBMuster = new dbmuster();
                           $DBMuster->Index();
                           header("Location: ?newsystem=true");
                        }
                    }
                    else
                    {
                        $GLOBALS['err'][] = $GLOBALS['lang']['errordownload'];
                    }
                }
                if ($_REQUEST['mf'] == 3)
                {

                    @set_time_limit(1000); 
                    if ($GLOBALS['WMF']->ZIP->extractFile('module/settings/tmp/system.zip', './'))
                    {
                       unlink('module/settings/tmp/system.zip');
                       $DBMuster = new dbmuster();
                       $DBMuster->Index();
                       header("Location: ?newsystem=true");
                    }
                }
            }
        }
    }
    function main()
    {
        if (isset($_REQUEST['seite']))
        {
            if ($_REQUEST['seite'] == "newlang")
               {
                    $Funktion = new newlang();
                    $Funktion->body();
               }
        }
        else
        {
            require("classes/functions.php");
            echo $GLOBALS['WMF']->DISPLAY->errors();
             ?>
             <script>
                    $(function() {
                            $( "input:submit, a", ".formular" ).button();
                    });
             </script>
             <h3><?php echo $GLOBALS['lang']['general']; ?></h3>
             <div class="formular">
                <form autocomplete="off" action="?mf=1&id=<?php echo $_REQUEST['id']; ?>" method="post">
                    <table cellpadding="5" cellspacing="0" class="tl_login_table" summary="Input fields">
                      <tr>
                        <td width="150px"><label for="dataserver"><?php echo $GLOBALS['lang']['dataserver']; ?></label></td>
                        <td align="right"><input type="text" name="dataserver" size="30" value="<?php echo $GLOBALS["CONFIG"]["dataserver"]; ?>"/></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><input type="submit" value="<?php echo $GLOBALS['lang']['save']; ?>"></td>
                      </tr>
                    </table>
                </form>
            </div>
            <h3><?php echo $GLOBALS['lang']['systemupdate']; ?></h3>
            <?php 
            $Funktion = new settingfunctions();
            $data = $Funktion->serverdata();
            if ($data != false)
            {
                foreach ($data as $wert)
                 {
                    if ($wert->version <= $GLOBALS["CONFIG"]["version"] )
                    {
                       echo $GLOBALS['lang']['actualsystem'];
                    }
                    else
                    {
                        echo '<b>'.$GLOBALS['lang']['newversion'].'</b><br />';
                        echo '<div style="margin-top:7px; margin-bottom:7px;">'.$wert->info.'</div>';
                        echo '<a href="?mf=2&link='.$wert->download.'">'.$GLOBALS['lang']['updateto'].' '.$wert->version.'</a>';     
                    } 
                 }
            }
            else
            {
              ?>
                <div class="formular">
                    <table cellpadding="5" cellspacing="0">
                        <tr>
                          <td><?php echo $GLOBALS['lang']['zipdirectory']; ?></td>
                          <td><div id="file-uploader"></div><noscript><?php echo $GLOBALS['lang']['jsm']; ?></noscript></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><a id="install"><?php echo $GLOBALS['lang']['update']; ?></td>
                        </tr>
                    </table>
                    <?php
                    echo $GLOBALS['WMF']->JS->includefileuploader();
                    ?>
                    <script>
                        $(document).ready(function() {
                            <?php
                                echo $GLOBALS['WMF']->JS->fileuploader('file-uploader', 'module/settings/tmp/upload.php', 'zip', 'false', 'false', $GLOBALS['lang']['select'], "?id=settings&mf=3");
                            ?>
                            $('#install').click(function() {
                                <?php
                                    echo $GLOBALS['WMF']->JS->startfileuploader();
                                ?>
                            });                                
                        });
                    </script>
                </div>
              <?php
            }
            //Sprachen
            ?>
            <h3><?php echo $GLOBALS['lang']['lang']; ?></h3>
            <?php
            echo '<div class="content_nav"><a href="?seite=newlang">'.$GLOBALS['lang']['newlang'].'</a></div>';
            echo '<table class="table" cellpadding="4" cellspacing="0">';
            echo '<tr class="firstline" ><td width="400px" class="tdleft">'.$GLOBALS['lang']['name'].'</td>';
            echo '<td width="150px" class="tdnormal">'.$GLOBALS['lang']['lang_small'].'</td>';
            echo '<td width="250px" class="tdnormal">'.$GLOBALS['lang']['author'].'</td>';
            echo '</tr>';
            foreach ($GLOBALS['langs'] as $lang)
            {
                  echo '<tr class="line">';
                    echo '<td  class="tdleft">';
                        echo $lang[1];
                    echo '</td>';
                    echo '<td class="tdnormal">';
                        echo $lang[0];
                    echo '</td>';
                    echo '<td class="tdnormal">';
                        echo $lang[2];
                    echo '</td>';
                  echo '</tr>';
            }
            echo '</table>';
        }
    }
}
?>