<?php 
require_once("includes/config.php");
require_once("includes/classes/ButtonProvider.php");
require_once("includes/classes/User.php");
require_once("includes/classes/Video.php"); 
require_once("includes/classes/VideoGrid.php"); 
require_once("includes/classes/VideoGridItem.php"); 
require_once("includes/classes/SubscriptionsProvider.php"); 
require_once("includes/classes/NavigationMenuProvider.php"); 

// Check if User logged in
$usernameLoggedIn= User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$userLoggedInObj= new User($con, $usernameLoggedIn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vids</title>

    <!-- Style Sheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">

    <!-- Shared CDN and libaries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <!-- Scripts from assets -->
    <script src="assets/js/common.js"></script>
    <script src="assets/js/userActions.js"></script>

</head>

<body>

    <div id="pageContainer">

        <!-- Navigation Section -->
        <div id="mastHeadContainer">
            <!-- Menu Button -->
            <button class="navShowHide">
                <img src="assets/images/icons/menu.png" title="Menu" alt="Menu">
            </button>

            <!-- Logo -->
            <a class="logoContainer" href="index.php">
                 <img src="assets/images/icons/vids_logo.png" title="Vids" alt="Vids">   
            </a>

            <!-- Searchbar -->
            <div class="searchBarContainer">
                <form action="search.php" method="GET">
                    <input type="text" class="searchBar" name="search" placeholder="Suchen nach...">
                    <button class="searchButton">
                         <img src="assets/images/icons/search.png" title="Search" alt="SearchButton">
                    </button>
                </form>
            </div>

            <div class="rightIcons">
                <?php

                if(User::isLoggedIn()){
                echo "<a href='upload.php'>
                    <img class='uploadRight' src='assets/images/icons/uploadcolored.png' title='Upload' alt='Upload'>
                </a>";
                }
                ?>

                <?php
                    echo ButtonProvider::createUserProfileNavigationButton($con, $userLoggedInObj->getUsername());
                ?>
             </div>

        </div>

        <!-- Side Navigation Menu -->
        <div id="sideNavContainer" style="display:none">

        <?php

        $navigationProvider= new NavigationMenuProvider($con, $userLoggedInObj);
        echo $navigationProvider->create();

        ?>

        </div>

        <!-- Content Section -->
        <div id="mainSectionContainer">
            <div id="mainContentContainer">