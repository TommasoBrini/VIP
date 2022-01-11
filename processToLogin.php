<?php
require_once("bootstrap.php");

if(isset($_POST["email"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["email"], $passwordCrypt);
    if(count($login_result)==0){
        //Login failed and I stay on login
    }
    else{
        registerLoggedUser($login_result[0]);
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

