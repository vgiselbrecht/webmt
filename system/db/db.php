<?php 

class Database
{
    
    var $driver;
    
    function __construct()
    {
      switch ($GLOBALS['CONFIG']['dbDriver'])
      {
      case "MySQL":
           if (!class_exists('dbdriver')) {
               require("driver/mysql.php");
           }
       break;
       }
       $this->driver = new dbdriver();
    }
    
    public function select($from, $where = null)
    {
        return $this->driver->select($from, $where);  
    }
    
    public function insert($into, $values)
    {
        return $this->driver->insert($into, $values);
    } 
    
    public function update($table, $set, $where)
    {
        return $this->driver->update($table, $set, $where);
    }
    
    public function createtable($table, $spalten)
    {
        return $this->driver->createtable($table, $spalten);
    } 
    
    public function droptable($table)
    {
        return $this->driver->droptable($table);
    } 
    
    public function delete($table, $id)
    {
        return $this->driver->delete($table, $id);
    }
    
    public function sql($sql)
    {
        return $this->driver->sql($sql);
    }
    
    public function where($spalte, $condition, $wert)
    {
        $werte = new where();
        $werte->spalte = $spalte;
        $werte->condition = $condition;
        $werte->wert = $wert;
        return $werte;
    }
    
    public function set($spalte, $wert)
    {
        $set = new set();
        $set->spalte = $spalte;
        $set->wert = $wert;
        return $set;
    }
    
    public function values($spalte, $wert)
    {
        $values = new values();
        $values->spalte = $spalte;
        $values->wert = $wert;
        return $values;
    }
    public function column($name, $type, $extra = null)
    {
        $spalten = new column();
        $spalten->name = $name;
        $spalten->type = $type;
        $spalten->extra = $extra;
        return $spalten;
    }
}
class where
{
    public $spalte = "";
    public $condition = ""; 
    public $wert = ""; 
}

class set
{
    public $spalte = "";
    public $wert = "";
}
class values
{
    public $spalte = "";
    public $wert = "";
}
class column
{
    public $name = "";
    public $type = "";
}
 ?>