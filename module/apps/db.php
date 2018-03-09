<?php 
$DB = $GLOBALS['WMF']->DB;
$spalten [] = $DB->column("name", "varchar(80)");
$spalten [] = $DB->column("zustand", "varchar(80)");
$DB->createtable("apps", $spalten);
 ?>

