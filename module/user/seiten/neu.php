<?php
class neu
{
    function head()
    {
        if (isset($_REQUEST['mf']))
        {
            if ($_REQUEST['mf'] == 1)
            {
                if ($_POST['newusername'] == NULL OR $_POST['newpassword'] == NULL OR $_POST['newpassword2'] == NULL)
                {
                    $GLOBALS['err'][] = $GLOBALS['lang']['errorempty'];
                }
                if ($_POST['newpassword'] != $_POST['newpassword2'])
                {
                   $GLOBALS['err'][] = $GLOBALS['lang']['errorpassword2'];
                }
                $DB = $GLOBALS['WMF']->DB;
                $where[] = $DB->where("name", "like", $_POST["newusername"]);
                $controldata = $DB->select("user", $where);
                $controldata = $controldata[0];
                if ($controldata != "")
                   {
                       $GLOBALS['err'][] = $GLOBALS['lang']['exist'];
                   } 
              if (empty($GLOBALS['err']))
                 {
                      	$values = Array();
                        $values [] = $DB->values("name", $_POST["newusername"]);
                        $values [] = $DB->values("passwort", md5($_POST['newpassword']));
                        if (isset($_POST['admin']) AND $_POST['admin'] == 'yes')
                        {
                            $values [] = $DB->values("admin", 1);
                        }
                        $DB->insert("user", $values);
                        //Gruppenzugehörigkeit und Module schreiben
                        unset($where);
                        $where[] = $DB->where("name", "=", $_POST["newusername"]);
                        $user = $DB->select("user", $where);
                        foreach ($_POST as $key => $value)
                        {
                            if(substr($key, 0, 6) == 'groups'){
                                unset($values);
                                $values [] = $DB->values("groupId", $value);  
                                $values [] = $DB->values("userId", $user[0]['id']);  
                                $DB->insert('useringroup', $values);
                            }
                            if(substr($key, 0, 5) == 'modul'){
                                unset($values);
                                $values [] = $DB->values("modul", $value);  
                                $values [] = $DB->values("userId", $user[0]['id']);  
                                $DB->insert('userrights', $values);
                            }
                        }
                        header("Location: ?seite=bearbeiten&userid=".$user[0]['id']);
                 }
            }
            if ($_REQUEST['mf'] == 2)
            {
                if ($_POST['newgroupname'] == NULL)
                {
                    $GLOBALS['err'][] = $GLOBALS['lang']['errorempty'];
                }
                $DB = $GLOBALS['WMF']->DB;
                $where[] = $DB->where("name", "like", $_POST["newgroupname"]);
                $controldata = $DB->select("groups", $where);
                $controldata = $controldata[0];
                if ($controldata != "")
                   {
                       $GLOBALS['err'][] = $GLOBALS['lang']['existgroup'];
                   } 
              if (empty($GLOBALS['err']))
                 {
                      	$values = Array();
                        $values [] = $DB->values("name", $_POST["newgroupname"]);
                        $data = $DB->insert("groups", $values);
                        //Module schreiben
                        unset($where);
                        $where[] = $DB->where("name", "=", $_POST["newgroupname"]);
                        $group = $DB->select("groups", $where);
                        foreach ($_POST as $key => $value)
                        {
                            if(substr($key, 0, 5) == 'modul'){
                                unset($values);
                                $values [] = $DB->values("modul", $value);  
                                $values [] = $DB->values("groupId", $group[0]['id']);  
                                $DB->insert('grouprights', $values);
                            }
                        }
                          header("Location: ?seite=bearbeiten&groupid=".$group[0]['id']);
                 }
            }
        }
    }
    function body()
    {
        if (!isset($_REQUEST['mf']) OR !empty($GLOBALS['err']))
        {
        ?>
    	<div class="content_nav">
            <a href="?back=true"><?php echo $GLOBALS['lang']['back']; ?></a>
        </div>    
        <?php
        echo $GLOBALS['WMF']->DISPLAY->errors();  
        ?>
        <script>
        	$(function() {
        		$( "input:submit", ".formular" ).button();
        	});
    	</script>
        <div class="formular">
        <?php
        if ($_REQUEST['type'] == 'user'){
        ?>
          <form autocomplete="off" action="?mf=1&seite=neu&type=user&id=<?php echo $_REQUEST['id']; ?>" method="post">
            <h3><?php echo $GLOBALS['lang']['data']; ?></h3>
            <table cellpadding="5" cellspacing="0" class="tl_login_table" summary="Input fields">
                  <tr>
                    <td width="150"><label for="newusername"><?php echo $GLOBALS['lang']['username']; ?></label></td>
                    <td align="right"><input type="text" name="newusername" size="20" /></td>
                  </tr>
                  <tr>
                    <td><label for="newpassword"><?php echo $GLOBALS['lang']['password']; ?></label></td>
                    <td align="right"><input type="password" name="newpassword" size="20" /></td>
                  </tr>
                  <tr>
                    <td><label for="newpassword2"><?php echo $GLOBALS['lang']['password2']; ?></label></td>
                    <td align="right"><input type="password" name="newpassword2" size="20" /></td>
                  </tr>
                  <tr>
                    <td><label for="admin"><?php echo $GLOBALS['lang']['admin']; ?>: </label></td>
                    <td><input type="checkbox" value="yes" name="admin" size="20" /></td>
                  </tr>
            </table>
            <h3><?php echo $GLOBALS['lang']['group']; ?></h3>
            <?php
            //Gruppen
            $DB = $GLOBALS['WMF']->DB;
            $where = Array();
            $where[] = $DB->where("id", "!=", "NULL");
            $groupdata = $DB->select("groups");
            if ($groupdata)
            {
                echo '<table class="table" cellpadding="4" cellspacing="0">';
                foreach($groupdata as $wert)
                {
                    echo '<tr class="line">';
                        echo '<td  class="tdleft" align="center">';
                            echo '<input id="ig'.$wert['id'].'" type="checkbox" value="'.$wert['id'].'" name="groups_'.$wert['id'].'" size="20" />';
                        echo '</td>';
                        echo '<td width="750px"  class="tdnormal"><label for="ig'.$wert['id'].'" >';
                                echo $wert['name'];
                        echo '</label></td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            else
            {
                echo $GLOBALS['lang']['nogroup'];
            }
            $this->modulrights('user');
            ?>
            <br /><input type="submit" value="<?php echo $GLOBALS['lang']['save']; ?>">
          </form>
      <?php 
        }
        else
        {
            ?>
            <form autocomplete="off" action="?mf=2&seite=neu&type=group&id=<?php echo $_REQUEST['id']; ?>" method="post" >
                <h3><?php echo $GLOBALS['lang']['data']; ?></h3>  
                <table cellpadding="5" cellspacing="0" class="tl_login_table" summary="Input fields">
                      <tr>
                        <td width="150"><label for="newgroupname"><?php echo $GLOBALS['lang']['groupname']; ?></label></td>
                        <td align="right"><input type="text" name="newgroupname" size="20" /></td>
                      </tr>
                </table>               
                <?php
                $this->modulrights('group');
                ?>
                <br /><input type="submit" value="<?php echo $GLOBALS['lang']['save']; ?>">
              </form>
            <?php
        }
        echo '</div>';
      }
    }
    function modulrights($type)
    {
        echo '<h3>'.$GLOBALS['lang']['module'].'</h3>';
        echo '<table class="table" cellpadding="4" cellspacing="0">';
        foreach($GLOBALS['module'] as $modul)
        {
            echo '<tr class="line">';
                echo '<td  class="tdleft" align="center">';
                    echo '<input id="im'.$modul->id.'" type="checkbox" value="'.$modul->id.'" name="modul_'.$modul->id.'" size="20" />';
                echo '</td>';
                echo '<td width="750px"  class="tdnormal"><label for="im'.$modul->id.'" >';
                        echo $modul->name;
                echo '</label></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}
   ?>