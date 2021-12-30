<?php
require_once("bootstrap.php");

/*if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["idvenditore"])){
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
}*/


$templateParams["titolo"] = "VIP - Login";
$templateParams["nome"] = "login.php";
$templateParams["bg"] = "black";
$templateParams["button1"] = "LOGIN";
$templateParams["button2"] = "REGISTRATION";
$templateParams["href1"] = "index_login.php";
$templateParams["href2"] = "index_registration.php";
$templateParams["class1"] = TRUE;
$templateParams["class2"] = FALSE;
$templateParams["slider"] = TRUE;
$templateParams["css"] = "./css/style_Login_Registration.css";
$templateParams["js"] = "./js/login_registration.js";
//$templateParams["users"] = $dbh->getUsers();
//$templateParams["aste"] = $dbh->getAuctions();

require("template/base.php");
?>