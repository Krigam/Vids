<?php
class VideoDetailsForm{

    private $con;

    // pass con variable
    public function __construct($con){
        $this->con=$con;
    }

    // create html Upload Form
    public function createUploadForm(){
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();
        $privacyInput = $this->createPrivacyInput();
        $categoriesInput=$this->createCategoriesInput();
        $uploadButton=$this->createUploadButton();
        return "<form action='processing.php' method='POST' enctype='multipart/form-data'>
                    $fileInput
                    $titleInput
                    $descriptionInput
                    $privacyInput
                    $categoriesInput
                    $uploadButton
                </form>";
    }

    private function createFileInput(){
        return
        "<div class='form-group'>
             <input name='fileInput' type='file' class='form-control-file' required>
        </div>";
    }

    private function createTitleInput(){
        return
        "<div class='form-group'>
             <input name='titleInput' class='form-control' type='text' placeholder='Titel' required>
        </div>";
    }

    private function createDescriptionInput(){
        return
        "<div class='form-group'>
             <textarea name='descriptionInput' placeholder='Beschreibung' class='form-control' rows='3'></textarea>
        </div>";
    }

    private function createPrivacyInput(){
        return
        "<div class='form-group'>
            <select name='privacyInput' class='form-control'>
                <option value='0'>Öffentlich</option>
                <option value='1'>Privat</option>
          </select>
       </div>";
    }

    // get categories from server and create Input for them
    private function createCategoriesInput(){
        // Querry for Categories
        $query=$this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html="<div class='form-group'>
        <select name='categoryInput' class='form-control'>";

        // Store Categories as Array
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $name=$row["name"];
            $id=$row["id"];
            // add for each category one new option
            $html.="<option value='$id'>$name</option>";
        }
        $html.="</select></div>";
        return $html;
    }

    private function createUploadButton(){
        return "<button class='btn btn-primary' name='uploadButton' type='submit'>Upload</button>";
    }
}
?>