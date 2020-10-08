<?php
require_once("includes/header.php");

$subscriptionsProvider=new SubscriptionsProvider($con, $userLoggedInObj);
$videos = $subscriptionsProvider->getVideos();

$videoGrid= new VideoGrid($con, $userLoggedInObj);
?>

<div class='largeVideoGridContainer'>

<?php
    if(sizeof($videos)>0){
        echo $videoGrid->createLarge($videos, "Neues von deinen abonnierten Kanälen", false);

    }
    else{
        echo "Leider hast du noch niemanden abonniert :(";
    }
?>

</div>