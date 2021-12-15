<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "VIP - Login";
$templateParams["nome"] = "login.php";
$templateParams["bg"] = "black";
$templateParams["button1"] = "LOGIN";
$templateParams["button2"] = "REGISTRATION";
$templateParams["slider"] = TRUE;
$templateParams["aste"] = $dbh->getAuctions();

define("JS_DIR", "./js/home.js");

require("template/base.php");
?>