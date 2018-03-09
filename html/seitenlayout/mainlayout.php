<?php
class mainlayout
{
    public function Design()
    {
        if (class_exists('Modul')) {
            $Modul = new Modul();
        }
        $GLOBALS['err'] = Array();
        if (class_exists('Modul') AND method_exists($Modul, 'php_head'))
        {
            $Modul->php_head();   
        }
        ?>
         <!DOCTYPE html>
        <html>
            <head>
                <link rel="stylesheet" href="html/css/main.css" type="text/css"/>
                <link rel="icon" type="image/vnd.microsoft.icon" href="html/icons/favicon.ico" />
                <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="html/icons/favicon.ico" />
                <link href="html/classes/file_upload/client/fileuploader.css" rel="stylesheet">
            	<link rel="stylesheet" href="html/jquery/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="all" />
                <link rel="stylesheet" href="html/classes/jqtransformplugin/jqtransform.css" type="text/css" media="all" />
                <script src="html/jquery/js/jquery-1.7.1.min.js" type="text/javascript"></script>
                <script src="html/jquery/js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
                <script type="text/javascript" src="html/classes/jqtransformplugin/jquery.jqtransform.js" ></script>
                <script language="javascript">
                $(function(){
                        $("html").jqTransform();
                });
                </script>
                <title>WebMT - 
                <?php
                    $Content = new content();
                    $Content->Titel();
                ?></title>
                <?php
                if (class_exists('Modul') AND method_exists($Modul, 'html_head'))
                { 
                    $Modul->html_head();
                }
                 ?>
            </head>
            <body>
                <div id="header">
                    <div class="top_label">
                        <label>WebMT - Webspace Management Tool 0.2</label>
                    </div>
                    <div class="inside" style="height:19px">
                        <div style="float: left">
                            <?php
                            if (class_exists('Modul') AND method_exists($Modul, 'html_header'))
                            { 
                                $Modul->html_header();
                            }
                            ?>
                        </div>
                        <div style="float: right;">
                            <a class="headerbutton" href="index.php?id=home"><?php echo $GLOBALS['lang']['home']; ?></a> |
                            <a class="headerbutton" href="index.php?id=password"><?php echo $GLOBALS['lang']['user'].': '.$_SESSION['name']; ?></a> |
                            <a class="headerbutton" href="index.php?f=logout"><?php echo $GLOBALS['lang']['logout']; ?></a>
                        </div>
                    </div>
                </div>
                <div id= "wrapper">
                    <div id= "nav">
                        <div class="top_label">
                        <label><?php echo $GLOBALS['lang']['module']; ?></label>
                        </div>
                        <div class="inside">
                        <?php
                            $Nav = new nav();
                            $Nav->Index();
                        ?>
                        </div>
                    </div>
                    <div id= "content">
                        <div class="top_label">
                        <?php 
                            $Content->Titel();
                         ?>
                        </div>
                        <div class="inside">
                        <?php 
                            $Content->Index();
                            if (class_exists('Modul') AND method_exists($Modul, 'main'))
                            {
                                $Modul->main();
                            }
                         ?>
                         </div>
                    </div>
                </div>
                <?php  
                $End = new end();
                $End->JS();
                if (class_exists('Modul') AND method_exists($Modul, 'end'))
                {
                    $Modul->end();
                }
                ?>
            </body>
        </html>
    
        <?php 
    }
}
?>