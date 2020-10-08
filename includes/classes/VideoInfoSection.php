<?php
require_once("includes/classes/VideoInfoControls.php"); 
class VideoInfoSection{

    private $video, $con, $userLoggedInObj;

    public function __construct($con, $video, $userLoggedInObj){
        $this->video=$video;
        $this->con=$con;
        $this->userLoggedInObj=$userLoggedInObj;
    }

    public function create(){
        return $this->createPrimaryInfo() . $this->createSecondaryInfo();
    }

    // create video info (views, likes...)
    private function createPrimaryInfo(){
        $title= $this->video->getTitle();
        $views= $this->video->getViews();

        $videoInfoControls= new VideoInfoControls($this->video, $this->userLoggedInObj);
        $controls = $videoInfoControls->create();

        return "
        <div class='videoInfo'>
            <h1>$title</h1>

            <div class='bottomSection'>
                <span class='viewCount'>$views Aufrufe</span>
                $controls
            </div>
        </div>
        ";
    }

    // create user info (subscribed, profile...)
    private function createSecondaryInfo(){

        $description= $this->video->getDescription();
        $uploadDate= $this->video->getUploadDate();
        $uploadedBy= $this->video->getUploadedBy();
        $profileButton= ButtonProvider::createUserProfileButton($this->con, $uploadedBy);

        // if video uploaded by logged in user
        if($uploadedBy == $this->userLoggedInObj->getUsername()){
            $actionButton="";
        }
        else{
        // video not from logged in user -> show subscribe button
            $userToObject= new User($this->con, $uploadedBy);
            $actionButton=ButtonProvider::createSubscribeButton($this->con, $userToObject, $this->userLoggedInObj);
        }
        
        return "
        <div class='secondaryInfo'>
            <div class='topRow'>
                $profileButton

            <div class='uploadInfo'>
                <span class='owner'>
                    <a href='profile.php?username=$uploadedBy'>
                        $uploadedBy
                        </a>
                </span>

                <span class='date'>Veröffentlicht am $uploadDate</span>
            </div>
            $actionButton
            </div>

            <div class='descriptionContainer'>
                $description
            </div>
        </div>
        ";
    }
}
?>