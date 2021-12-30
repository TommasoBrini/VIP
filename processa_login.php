<?php
require_once("bootstrap.php");

if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["idvenditore"])){
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"], $_POST["idvenditore"]);
    if(count($login_result)==0){
        //Login fallito
        $templateParams["errorlogin"] = "Error! Check email or password!";
        echo var_dump($login_result);
        echo "aaaa";
    }
    else{
        registerLoggedUser($login_result[0]);
        echo var_dump($login_result);
        echo "bbbb";
    }
}

if(isUserLoggedIn()){
    $templateParams["titolo"] = "Home - Auctions";
    $templateParams["nome"] = "auctions.php";
    echo var_dump($login_result);
    echo "cccc";
}
else{
    $templateParams["titolo"] = "VIP - Login";
    $templateParams["nome"] = "login.php";
    echo var_dump($login_result);
    echo "dddd";
}

?>