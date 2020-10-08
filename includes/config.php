<?php
ob_start();   // Turns on output buffering
session_start();

date_default_timezone_set("Europe/Berlin");

// Connect to Database
try{
    
    $con= new PDO("mysql:dbname=Vids;host=localhost","root","PHPSPOERL2020!");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

}
catch(PDOException $e){
    // Connection failed, connecting to localhost/ root
    $con= new PDO("mysql:dbname=Vids;host=localhost","root","");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}

?>
