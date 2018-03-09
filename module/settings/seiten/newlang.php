<?php
class newlang
{
    function head()
    {
        if (isset($_REQUEST['mf']))
        {
            if ($_REQUEST['mf'] == 1)
            {
                @set_time_limit(1000); 
                if ($GLOBALS['WMF']->DATA_CONNECT->downloadFile($GLOBALS["CONFIG"]["dataserver"].$_REQUEST['link'], 'module/settings/tmp/lang.zip'))
                {
                    if ($GLOBALS['WMF']->ZIP->extractFile('module/settings/tmp/lang.zip', './'))
                    {
                       unlink('module/settings/tmp/lang.zip');
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
                if ($GLOBALS['WMF']->ZIP->extractFile('module/settings/tmp/lang.zip', './'))
                {
                    unlink('module/settings/tmp/lang.zip');
                    header("Location: ?result=true");  
                } 
            }
        }
    }
    function body()
    {
        require("module/settings/classes/langfunctions.php");
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
      
        $Funktion = new langfunctions();
        $data = $Funktion->serverdata();
        if ($data != false)
            {
            foreach ($data as $wert)
            {
            echo '<div class="element"><div class="title"><b>'.$wert->name.' ('.$wert->code.')</b></div>';
            echo $GLOBALS['lang']['author'].': '.$wert->author;
            $buttonname = $GLOBALS['lang']['install'];
            foreach ($GLOBALS['langs'] as $lang)
            {
                if ($lang[0] == $wert->code)
                {
                    $buttonname = $GLOBALS['lang']['reinstall'];
                } 
            }
            echo '<div class="down"><a href="?mf=1&seite=newlang&link='.$wert->download.'">'.$buttonname.'</a>  '.$GLOBALS['lang']['size'].' '.$wert->size.'</div>';
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
                          <td><?php echo $GLOBALS['lang']['language']; ?></td>
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
                            echo $GLOBALS['WMF']->JS->fileuploader('file-uploader', 'module/settings/tmp/langupload.php', 'zip', 'false', 'false', $GLOBALS['lang']['select'], "?seite=newlang&mf=2");
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