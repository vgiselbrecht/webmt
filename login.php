<?php 

class login
{
    public function Index()
    {    
        $err = Array();
        if (isset($_REQUEST['f']))
        {
            if ($_REQUEST['f'] == 1)
            {
                //Anmlededaten überprüfen
                $Login = new loginfunktion();
                $result = $Login->Login($_POST["username"], $_POST["password"]);
                if ($result == true)
                {
                    $_SESSION['lang'] = $_POST['lang'];
                    if (isset($_REQUEST['id']))
                    {
                        header('Location:index.php?id='.$_REQUEST['id']);   
                    }
                    else
                    {
                        header('Location:index.php');
                    }
                    exit();
               }
               else
               {
                 $err[] = $GLOBALS['lang']['error1'];  
               }
            }   
        }
        //Seitenlayout laden
        $Design = new loginlayout();
        $Design->Design($err);
    }
}

 ?>