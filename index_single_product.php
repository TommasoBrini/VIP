<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "VIP - Single Product";
$templateParams["nome"] = "single_product.php";
$templateParams["bg"] = "white";
$templateParams["slider"] = FALSE;

define("JS_DIR", "./js/add_product.js");

require("template/base.php");
?>