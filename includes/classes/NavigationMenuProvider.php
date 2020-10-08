<?php
class NavigationMenuProvider{

    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj){
        $this->con=$con;
        $this->userLoggedInObj= $userLoggedInObj;
    }

    public function create(){
        $menuHtml = $this->createNavItem("Startseite", "assets/images/icons/home.png", "index.php");
        $menuHtml .= $this->createNavItem("Trending", "assets/images/icons/trending.png", "trending.php");
        $menuHtml .= "<span class='heading'></span>";
        $menuHtml .= "<br>";

        if(User::isLoggedIn()){
            $username = $_SESSION["userLoggedIn"];
            $menuHtml .= $this->createNavItem("Mein Profil", "assets/images/profile/profile.png", "profile.php?username=$username");
            $menuHtml .= $this->createNavItem("Abonnements", "assets/images/icons/subscriptions.png", "subscriptions.php");
            $menuHtml .= $this->createNavItem("Gefällt mir", "assets/images/icons/like.png", "likedVideos.php");    
            $menuHtml .= $this->createNavItem("Hochladen", "assets/images/icons/upload.png", "upload.php");
            $menuHtml .= $this->createNavItem("Ausloggen", "assets/images/icons/logout.png", "logout.php");
            $menuHtml .= "<br>";
            $menuHtml .= "<span class='heading'>Abonnements</span>";
            $menuHtml .= $this->createSubscriptionsSection();
        }

        return "
        <div class='navigationItems'>
            $menuHtml
        </div>
        ";

    }

    private function createNavItem($text, $icon, $link){
        return "
        <a href='$link'>
            <div class='navigationItem'>
                    <img src='$icon'>
                    <span>$text</span>
            </div>
        </a>
        ";
    }

    private function createNavSub($text, $icon, $link){
        return "
        <a href='$link'>
            <div class='navigationItemSub'>
                    <img src='$icon'>
                    <span class='sub'>$text</span>
            </div>
        </a>
        ";
    }

    private function createSubscriptionsSection(){
        $subscriptions=$this->userLoggedInObj->getSubscriptions();
        $html= "";
        foreach($subscriptions as $sub){
            $subUsername= $sub->getUsername();
            $html .= $this->createNavSub($sub->getUsername(), $sub->getProfilePic(), "profile.php?username=$subUsername");
        }
        return $html;
    }

}
?>