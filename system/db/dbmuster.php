<?php 
class dbmuster
{
    function Index()  
    {
        $DB = new Database();
        $spalten [] = $DB->column("name", "varchar(80)");
        $spalten [] = $DB->column("passwort", "varchar(80)");
        $spalten [] = $DB->column("admin", "tinyint(1)"); 
        $DB->createtable("user", $spalten);  
        unset($spalten);
        $spalten [] = $DB->column("name", "varchar(80)");
        $DB->createtable("groups", $spalten);   
        unset($spalten);
        $spalten [] = $DB->column("groupId", "int(11)");
        $spalten [] = $DB->column("modul", "varchar(80)");
        $DB->createtable("grouprights", $spalten);  
        unset($spalten);
        $spalten [] = $DB->column("userId", "int(11)");
        $spalten [] = $DB->column("modul", "varchar(80)");
        $DB->createtable("userrights", $spalten);  
        unset($spalten);
        $spalten [] = $DB->column("userId", "int(11)");
        $spalten [] = $DB->column("groupId", "int(11)");
        $DB->createtable("useringroup", $spalten);  
    }    
}

 ?>