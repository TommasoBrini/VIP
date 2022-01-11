<?php
require_once("bootstrap.php");

if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirmPassword"]) && isset($_POST["seller"])) {
    $userExist = $dbh->checkUserExist($_POST["email"]);
    if(count($userExist)==1) {
        //Already registered user
        $dbh->echoMessage("You're already registered, login!", "index_login.php");
    } else {
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            if (($_POST["password"])==($_POST["confirmPassword"])) {
                if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/', $_POST["password"])) {
                    if ($_POST["seller"]==0) {
                        $hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
                        $dbh->userInput($_POST["email"], $hash, 0);
                        $dbh->echoMessage("Registered user, login!", "index_login.php");
                    } else {
                        $hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
                        $dbh->userInput($_POST["email"], $hash, 1);
                        $dbh->echoMessage("Registered user, login!", "index_login.php");
                    }
                } else {
                    $dbh->echoMessage("It must contain at least 1 number and 1 letter. Password length: minimum 8, maximum 20!", "index_registration.php");
                }
            } else {
                $dbh->echoMessage("Password and confirm password don't match!", "index_registration.php");
            }
        } else {
            $dbh->echoMessage("Invalid email!", "index_registration.php");
        }
    }
}
?>