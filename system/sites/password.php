<?php

class password
{
 public function Index()
    {
        if (isset($_REQUEST['mf']))
        {
            if ($_REQUEST['mf'] == 1)
            {
                if ($_POST['configpassword'] != $_POST['configpassword2'])
                {
                   $GLOBALS['err'][] = $GLOBALS['lang']['errorpassword2'];
                }
              if (empty($GLOBALS['err']))
                 {
                        $DB = $GLOBALS['WMF']->DB;
                        $set = Array();
                        if ($_POST['configpassword'] != NULL AND $_POST['configpassword'] != '000000')
                        {
                            $set[] = $DB->set("passwort", md5($_POST['configpassword']));
                            $where = Array();
                            $where[] = $DB->where("id", "=", $_SESSION['user_id']);
                            $DB->update("user", $set, $where);
                        }
                 }
            }
        }
        echo $GLOBALS['WMF']->DISPLAY->errors();     
         ?>
        <script>
        	$(function() {
        		$( "input:submit", ".formular" ).button();
        	});
    	</script>
        <div class="formular">
          <form autocomplete="off" action="?id=password&mf=1" method="post" >
              <h3><?php echo $GLOBALS['lang']['changepassword']; ?></h3>  
              <table cellpadding="5" cellspacing="0" class="tl_login_table" summary="Input fields">
                  <tr>
                    <td width="150"><label for="configusername"><?php echo $GLOBALS['lang']['username']; ?></label></td>
                    <td align="right"><label style="float:left"><?php echo $_SESSION['name']; ?></label></td>
                  </tr>
                  <tr>
                    <td><label for="configpassword"><?php echo $GLOBALS['lang']['password']; ?></label></td>
                    <td align="right"><input value="000000" onblur="if(this.value==''){this.value='000000';}" onfocus="javascript:if(this.value='000000'){this.value='';}" type="password" name="configpassword" size="20" /></td>
                  </tr>
                  <tr>
                    <td><label for="configpassword2"><?php echo $GLOBALS['lang']['password2']; ?></label></td>
                    <td align="right"><input value="000000" onblur="if(this.value==''){this.value='000000';}" onfocus="javascript:if(this.value='000000'){this.value='';}" type="password" name="configpassword2" size="20" /></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td><input type="submit" value="<?php echo $GLOBALS['lang']['save']; ?>"></td>
                  </tr>
            </table>
          </form>
        <?php
    }
    
 }
?>
