<?php
require_once("bootstrap.php");

if(isset($_POST["email"]) && isset($_POST["password"])){
    $login_result = dbh->checkLogin($_POST["email"], $_POST["password"], $_POST["idvenditore"]);
    if(count($login_result)==0) {
        //Login failed
        $templateParams["errorLogin"] = "Error! Check email or password!";
    } else {
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()){
    $templateParams["nome"] = "index.php";
}
else {
    $templateParams["nome"] = "index_login.php";
}

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

/*$templateParams["users"] = $dbh->getUsers();*/
//$templateParams["aste"] = $dbh->getAuctions();

define("JS_DIR", "./js/login_registration.js");

require("template/base.php");
?>