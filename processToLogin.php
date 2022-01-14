<?php
require_once("bootstrap.php");

if(isset($_POST["email"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);
    if(!$login_result){
        //Login failed and I stay on login
    }
    else{
        registerLoggedUser($_POST["email"]);
    }
}

//Password verify!

if(isUserLoggedIn()){
    header("Location: index.php");
}
else{
    header("Location: index_login.php");
}
?>

