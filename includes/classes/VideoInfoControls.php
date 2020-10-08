<?php
require_once("includes/classes/ButtonProvider.php"); 
class VideoInfoControls{

    private $video, $userLoggedInObj;

    public function __construct($video, $userLoggedInObj){
        $this->video=$video;
        $this->userLoggedInObj=$userLoggedInObj;
    }

    public function create(){
        $likeButton= $this->createLikeButton();
        $disLikeButton=$this->createDisLikeButton();
        
        // generate controls/ buttons html elements
        return "<div class='controls'>
            $likeButton
            $disLikeButton
        </div>";
    }

    private function createLikeButton(){
        $text= $this->video->getLikes();
        $videoId= $this->video->getId();
        $action = "likeVideo(this, $videoId)";
        $class= "likeButton";
        $imageSrc= "assets/images/icons/like.png";

        if(User::isloggedIn()){
            if($this->video->wasLikedBy()){
                $imageSrc= "assets/images/icons/liked.png";
            }
        }
        return ButtonProvider::createButton($text, $imageSrc, $action, $class);
    }

    private function createDisLikeButton(){
        $text= $this->video->getDisLikes();
        $videoId= $this->video->getId();
        $action = "disLikeVideo(this, $videoId)";
        $class= "dislikeButton";
        $imageSrc= "assets/images/icons/dislike.png";

        if(User::isloggedIn()){
            if($this->video->wasDisLikedBy()){
                $imageSrc= "assets/images/icons/disliked.png";
            }
        }

        return ButtonProvider::createButton($text, $imageSrc, $action, $class);
    }

}
?>