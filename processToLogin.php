<?php
require_once("bootstrap.php");

if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["idvenditore"])){
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"], $_POST["idvenditore"]);
    if(count($login_result)==0){
        //Login failed
        $templateParams["errorlogin"] = "Error! Check email or password!";
    }
    else{
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()){
    header("Location: index.php");
}
else{
    header("Location: index_login.php");
}
?>