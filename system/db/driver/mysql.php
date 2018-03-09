<?php

require("system/config/db.php"); 

class dbdriver
{

    function __construct()
    {
        $connectionid = @mysql_connect ($GLOBALS['CONFIG']['dbHost'], $GLOBALS['CONFIG']['dbUser'], $GLOBALS['CONFIG']['dbPass']);
        @mysql_select_db ($GLOBALS['CONFIG']['dbDatabase'], $connectionid);  
    }
    
    public function select ($from, $where = null)
    { 
        $sql = "SELECT * FROM ".$from;
       
        if($where)
        {
            //Where Werte herausfinden 
            $where_werte = "";
            foreach ($where as $wert)
            {
                if ($where_werte != "")
                {
                     $where_werte = $where_werte." AND ";
                }  
                $where_werte = $where_werte."(".$wert->spalte." ".$wert->condition." '".$wert->wert."')";
            }
            $sql .= " WHERE ".$where_werte;
        }
        
        $result = mysql_query ($sql) or $GLOBALS['err'][] = mysql_error();
        if (mysql_num_rows($result) > 0)
        {
            while($row = mysql_fetch_array($result))
            {
                $data[] = $row;
            }
        }   
        if (isset($data))
        {
            return $data;       
        }
    }
    
    public function insert($into, $values)
    {

       $spalte = "";
       $werte = "";
       foreach ($values as $wert)
        {
        if ($spalte != "")
          {
              $spalte = $spalte.", ";
              $werte = $werte.", ";
          }
        $spalte = $spalte.$wert->spalte;
        $werte = $werte."'".$wert->wert."'";
        }
       $value_werte = ' ('.$spalte.') VALUES ('.$werte.')';

       $sql = "INSERT INTO ".
        $into.
        $value_werte;
       mysql_query ($sql) or $GLOBALS['err'][] = mysql_error(); 
    }
    
    public function update($table, $set, $where)
    {

       $set_werte = "";
       foreach ($set as $wert)
        {
            if ($set_werte != "")
            {
               $set_werte = $set_werte.', ';
            }
            $set_werte = $set_werte.$wert->spalte." = '".$wert->wert."'";
        }
       $where_werte = "";
       foreach ($where as $wert)
        {
            if ($where_werte != "")
            {
               $where_werte = $where_werte.' AND ';
            }
            $where_werte = $where_werte.$wert->spalte." ".$wert->condition." '".$wert->wert."'";
        }

       $sql = "UPDATE ".$table." SET ".$set_werte." WHERE ".$where_werte; 
        mysql_query ($sql) or $GLOBALS['err'][] = mysql_error();
    }
    
    public function createtable($table, $spalten)
    {

        $sql = "CREATE TABLE IF NOT EXISTS ".$table." (id INT AUTO_INCREMENT, PRIMARY KEY (id))";
        mysql_query ($sql) or $GLOBALS['err'][] = mysql_error();
        foreach ($spalten as $wert)
        {
            $exists = false;
            $columns = mysql_query("show columns from $table");
            while($c = mysql_fetch_assoc($columns)){
                if($c['Field'] == $wert->name){
                    $exists = true;
                    break;
                }
            }      
            if(!$exists){
                $sql = "ALTER TABLE ".$table." ADD COLUMN ".$wert->name." ".$wert->type;
                if ($wert->extra)
                {
                    $sql .= ' '.$wert->extra;
                }
                mysql_query ($sql) or $GLOBALS['err'][] = mysql_error();
            }
        }
    }
    
    public function droptable($table)
    {
        $sql = "DROP TABLE ".$table;
        mysql_query ($sql) or$GLOBALS['err'][] = mysql_error();
    }
    
    public function delete($table, $id)
    {
        $sql = "DELETE FROM ".$table." WHERE id='".$id."'";
        mysql_query ($sql) or $GLOBALS['err'][] = mysql_error();
    }
    
    public function sql($sql)
    {
       return mysql_query ($sql) or $GLOBALS['err'][] = mysql_error();  
    }
    
}
 ?>