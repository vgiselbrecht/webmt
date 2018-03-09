<?php

class loginfunktion
{
    public function Login($benutzername, $passwort)
    {
    $DB = new Database();      
    $where = Array();
    $where[] = $DB->where("name", "like", $benutzername);
    $where[] = $DB->where("passwort", "=", md5($passwort));    
    $data = $DB->select("user", $where);
    
    //Anmeldung erfolgreich?
    if (!empty($data))
        {
         $_SESSION['ma_status']  = TRUE;
         $_SESSION['name'] = $data[0]['name'];
         $_SESSION['user_id'] = $data[0]['id'];
         $_SESSION['admin'] = $data[0]['admin'];
         return true;       
        }
    else
        {
          return false;
        }
    }
    
    public function Logout()
    {
      $_SESSION['ma_status']  = FALSE;
      $_SESSION['id'] = 0; 
      header ("Location: index.php");
    }
}
?>