<?php
class ButtonProvider{

    public static $signInFunction = "notSignedIn()";

    public static function createLink($link){
        return User::isLoggedIn() ? $link : ButtonProvider::$signInFunction;
    }

    public static function createButton($text,$imageSrc,$action,$class){

        // set if image for button should be created
        $image=($imageSrc == null) ? "" : "<img src='$imageSrc'>";

        $action= ButtonProvider::createLink($action);

        // create HTML Button Element
       return 
       "<button class='$class' onclick='$action'>
        $image
        <span class='text'>$text</span>
       </button>";
    }

    public static function createUserProfileButton($con, $username){
        $userObj=new User($con, $username);
        $profilePic=$userObj->getProfilePic();
        $link="profile.php?username=$username";

        if(!$username){
            $profilePic="assets/images/profile/profile.png";
            $link="signin.php";
        }

        return "<a href='$link'>
            <img src='$profilePic' class='profilePicture'>
        </a>
        ";
    }

    public static function createSubscribeButton($con, $userToObj, $userLoggedInObj){
        $userTo=$userToObj->getUsername();
        $userLoggedIn= $userLoggedInObj->getUsername();
        
        $isSubscribedTo= $userLoggedInObj->isSubscribedTo($userTo);
        $buttonText=$isSubscribedTo ? "ABONNIERT" : "ABONNIEREN";
        $buttonText.=" " . $userToObj->getSubscriberCount();
        $buttonClass= $isSubscribedTo ? "unsubscribe button" : "subscribe button";
        $action ="subscribe(\"$userTo\",\"$userLoggedIn\",this)";

        $button= ButtonProvider::createButton($buttonText, null, $action, $buttonClass);

        return "
        <div class='subscribeButtonContainer'>
            $button
        </div>
        ";
    }

    public static function createUserProfileNavigationButton($con, $username){
        if(User::isLoggedIn()){
            return ButtonProvider::createUserProfileButton($con, $username);
        }
        else{
            return "
            <a href='signin.php'>
                <span class='signInLink'>ANMELDEN</span>
            </a>
            ";
        }

    }
}
?>