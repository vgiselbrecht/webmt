<?php
class neu
{
    function Index()
    {
        if (isset($_REQUEST['mf']))
        {
            if ($_REQUEST['mf'] == 2)
            {
                if ($_REQUEST["vname"] == "")
                {
                  $GLOBALS['err'][] = $GLOBALS['lang']['errorempty'];
                }
                else
                {
                    if (is_dir("../".$_REQUEST["vname"]) == true)  
                    {
                        $GLOBALS['err'][] = $GLOBALS['lang']['errordirectory'].$_REQUEST["vname"];   
                    }
                    else
                    {   
                        $DB = $GLOBALS['WMF']->DB;
                        $values [] = $DB->values("name", $_REQUEST["vname"]);
                        $values [] = $DB->values("zustand", "0");
                        $data = $DB->insert("apps", $values);
                        @set_time_limit(1000); 
                        if ($GLOBALS['WMF']->ZIP->extractFile('module/apps/tmp/app.zip', '../'.$_REQUEST["vname"]))
                        {
                          unlink('module/apps/tmp/app.zip');
                          $set[] = $DB->set("zustand", "1");
                          $where[] = $DB->where("name", "=", $_REQUEST["vname"]);
                          $data = $DB->update("apps", $set, $where);
                          $vname = $_REQUEST["vname"];
                        }  
                    }
                }
            }
            if ($_REQUEST['mf'] == 1)
            {
                if (!isset($_POST["name"]) OR $_POST["name"] == "")
                {
                  $GLOBALS['err'][] = $GLOBALS['lang']['errorempty'];
                }
                else
                {
                    if (is_dir("../".$_POST["name"]) == true)
                    {
                     $GLOBALS['err'][] = $GLOBALS['lang']['errordirectory'].$_POST["name"]; 
                    }
                    else
                    {
                        @set_time_limit(1000); 
                        if ($GLOBALS['WMF']->DATA_CONNECT->downloadFile($GLOBALS["CONFIG"]["dataserver"].$_REQUEST['link'], 'module/apps/tmp/apps.ins'))
                        {
                            $DB = $GLOBALS['WMF']->DB;
                            $values [] = $DB->values("name", $_POST["name"]);
                            $values [] = $DB->values("zustand", "0");
                            $data = $DB->insert("apps", $values);
                            if ($GLOBALS['WMF']->ZIP->extractFile('module/apps/tmp/apps.ins', '../'.$_POST["name"]))
                            {
                                unlink('module/apps/tmp/apps.ins');
                                $set[] = $DB->set("zustand", "1");
                                $where[] = $DB->where("name", "=", $_POST['name']);
                                $data = $DB->update("apps", $set, $where);
                                $vname = $_POST['name'];
                            }
                        }
                        else
                        {
                            $GLOBALS['err'][] = $GLOBALS['lang']['errordownload'];
                        }
                    }
                }
            } 
        }
        ?>
            <link rel="stylesheet" href="module/apps/css/new.css" type="text/css" media="all" />
            <div class="content_nav">
            <a href="?choo+choo=train"><?php echo $GLOBALS['lang']['back']; ?></a>
            </div>
            <script>
                $(function() {
                        $( "a, button, input:submit", ".down,.formular,.next" ).button();
                });
            </script>    
        <?php
        if (!isset($_REQUEST['mf']) OR !empty($GLOBALS['err']))
        {
            echo $GLOBALS['WMF']->DISPLAY->errors();
            $Funktion = new appfunctions();
            $data = $Funktion->serverdata();
            if ($data != false)
            {
                foreach ($data as $wert)
                {
                    ?>
                    <script>
                    	$(function() {
                    		$( "#dialog<?php echo $wert->name; ?>" ).dialog({
                    			autoOpen: false
                    		});
                    		$( "#open<?php echo $wert->name; ?>" ).click(function() {
                    			$( "#dialog<?php echo $wert->name; ?>" ).dialog( "open" );
                    			return false;
                		});
                    	});
                	</script>
                    <?php 
                    echo '<div class="element"><div class="title"><b>'.$wert->name.'</b> '.$wert->version.'</div>';
                    echo $wert->info.'<br />';
                    echo $GLOBALS['lang']['language'].' '.$wert->lang.'<br />';
                    echo '<div class="down" id="open'.$wert->name.'"><button>'.$GLOBALS['lang']['install'] .'</button>  '.$GLOBALS['lang']['size'].' '.$wert->size.'</div>';
                        //Dialog
                        echo '<div class="down" title="'.$GLOBALS['lang']['install'] .'" id="dialog'.$wert->name.'">';
                        echo '<form method="post" autocomplete="off" action="?mf=1&seite=neu&id='.$_REQUEST['id'].'&link='.$wert->download.'">';
                        echo '<b class="title">'.$wert->name.'</b><br />';
                        echo '<p>'.$GLOBALS['lang']['directoryname'].'</p><input type="text" name="name" size="25" /><br /><br />';
                        echo '<input type="submit" value="'.$GLOBALS['lang']['install'].'" />';
                        echo '</form></div>';
                    echo '</div>';
                }
            }
            else
            {  
              ?>
                <div class="formular">
                    <table cellpadding="5" cellspacing="0" >
                      <tr>
                        <td width="150px"><?php echo $GLOBALS['lang']['directoryname']; ?></td>
                        <td><input id="vname" type="text" name="name" /></td>
                      </tr>
                     <tr>
                      <td><?php echo $GLOBALS['lang']['insfile']; ?></td>
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
                            echo $GLOBALS['WMF']->JS->fileuploader('file-uploader', 'module/apps/tmp/upload.php', 'ins', 'false', 'false', $GLOBALS['lang']['select'], "?seite=neu&mf=2&vname='+$('#vname').val()+'");
                        ?>
                        $('#install').click(function() {
                            if ($('#vname').val() != '')
                            {
                                <?php
                                    echo $GLOBALS['WMF']->JS->startfileuploader();
                                ?>
                            }
                            else
                            {
                                alert('<?php echo $GLOBALS['lang']['errorempty']; ?>');
                            }
                        });                                
                    });
                </script>
              <?php
            } 
        }
        else
        {
            echo '<div class="next">';
            echo $GLOBALS['lang']['finishinstall'];
            echo '<br /><br />';
            echo '<a onclick="window.location.href=\'?seite=neu\'" target="_blank" href="../'.$vname.'/conf.php">'.$GLOBALS['lang']['next'].'</a>';
            echo '</div>';
        }
    }
}
?>