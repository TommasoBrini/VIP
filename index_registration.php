<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "VIP - Registration";
$templateParams["nome"] = "registration.php";
$templateParams["bg"] = "black";
$templateParams["button1"] = "LOGIN";
$templateParams["button2"] = "REGISTRATION";
$templateParams["href1"] = "index_login.php";
$templateParams["href2"] = "index_registration.php";
$templateParams["class1"] = FALSE;
$templateParams["class2"] = TRUE;
$templateParams["slider"] = TRUE;
$templateParams["css"] = "./css/styleLoginRegistration.css";
$templateParams["js"] = "./js/login_registration.js";
$templateParams["checkSellerExist"] = $dbh->checkSellerExist();
//$templateParams["users"] = $dbh->getUsers();
//$templateParams["aste"] = $dbh->getAuctions();

require("template/base.php");
?>