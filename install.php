<?php
header('content-type: text/html; charset=utf-8');
//Klassen laden
require("system/register.php");

//Session starten
$Session = new Session();
$Session->SessionStart();

class install
{
    public function Index()
    {
    
    $err = Array();
    
        if (isset($_REQUEST['f']))
        {
         if ($_REQUEST['f'] == 1)
         {
            if ($_POST['adresse'] == NULL OR $_POST['benutzer'] == NULL OR $_POST['datenbank'] == NULL)
            {
              $err[] = $GLOBALS['lang']['errorempty'];             
            }
            else
            {
            
                $con = @mysql_connect($_POST['adresse'],$_POST['benutzer'],$_POST['passwort']);
                if (!$con)
                {
                    $err[] = $GLOBALS['lang']['errordbcon'];
                }
                else
                {
                    if (!mysql_select_db($_POST['datenbank'],$con))
                    {
                        mysql_query("CREATE DATABASE ".$_POST['datenbank'],$con);
                    }
                }
            
                @mysql_close($con);

                $inhalt = '<?php 
                         $GLOBALS["CONFIG"]["dbDriver"] = "MySQL";
                         $GLOBALS["CONFIG"]["dbHost"] = "'.$_POST['adresse'].'";
                         $GLOBALS["CONFIG"]["dbUser"] = "'.$_POST['benutzer'].'";
                         $GLOBALS["CONFIG"]["dbPass"] = "'.$_POST['passwort'].'";
                         $GLOBALS["CONFIG"]["dbDatabase"] = "'.$_POST['datenbank'].'";
                          ?>';
                $handle = fopen ("system/config/db.php", "w");
                fwrite ($handle, $inhalt);
                fclose ($handle);            
             
                require("system/config/db.php");
                if (empty($err))
                {
                    $DBMuster = new dbmuster();
                    $DBMuster->Index();
                    $_SESSION['Admin'] = true;
                }                
            }                       
         }
         if ($_REQUEST['f'] == 2)
            {
                if ($_POST['username'] == NULL OR $_POST['password'] == NULL OR $_POST['password2'] == NULL)
                {
                    $err[] = $GLOBALS['lang']['errorempty'];
                }
                if ($_POST['password'] != $_POST['password2'])
                {
                   $err[] = $GLOBALS['lang']['errorpassword2'];
                }
              if (empty($err))
                 {
                    $DB = new Database();
                    $values = Array();
                    $values [] = $DB->values("name", $_POST["username"]);
                    $values [] = $DB->values("passwort", md5($_POST['password']));
                    $values [] = $DB->values("admin", 1);
                    $DB->insert("user", $values);
                 }   
            }
        }

        //Seitenlayout laden
        $Design = new installlayout();

        if (isset($_REQUEST['f']))
        {
         if (empty($err) AND $_REQUEST['f'] == 1)
            {
                if (isset($_SESSION['Admin']) AND $_SESSION['Admin'] == true)
                {
                    $Design->Admin($err);                    
                }
            }
         if (empty($err) AND $_REQUEST['f'] == 2)
            {
                $_SESSION['Admin'] = false;
                header ("Location: index.php");
            }
         if (!empty($err) AND $_REQUEST['f'] == 1)
            {
                $Design->Database($err);  
            }
         if (!empty($err) AND $_REQUEST['f'] == 2)
            {
                if (isset($_SESSION['Admin']) AND $_SESSION['Admin'] == true)
                {
                    $Design->Admin($err);
                }
            } 
        }
        else
        {
         $Design->Database($err);   
        }
    }
}

    $Install = new install();
    $Install->Index();   

 ?>