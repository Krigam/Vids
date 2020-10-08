<?php
require_once("includes/header.php");
require_once("includes/classes/ProfileGenerator.php");

if(isset($_GET["username"])){
    $profileUsername=$_GET["username"];
}
else{
    echo "Ups. Kanal nicht gefunden";
}

$profileGenerator = new ProfileGenerator($con, $userLoggedInObj, $profileUsername);
echo $profileGenerator->create();
?>