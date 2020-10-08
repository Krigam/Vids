<?php
require_once("ButtonProvider.php"); 
class CommentControls {

    private $con, $comment, $userLoggedInObj;

    public function __construct($con, $comment, $userLoggedInObj){
        $this->con = $con;
        $this->comment = $comment;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {
        
        $replyButton = $this->createReplyButton();
        $likesCount = $this->createLikesCount();
        $likeButton = $this->createLikeButton();
        $dislikeButton = $this->createDislikeButton();
        $replySection = $this->createReplySection();
        
        return "<div class='controls'>
                    $replyButton
                    $likesCount
                    $likeButton
                    $dislikeButton
                </div>
                $replySection";
    }

    private function createReplyButton() {
        $text = "ANTWORTEN";
        $action = "toggleReply(this)";

        return ButtonProvider::createButton($text, null, $action, "replyButton");
    }

    private function createLikesCount() {
        $text = $this->comment->getLikes();

        if($text == 0) $text = "";

        return "<span class='likesCount'>$text</span>";
    }

    private function createReplySection() {
        $postedBy = $this->userLoggedInObj->getUsername();
        $videoId = $this->comment->getVideoId();
        $commentId = $this->comment->getId();

        $profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);
        
        $cancelButtonAction = "toggleReply(this)";
        $cancelButton = ButtonProvider::createButton("Abbrechen", null, $cancelButtonAction, "cancelComment");

        $postButtonAction = "postComment(this, \"$postedBy\", $videoId, $commentId, \"repliesSection\")";
        $postButton = ButtonProvider::createButton("Antworten", null, $postButtonAction, "postComment");

        return "<div class='commentForm hidden'>
                    $profileButton
                    <textarea class='commentBodyClass' placeholder='Einen Kommentar veröffentlichen...'></textarea>
                    $cancelButton
                    $postButton
                </div>";
    }

    private function createLikeButton() {
        $commentId = $this->comment->getId();
        $videoId = $this->comment->getVideoId();
        $action = "likeComment($commentId, this, $videoId)";
        $class = "likeButton";

        $imageSrc = "assets/images/icons/like.png";

        if($this->comment->wasLikedBy()) {
            $imageSrc = "assets/images/icons/liked.png";
        }

        return ButtonProvider::createButton("", $imageSrc, $action, $class);
    }

    private function createDislikeButton() {
        $commentId = $this->comment->getId();
        $videoId = $this->comment->getVideoId();
        $action = "dislikeComment($commentId, this, $videoId)";
        $class = "dislikeButton";

        $imageSrc = "assets/images/icons/dislike.png";

        if($this->comment->wasDislikedBy()) {
            $imageSrc = "assets/images/icons/disliked.png";
        }

        return ButtonProvider::createButton("", $imageSrc, $action, $class);
    }
}
?>