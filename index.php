<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Home - Aste";
$templateParams["nome"] = "aste.php";
$templateParams["bg"] = "white";
$templateParams["button1"] = "AUCTIONS";
$templateParams["button2"] = "PRODUCTS";
$templateParams["slider"] = TRUE;
$templateParams["aste"] = $dbh->getAuctions();

define("JS_DIR", "./js/home.js");

require("template/base.php");
?>