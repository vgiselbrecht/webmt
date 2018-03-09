<?php
class modulefunction
{
    function search()
    {
    
    $module = Array();
    
    $handle = @opendir('module');
    $rights = $this->userrights();
    
    while ($file = @readdir ($handle)){
        if (preg_match("/^\.{1,2}$/",$file)){ 
            continue;
        }
        if ($this->haverights($file, $rights))
        {
            if(file_exists('module/'.$file.'/config.php'))
            {
                include 'module/'.$file.'/config.php';
                if (isset($config['en.name']) AND isset($config['icon100']) AND isset($config['icon50']) AND isset($config['file']) AND isset($config['version']))
                    {
                    if(file_exists('module/'.$file.'/'.$config['file']))
                    {
                        $modul = new modullist();
                        if (isset($config[$_SESSION['lang'].'.name']))
                        {
                            $modul->name = $config[$_SESSION['lang'].'.name'];
                        }
                        else 
                        {
                            $modul->name = $config['en.name'];
                        }
                        if(file_exists('module/'.$file.'/lang/'.$_SESSION['lang'].'/lang.php'))
                        {
                            $modul->lang = 'lang/'.$_SESSION['lang'].'/lang.php'; 
                        }
                        else if(file_exists('module/'.$file.'/lang/en/lang.php')) 
                        {
                            $modul->lang = 'lang/en/lang.php';
                        }

                        $modul->id = $file;
                        $modul->icon100 = $config['icon100'];
                        $modul->icon50 = $config['icon50'];
                        $modul->datei = $config['file'];
                        if (isset($config['db']))
                        {
                            $modul->db = $config['db'];
                        }
                        if (isset($config['priority']))
                        {
                            $modul->priority = $config['priority'];
                        }
                        $modul->ordner = $file;
                        $modul->version = $config['version'];
                        $module[] = $modul;
                    }   
                } 
            }
        }
    }
    @closedir($handle);
    $GLOBALS['module'] = $module;  
    }
    
    function includes()
    {
        if ($_REQUEST['id'] != 'home')
        {
            foreach ($GLOBALS['module'] as $wert)
            {
                if ($wert->id == $_REQUEST['id'])
                {
                    if ($wert->db != "")
                    {
                        include 'module/'.$wert->ordner.'/'.$wert->db;
                    }
                    if ($wert->lang != "")
                    {
                        include 'module/'.$wert->ordner.'/'.$wert->lang;
                    }
                    include 'module/'.$wert->ordner.'/'.$wert->datei;
                }
            }
            $_SESSION['id'] = $_REQUEST['id'];
        }
    }
    
    function userrights()
    {
        $DB = $GLOBALS['WMF']->DB;
        $where[] = $DB->where("userId", "=", $_SESSION['user_id']);
        $groups = $DB->select("useringroup", $where);
        $rights = array();
        if ($groups)
        {
            foreach ($groups as $group)
            {
                unset($where);
                $where[] = $DB->where("groupId", "=", $group['groupId']);
                $rightsgroup = $DB->select("grouprights", $where);
                foreach ($rightsgroup as $right)
                {
                    $rights[] = $right;
                }
            }
        }
        unset($where);
        $where[] = $DB->where("userId", "=", $_SESSION['user_id']);
        $rightsuser = $DB->select("userrights", $where);
        if ($rightsuser)
        {
            foreach ($rightsuser as $right)
            {
                $rights[] = $right;
            }
        }
        return $rights;
    }
    function haverights($file, $rights)
    {
        if ($_SESSION['admin'])
        {
            return true;
        }
        if ($rights)
        {
            foreach ($rights as $right)
            {
                if ($right)
                {
                    if ($right['modul'] == $file)
                    {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}

class modullist
{
    public $id = "";
    public $name = "";
    public $icon100 = "";
    public $icon50 = "";
    public $datei = "";
    public $ordner = "";
    public $db = "";
    public $lang = "";
    public $priority = "";
    public $version = "";
 }
?>