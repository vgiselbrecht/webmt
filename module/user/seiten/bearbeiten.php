<?php
class bearbeiten
{
    function head()
    {
        $DB = $GLOBALS['WMF']->DB;
        if (isset($_REQUEST['userid']))
        {
            $where = Array();
            $where[] = $DB->where("id", "=",$_REQUEST['userid']);
            $data = $DB->select("user", $where);
            $data = $data[0];
        }
        if (isset($_REQUEST['groupid']))
        {
            $where = Array();
            $where[] = $DB->where("id", "=",$_REQUEST['groupid']);
            $data = $DB->select("groups", $where);
            $data = $data[0];
        }
    
        if (isset($_REQUEST['mf']))
        {
            if ($_REQUEST['mf'] == 1)
            {
                if ($_POST['configusername'] == NULL)
                {
                    $GLOBALS['err'][] = $GLOBALS['lang']['errorempty'];
                }
                if ($_POST['configpassword'] != $_POST['configpassword2'])
                {
                   $GLOBALS['err'][] = $GLOBALS['lang']['errorpassword2'];
                }
                $DB = $GLOBALS['WMF']->DB;
                $where[] = $DB->where("name", "like", $_POST["configusername"]);
                $controldata = $DB->select("user", $where);
                $controldata = $controldata[0];
                if ($controldata != "" AND $_POST['configusername'] != $data['name'])
                   {
                       $GLOBALS['err'][] = $GLOBALS['lang']['exist'];
                   } 
              if (empty($GLOBALS['err']))
                 {
                        $set = Array();
                        $set[] = $DB->set("name", $_POST['configusername']);
                        if ($_POST['configpassword'] != NULL AND $_POST['configpassword'] != '000000')
                        {
                            $set[] = $DB->set("passwort", md5($_POST['configpassword']));
                        }
                        if (isset($_POST['admin']) AND $_POST['admin'] == 'yes')
                        {
                            $set[] = $DB->set("admin", 1);
                        }
                        else
                        {
                            $set[] = $DB->set("admin", 0);
                        }
                        $where = Array();
                        $where[] = $DB->where("id", "=", $_REQUEST['userid']);
                        $DB->update("user", $set, $where);
                        //Gruppenrechte löschen
                        unset($where);
                        $where[] = $DB->where("userId", "=", $_REQUEST['userid']);
                        $oldgroups = $DB->select("useringroup", $where);
                        foreach ($oldgroups as $groups)
                        {
                            $DB->delete('useringroup', $groups['id']);
                        }
                        //Modulrechte löschen
                        unset($where);
                        $where[] = $DB->where("userId", "=", $_REQUEST['userid']);
                        $oldmoduls = $DB->select("userrights", $where);
                        foreach ($oldmoduls as $moduls)
                        {
                            $DB->delete('userrights', $moduls['id']);
                        }
                        //Gruppenrechte schreiben
                        foreach ($_POST as $key => $value)
                        {
                            if(substr($key, 0, 6) == 'groups'){
                                unset($values);
                                $values [] = $DB->values("groupId", $value);  
                                $values [] = $DB->values("userId", $_REQUEST['userid']);  
                                $DB->insert('useringroup', $values);
                            }
                            if(substr($key, 0, 5) == 'modul'){
                                unset($values);
                                $values [] = $DB->values("modul", $value);  
                                $values [] = $DB->values("userId", $_REQUEST['userid']);  
                                $DB->insert('userrights', $values);
                            }
                        }
                        header("Location: ?seite=bearbeiten&userid=".$_REQUEST['userid']);
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
                $controldata = $DB->select("user", $where);
                $controldata = $controldata[0];
                if ($controldata != "" AND $_POST['newgroupname'] != $data['name'])
                   {
                       $GLOBALS['err'][] = $GLOBALS['lang']['existgroup'];
                   } 
              if (empty($GLOBALS['err']))
                 {
                        $set = Array();
                        $set[] = $DB->set("name", $_POST['newgroupname']);
                        $where = Array();
                        $where[] = $DB->where("id", "=", $_REQUEST['groupid']);
                        $DB->update("groups", $set, $where);
                        //Modulrechte löschen
                        unset($where);
                        $where[] = $DB->where("groupId", "=", $_REQUEST['groupid']);
                        $oldmoduls = $DB->select("grouprights", $where);
                        foreach ($oldmoduls as $moduls)
                        {
                            $DB->delete('grouprights', $moduls['id']);
                        }
                        //Module schreiben
                        foreach ($_POST as $key => $value)
                        {
                            if(substr($key, 0, 5) == 'modul'){
                                unset($values);
                                $values [] = $DB->values("modul", $value);  
                                $values [] = $DB->values("groupId", $_REQUEST['groupid']);  
                                $DB->insert('grouprights', $values);
                            }
                        }
                        header("Location: ?seite=bearbeiten&groupid=".$_REQUEST['groupid']);
                 }
            }
        }
    }
    function body()
    {
        $DB = $GLOBALS['WMF']->DB;
        if (isset($_REQUEST['userid']))
        {
            $where = Array();
            $where[] = $DB->where("id", "=",$_REQUEST['userid']);
            $data = $DB->select("user", $where);
            $data = $data[0];
            //Gruppen zugehörigkeit
            unset($where);
            $where[] = $DB->where("userId", "=",$_REQUEST['userid']);
            $ingroups = $DB->select("useringroup", $where);
            $groupIds = array();
            if ($ingroups)
            {
                foreach ($ingroups as $groups)
                {
                    $groupIds[] = $groups['groupId'];
                }
            }
            //Gruppen möglichkeiten
            unset($where);
            $where[] = $DB->where("id", "!=", "NULL");
            $groupdata = $DB->select("groups");
        }
        if (isset($_REQUEST['groupid']))
        {
            $where = Array();
            $where[] = $DB->where("id", "=",$_REQUEST['groupid']);
            $data = $DB->select("groups", $where);
            $data = $data[0];
        }
        
        if (!isset($_REQUEST['mf']) OR !empty($GLOBALS['err']))
        {
        ?>
    	<div class="content_nav">
            <a href="?choo+choo=train"><?php echo $GLOBALS['lang']['back']; ?></a>
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
          if (isset($_REQUEST['userid']))
          {
          ?>
          <form autocomplete="off" action="?mf=1&seite=bearbeiten&id=<?php echo $_REQUEST['id']; ?>&userid=<?php echo $_REQUEST['userid']; ?>" method="post" >
              <h3><?php echo $GLOBALS['lang']['data']; ?></h3>  
              <table cellpadding="5" cellspacing="0" class="tl_login_table" summary="Input fields">
                  <tr>
                    <td width="150"><label for="configusername"><?php echo $GLOBALS['lang']['username']; ?></label></td>
                    <td align="right"><input value="<?php echo $data['name']; ?>" type="text" name="configusername" size="20" /></td>
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
                    <td><label for="admin"><?php echo $GLOBALS['lang']['admin']; ?>: </label></td>
                    <td><input type="checkbox" <?php if ($data['admin'] == 1){ echo 'checked="checked"';}?> value="yes" name="admin" size="20" /></td>
                  </tr>
                  <tr>
                  </tr>
            </table>
            <h3><?php echo $GLOBALS['lang']['group']; ?></h3>
            <?php
            //Gruppen
            if ($groupdata)
            {
                echo '<table class="table" cellpadding="4" cellspacing="0">';
                foreach($groupdata as $wert)
                {
                    echo '<tr class="line">';
                        echo '<td  class="tdleft" align="center">';
                           echo '<input id="ig'.$wert['id'].'"  type="checkbox" value="'.$wert['id'].'" name="groups_'.$wert['id'].'" size="20" ';
                           if (in_array($wert['id'], $groupIds))
                           {
                               echo 'checked="checked"';
                           }
                           echo '/>';
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
          if (isset($_REQUEST['groupid']))
          {
          ?>
            <form autocomplete="off" action="?mf=2&seite=bearbeiten&id=<?php echo $_REQUEST['id']; ?>&groupid=<?php echo $_REQUEST['groupid']; ?>" method="post" >
             <h3><?php echo $GLOBALS['lang']['data']; ?></h3>  
                <table cellpadding="5" cellspacing="0" class="tl_login_table" summary="Input fields">
                  <tr>
                    <td width="150"><label for="newgroupname"><?php echo $GLOBALS['lang']['groupname']; ?></label></td>
                    <td align="right"><input value="<?php echo $data['name']; ?>" type="text" name="newgroupname" size="20" /></td>
                  </tr>
            </table>
            <?php
                $this->modulrights('group');
            ?>
             <br /><input type="submit" value="<?php echo $GLOBALS['lang']['save']; ?>">
          </form>
          <?php
          }
          ?>
        </div>
      <?php 
      }
  }
  function modulrights($type)
    {
        $DB = $GLOBALS['WMF']->DB;
        $where = array();
        if($type == 'user')
        {
            $where[] = $DB->where("userId", "=", $_REQUEST['userid']);
            $modulsel = $DB->select("userrights", $where);   
        }
        if ($type == 'group')
        {
            $where[] = $DB->where("groupId", "=", $_REQUEST['groupid']);
            $modulsel = $DB->select("grouprights", $where);   
        }
        $modulrights = array();
        if ($modulsel)
        {
            foreach ($modulsel as $modulse)
            {
                $modulrights[] = $modulse['modul'];
            }
        }
        echo '<h3>'.$GLOBALS['lang']['module'].'</h3>';
        echo '<table class="table" cellpadding="4" cellspacing="0">';
        foreach($GLOBALS['module'] as $modul)
        {
            echo '<tr class="line">';
                echo '<td  class="tdleft" align="center">';
                    echo '<input id="im'.$modul->id.'" type="checkbox" value="'.$modul->id.'" name="modul_'.$modul->id.'" size="20" ';
                           if (in_array($modul->id, $modulrights))
                           {
                               echo 'checked="checked"';
                           }
                           echo '/>';
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