<?php
class installlayout
{
     public function Admin($err)
    {
        ?>
         <!DOCTYPE html>
        <html>
            <head>
                <title>WebMT Install</title>
                <link rel="stylesheet" href="html/css/install.css" type="text/css"/>
                <link rel="icon" type="image/vnd.microsoft.icon" href="html/icons/favicon.ico" />
                <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="html/icons/favicon.ico" />
                <link rel="stylesheet" href="html/jquery/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="all" />
                <link rel="stylesheet" href="html/classes/jqtransformplugin/jqtransform.css" type="text/css" media="all" />
                <script src="html/jquery/js/jquery-1.7.1.min.js" type="text/javascript"></script>
                <script src="html/jquery/js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
                <script type="text/javascript" src="html/classes/jqtransformplugin/jquery.jqtransform.js" ></script>
                <script>
                	$(function() {
                		$( "input:submit", "#content" ).button();
                	});
                        $(function(){
                                $("html").jqTransform();
                        });
                </script>
            </head>
            <body>
                <div id="content">
                    <div class="top_label">
                        <label><?php echo $GLOBALS['lang']['adminuser']; ?></label>
                    </div>
                    <div class="inside">
                        <div class="error">            
                            <?php
                            foreach ($err as $wert)
                               {
                                   echo $wert;
                               }
                             ?>
                         </div>
                         <form autocomplete="off" action="install.php?f=2" method="post">
                             <table cellpadding="5" cellspacing="0" class="tl_login_table" summary="Input fields">
                                  <tr>
                                    <td width="150"><label for="username"><?php echo $GLOBALS['lang']['username']; ?></label></td>
                                    <td align="right"><input type="text" name="username" size="20" /></td>
                                  </tr>
                                  <tr>
                                    <td><label for="password"><?php echo $GLOBALS['lang']['password']; ?></label></td>
                                    <td align="right"><input type="password" name="password" size="20" /></td>
                                  </tr>
                                  <tr>
                                    <td><label for="password2"><?php echo $GLOBALS['lang']['password2']; ?></label></td>
                                    <td align="right"><input type="password" name="password2" size="20" /></td>
                                  </tr>
                                  <tr>
                                  <td></td>
                                  <td><input type="submit" value="<?php echo $GLOBALS['lang']['next']; ?>"></td>
                                  </tr>
                            </table>

                        </form>
                    <div>
                </div>
            </body>
        </html>

        <?php
    }
    
    public function Database($err)
    {
        $_SESSION['Admin'] = false;
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title>WebMT Install</title>
                <link rel="stylesheet" href="html/css/install.css" type="text/css"/>
                <link rel="icon" type="image/vnd.microsoft.icon" href="html/icons/favicon.ico" />
                <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="html/icons/favicon.ico" />
                <link rel="stylesheet" href="html/jquery/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="all" />
                <link rel="stylesheet" href="html/classes/jqtransformplugin/jqtransform.css" type="text/css" media="all" />
                <script src="html/jquery/js/jquery-1.7.1.min.js" type="text/javascript"></script>
                <script src="html/jquery/js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
                <script type="text/javascript" src="html/classes/jqtransformplugin/jquery.jqtransform.js" ></script>
                <script>
                	$(function() {
                		$( "input:submit", "#content" ).button();
                	});
                        $(function(){
                                $("html").jqTransform();
                        });
                </script>
            </head>
            <body>
                <div id="content">
                    <div class="top_label">
                        <label><?php echo $GLOBALS['lang']['database']; ?></label>
                    </div>
                    <div class="inside">
                        <div class="error">
                            <?php
                            foreach ($err as $wert)
                               {
                                   echo $wert;
                               }
                             ?>
                         </div>            
                        <form autocomplete="off" action="install.php?f=1" method="post">
                             <table cellpadding="5" cellspacing="0" class="tl_login_table" summary="Input fields">
                                  <tr>
                                    <td width="150px"><label for="adresse"><?php echo $GLOBALS['lang']['dbaddress']; ?></label></td>
                                    <td align="right"><input type="text" name="adresse" size="20" value="localhost"/></td>
                                  </tr>
                                  <tr>
                                    <td><label for="benutzer"><?php echo $GLOBALS['lang']['username']; ?></label></td>
                                    <td align="right"><input type="text" name="benutzer" size="20" /></td>
                                  </tr>
                                  <tr>
                                    <td><label for="passwort"><?php echo $GLOBALS['lang']['password']; ?></label></td>
                                    <td align="right"><input type="password" name="passwort" size="20" /></td>
                                  </tr>
                                  <tr>
                                    <td><label for="datenbank"><?php echo $GLOBALS['lang']['database']; ?>:</label></td>
                                    <td align="right"><input type="text" name="datenbank" size="20" /></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td><input type="submit" value="<?php echo $GLOBALS['lang']['next']; ?>"></td>
                                  </tr>
                            </table>  
                        </form>
                   <div>
                </div>
            </body>
        </html>

        <?php
    }
}
?>