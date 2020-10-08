<?php
require_once("includes/header.php");
require_once("includes/classes/LikedVideosProvider.php");

$likedVideosProvider=new LikedVideosProvider($con, $userLoggedInObj);
$videos = $likedVideosProvider->getVideos();

$videoGrid= new VideoGrid($con, $userLoggedInObj);
?>

<div class='largeVideoGridContainer'>

<?php
    if(sizeof($videos)>0){
        echo $videoGrid->createLarge($videos, "Diese Videos gefallen dir", false);

    }
    else{
        echo "Leider hast du kein Video geliket :(";
    }
?>

</div>