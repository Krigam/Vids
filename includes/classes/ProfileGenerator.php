<?php
require_once("ProfileData.php");
class ProfileGenerator{

    private $con, $userLoggedInObj, $profileData;

    public function __construct($con, $userLoggedInObj, $profileUsername){
        $this->con=$con;
        $this->userLoggedInObj=$userLoggedInObj;
        $this->profileData= new ProfileData($con, $profileUsername);
    }

    public function create(){
        $profileUsername = $this->profileData->getProfileUsername();
        
        if(!$this->profileData->userExists()){
            return "Der Kanal existiert leider noch nicht :(";
        }

        $headerSection=$this->createHeaderSection();
        $contentSection=$this->createContentSection();

        return "
        <div class='profileContainer'>
            $headerSection
            $contentSection
        </div>
        ";
    }

    public function createHeaderSection(){
        $profileImage= $this->profileData->getProfilePic();
        $name =$this->profileData->getUsername();
        $subCount= $this->profileData->getSubscriberCount();

        $button=$this->createHeaderButton();

        return "
        <div class='profileHeader'>
            <div class='userInfoContainer'>
                <img class='profileImage' src='$profileImage'>
                <div class='userInfo'>
                    <span class='title'>$name</span>
                    <span class='subscriberCount'>$subCount Abonnenten</span>
                </div>
            </div>

            <div class='buttonContainer'>
                <div class='buttonItem'>
                    $button
                </div>
            </div>

        </div>
        
        ";


    }
    
    public function createContentSection(){
        $videos=$this->profileData->getUsersVideos();

        if(sizeof($videos)>0){
            $videoGrid= new VideoGrid($this->con,$this->userLoggedInObj);
            $videoGridHtml= $videoGrid->create($videos,null,false);
        }
        else{
            $videoGridHtml="<span>Keine Videos vorhanden</span>";
        }

        return $videoGridHtml;
    }

    private function createHeaderButton(){
        if($this->userLoggedInObj->getUsername()==$this->profileData->getProfileUsername()){
            return "";
        }
        else{
            return ButtonProvider::createSubscribeButton(
                $this->con, 
                $this->profileData->getProfileUserObj(), 
                $this->userLoggedInObj);
        }
    }

}


?>