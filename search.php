<?php
require_once("includes/header.php");
require_once("includes/classes/SearchResultsProvider.php");

if(!isset($_GET["search"]) || $_GET["search"] == ""){
    echo "Kein Suchbegriff eingegeben.";
    return;
}

$term=$_GET["search"];

if(!isset($_GET["orderBy"]) || $_GET["orderBy"] == "views"){
    $orderBy= "views";
}
else{
    $orderBy= "uploadDate";
}

$searchResultsProvider=new SearchResultsProvider($con, $userLoggedInObj);
$videos= $searchResultsProvider->getVideos($term,$orderBy);

$videoGrid=new VideoGrid($con, $userLoggedInObj);

?>

<div class="largeVideoGridContainer">

    <?php
        if(sizeof($videos) > 0){
            echo $videoGrid->createLarge($videos, sizeof($videos) ." Videos gefunden", true);
        }
        else{
            echo "No results found";
        }
    ?>

</div>



<?php
require_once("includes/footer.php");
?>