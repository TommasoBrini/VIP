<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "VIP - Cart";
$templateParams["nome"] = "cart.php";
$templateParams["bg"] = "black";
$templateParams["slider"] = FALSE;

define("JS_DIR", "./js/home.js");

require("template/base.php");
?>