<?php 
class FormSanitizer{

    public static function sanitizeFormNames($inputText){
        // delete html Tags for security reasons
        $inputText = strip_tags($inputText);
        // replace Spaces at start/ end from string
        $inputText = trim($inputText);
        // lower Case all letters
        $inputText = strtolower($inputText);
        // First letter in Upper Case
        $inputText = ucfirst($inputText);
        return $inputText;
    }

    public static function sanitizeFormUsername($inputText){
        // delete html Tags for security reasons
        $inputText = strip_tags($inputText);
        // replace Spaces
        $inputText = str_replace(" ","",$inputText);
        return $inputText;
    }

    public static function sanitizeFormPassword($inputText){
        // delete html Tags for security reasons
        $inputText = strip_tags($inputText);
        return $inputText;
    }

    public static function sanitizeFormEmail($inputText){
        // delete html Tags for security reasons
        $inputText = strip_tags($inputText);
        // replace Spaces
        $inputText = str_replace(" ","",$inputText);
        return $inputText;
    }

}

?>