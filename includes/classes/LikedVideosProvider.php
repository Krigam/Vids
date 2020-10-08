<?php
class LikedVideosProvider{
    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj){
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos(){
        $videos = array();

        $query= $this->con->prepare("
        SELECT videoid FROM likes WHERE username=:username AND ISNULL(commentid)
        ORDER BY id DESC
        ");
        $query->bindParam(":username", $username);
        $username=$this->userLoggedInObj->getUsername();

        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $video = new Video($this->con, $row["videoid"], $this->userLoggedInObj);
            array_push($videos, $video);
        }
        return $videos;
    }
}
?>