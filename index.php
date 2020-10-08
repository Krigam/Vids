<?php require_once("includes/header.php"); ?>

<div class="videoSection">
    <?php
    $subscriptionsProvider= new SubscriptionsProvider($con, $userLoggedInObj);
    $subscriptionVideos= $subscriptionsProvider->getVideos();

    $videoGrid= new VideoGrid($con, $userLoggedInObj->getUsername());

    if(User::isLoggedIn() && sizeof($subscriptionVideos) > 0){
        echo $videoGrid->create($subscriptionVideos, "ABONNIERTE KANÄLE", false);
    }

    echo $videoGrid->create(null, "MEMES", false);

    ?>
</div>

<?php require_once("includes/footer.php"); ?>
                