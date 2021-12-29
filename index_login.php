<?php
require_once("bootstrap.php");

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