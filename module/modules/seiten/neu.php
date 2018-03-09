<?php
class neu
{   
    function head()
    {
        if (isset($_REQUEST['mf']))
        {
            if ($_REQUEST['mf'] == 1)
            {
                @set_time_limit(1000); 
                if ($GLOBALS['WMF']->DATA_CONNECT->downloadFile($GLOBALS["CONFIG"]["dataserver"].$_REQUEST['link'], 'module/modules/tmp/'.$_REQUEST['archive'].'.zip'))
                {
                    if ($GLOBALS['WMF']->ZIP->extractFile('module/modules/tmp/'.$_REQUEST['archive'].'.zip', 'module/'.$_REQUEST['archive']))
                    {
                       unlink('module/modules/tmp/'.$_REQUEST['archive'].'.zip');
                       header("Location: ?result=true");   
                    }
                }
                else
                {
                    $GLOBALS['err'][] = $GLOBALS['lang']['errordownload'];
                }
            }
            if ($_REQUEST['mf'] == 2)
            {
                @set_time_limit(1000); 
                $type = explode(".",$_REQUEST['fname']);
                if ($GLOBALS['WMF']->ZIP->extractFile('module/modules/tmp/'.$_REQUEST['fname'], 'module/'.$type[0]))
                {
                  unlink('module/modules/tmp/'.$_REQUEST['fname']);
                  header("Location: ?result=true");
                } 
            }
        }
    }
    function body()
    {
        if (!isset($_REQUEST['mf']) OR !empty($GLOBALS['err']))
        {
        ?>
        <link rel="stylesheet" href="module/modules/css/new.css" type="text/css" media="all" />
    	<div class="content_nav">
            <a href="?choo+choo=train"><?php echo $GLOBALS['lang']['back']; ?></a>
        </div>    
        <?php
        echo $GLOBALS['WMF']->DISPLAY->errors();   
        ?>
        <script>
        	$(function() {
        		$( "a", ".down" ).button();
        	}); 
    	</script>
      <?php
      
        $Funktion = new modulfunctions();
        $data = $Funktion->serverdata();
        if ($data != false)
            {
            foreach ($data as $wert)
            {
            echo '<div class="element"><div class="title"><b>'.$wert->name.'</b> '.$wert->version.'</div>';
            echo $wert->info.'<br />';
            echo $GLOBALS['lang']['language'].' '.$wert->lang.'<br />';
            $buttonname = $GLOBALS['lang']['install'];
            foreach ($GLOBALS['module'] as $existmodule)
            {
             if ($existmodule->ordner == $wert->archive )
                {
                    if ($existmodule->version < $wert->version)
                    {
                        $buttonname = $GLOBALS['lang']['update'];     
                    }
                    if ($existmodule->version == $wert->version)
                    {
                        $buttonname = $GLOBALS['lang']['reinstall'];
                    }        
                }   
            }
            echo '<div class="down"><a href="?mf=1&archive='.$wert->archive.'&seite=neu&link='.$wert->download.'">'.$buttonname.'</a>  '.$GLOBALS['lang']['size'].' '.$wert->size.'</div>';
            echo '</div>';    
          }
          }
          else
          {
          ?>
                <script>
                    $(function() {
                            $( "input:submit,a", ".formular" ).button();
                    });
            	</script>
                <div class="formular">
                    <table cellpadding="5" cellspacing="0">
                        <tr>
                          <td><?php echo $GLOBALS['lang']['modul']; ?></td>
                          <!--<td><input type="file" name="datei" size="20" maxlength="100000"></td>-->
                          <td><div id="file-uploader"></div><noscript><?php echo $GLOBALS['lang']['jsm']; ?></noscript></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><a id="install"><?php echo $GLOBALS['lang']['install']; ?></a></td>
                        </tr>
                    </table>
                </div>
                <?php
                    echo $GLOBALS['WMF']->JS->includefileuploader();
                ?>
                <script>
                    $(document).ready(function() {
                        <?php
                            echo $GLOBALS['WMF']->JS->fileuploader('file-uploader', 'module/modules/tmp/upload.php', 'zip', 'false', 'false', $GLOBALS['lang']['select'], "?seite=neu&mf=2&fname='+fileName+'");
                        ?>
                        $('#install').click(function() {
                            <?php
                                echo $GLOBALS['WMF']->JS->startfileuploader();
                            ?>
                        });                                
                    });
                </script>
              <?php
          }
      }
  }
}
?>