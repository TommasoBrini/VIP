<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "VIP - Registration";
$templateParams["nome"] = "registration.php";
$templateParams["bg"] = "black";
$templateParams["button1"] = "LOGIN";
$templateParams["button2"] = "REGISTRATION";
$templateParams["slider"] = TRUE;

define("JS_DIR", "./js/home.js");

require("template/base.php");
?>