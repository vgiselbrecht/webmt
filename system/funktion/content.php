<?php 
class content
{
 public function Index()
    {
        if ($_REQUEST['id'] == 'home')
        {   
            $home = new home();
            $home->Index();
        }
        if ($_REQUEST['id'] == 'password')
        {   
            $password = new password();
            $password->Index();
        }
    }
public function Titel()
    {
        if ($_REQUEST['id'] == 'home')
        {
            echo $GLOBALS['lang']['overview'];
        }
        else if ($_REQUEST['id'] == 'password')
        {
            echo $GLOBALS['lang']['changepassword'];
        }
        else
        {
            $error = true;
            foreach ($GLOBALS['module'] as $wert)
            {
                if ($wert->id == $_REQUEST['id'])
                {
                    echo $wert->name;
                    $error = false;
                    break;
                }
            }
            if ($error){
                echo 'ERROR 404: '.$GLOBALS['lang']['e404'];
            }
            $_SESSION['id'] = $_REQUEST['id'];
        }
    }
}
 ?>