<?php
require_once("includes/header.php");
require_once("includes/classes/TrendingProvider.php");

$trendingProvider=new TrendingProvider($con, $userLoggedInObj);
$videos = $trendingProvider->getVideos();

$videoGrid= new VideoGrid($con, $userLoggedInObj);
?>

<div class='largeVideoGridContainer'>

<?php
    if(sizeof($videos)>0){
        echo $videoGrid->createLarge($videos, "Die Trends der letzten Woche", false);

    }
    else{
        echo "Leider keine Trends :(";
    }
?>

</div>