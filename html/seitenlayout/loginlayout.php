<?php
class loginlayout
{
public function Design($err)
{
 ?>
 <!DOCTYPE html>
 <html>
    <head>
        <title>WebMT Login</title>
        <link rel="stylesheet" href="html/css/login.css" type="text/css"/>
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
                <label>WebMT - <?php echo $GLOBALS['lang']['title']; ?></label>
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
                <form action="index.php?f=1<?php if (isset($_REQUEST['id'])){ echo '&id='.$_REQUEST['id'];} ?>" method="post">
                    <table cellpadding="5" cellspacing="0" class="tl_login_table" summary="Input fields">
                        <tr>
                            <td width="120px"><label class="labels" for="username"><?php echo $GLOBALS['lang']['username']; ?></label></td>
                            <td align="right"><input type="text" name="username" style="width: 140px;" /></td>
                        </tr>
                        <tr>
                            <td><label class="labels" for="password"><?php echo $GLOBALS['lang']['password']; ?></label></td>
                            <td align="right"><input type="password" name="password" style="width: 140px;" /></td>
                        </tr>
                        <tr>
                        <td><?php echo $GLOBALS['lang']['language']; ?></td>
                        <td><select name="lang" style="width: 120px;">
                            <?php
                            foreach ($GLOBALS['langs'] as $lang)
                            {
                                echo '<option ';
                                if ($_SESSION['lang'] == $lang[0]) { 
                                    echo 'selected="selected"'; 
                                    
                                } 
                                echo ' value='.$lang[0].'>'.$lang[1].'</option>';
                            }
                            ?>
                        </select></td>
                        </tr>
                        <tr>
                        <td></td>
                        <td><input type="submit" value="<?php echo $GLOBALS['lang']['login']; ?>"></td>
                        </tr>
                    </table>
                </form>
            </div>
            <br />
            <br />
        </div>
    </body>
</html>
<?php
}
 }
?>