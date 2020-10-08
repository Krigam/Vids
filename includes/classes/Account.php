<?php
class Account{

    private $con;
    private $errorArray=array();

    public function __construct($con){
        $this->con=$con;
    }

    public function login($un,$pw){
        // Hashing password
        $pw= hash("Sha512", $pw);

        // Checking login data
        $query=$this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
        $query->bindParam(":un", $un);
        $query->bindParam(":pw", $pw);
        $query->execute();

        if($query->rowCount()==1){
            return true;
        }
        else{
            array_push($this->errorArray,Constants::$loginfailed);
            return false;
        }
    }

    public function register($fn, $ln, $un, $em, $em2, $pw, $pw2){
        // validate information
        $this->valFirstName($fn);
        $this->valLastName($ln);
        $this->valUsername($un);
        $this->valEmail($em,$em2);
        $this->valPassword($pw, $pw2);

        if(empty($this->errorArray)){
            // Insert Data in Table users
            return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
        }
        else{
            return false;
        }
    }

    // Insert Data in Table users
    public function insertUserDetails($fn, $ln, $un, $em, $pw){
        // Hashing password
        $pw= hash("Sha512", $pw);

        // set default profile picture
        $profilePicture="assets/images/profile/profilecolored.png";

        // Insert Data into table
        $query=$this->con->prepare("INSERT INTO users
                                    (firstName, lastName, username, email, password, profilePicture)
                                    VALUES(:fn,:ln,:un,:em,:pw,:pic)");
        $query->bindParam(":fn", $fn);
        $query->bindParam(":ln", $ln);
        $query->bindParam(":un", $un);
        $query->bindParam(":em", $em);
        $query->bindParam(":pw", $pw);
        $query->bindParam(":pic", $profilePicture);

        return $query->execute();
    }

    // validate First Name
    private function valFirstName($fn){
        if(strlen($fn)>25 || strlen($fn)<2){
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }

    // validate last Name
    private function valLastName($ln){
        if(strlen($ln)>25 || strlen($ln)<2){
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    // validate username
    private function valUsername($un){
        if(strlen($un)>25 || strlen($un)<5){
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        // Check if username already used
        $query = $this->con->prepare("SELECT username FROM users WHERE username=:un");
        $query->bindParam(":un", $un);
        $query->execute();

        if($query->rowCount() != 0){
            array_push($this->errorArray, Constants::$usernameTaken);
            return;
        }
    }

    // validate email
    private function valEmail($em, $em2){
        if($em != $em2){
            array_push($this->errorArray, Constants::$emailsDoNotMatch);
            return;
        }

        // check if email is validate
        if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        // email already used
        $query = $this->con->prepare("SELECT email FROM users WHERE email=:em");
        $query->bindParam(":em", $em);
        $query->execute();

        if($query->rowCount() != 0){
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }
    }

        // validate password
        private function valPassword($pw, $pw2){
            if($pw != $pw2){
                array_push($this->errorArray, Constants::$passwordsDoNotMatch);
                return;
            }

            // Check for special symbols
            if(preg_match("/[^A-Za-z0-9]/",$pw)){
                array_push($this->errorArray, Constants::$passwordContainsSpezialSymbols);
                return;
            }

            if(strlen($pw)>30 || strlen($pw)<5){
                array_push($this->errorArray, Constants::$passwordCharacters);
            }
    
        }

    public function getError($error){
        if(in_array($error, $this->errorArray)){
            return "<span class='errorMessage'>$error</span>";
        }
    }
}

?>