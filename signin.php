<!-- Connect to Database -->
<?php 
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/FormSanitizer.php");

$account= new Account($con);

if(isset($_POST["submitButton"])){
    // get form information and format it
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    // log in
    $wasSuccessful= $account->login($username,$password);

    if($wasSuccessful){
        // set Session variable -> user logged in
        $_SESSION["userLoggedIn"]=$username;
        // redirect to index.php
        header("Location: index.php");
    }
}

// function to get posted form values and reload them
function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vids</title>

    <!-- Style Sheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">

    <!-- Shared CDN and libaries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>

    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <a class="logoContainer" href="index.php">
                    <img src="assets/images/icons/vids_logo.png" title="Vids" alt="Vids">   
                </a>
                <h3>Einloggen</h3>
            </div>
            <div class="loginForm">
                <form action="signin.php" method="POST">
                    <?php echo $account->getError(Constants::$loginfailed); ?>
                    <input value="<?php getInputValue('username');?>" type="text" name="username" placeholder="Benutzername" autocomplete="off" required>

                    <input type="password" name="password" placeholder="Passwort" autocomplete="off" required>

                    <button class='btn btn-primary' name='submitButton' type='submit' value="SUBMIT">Anmelden</button>
                </form>
            </div>

            <a class="signInMessage" href="signup.php">
                <div>Hast du noch kein ein Konto? Hier registrieren!</div>
            </a>

        </div>
    </div>

</body>
</html>