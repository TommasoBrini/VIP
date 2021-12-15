<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "VIP - Add Product";
$templateParams["nome"] = "add_product.php";
$templateParams["bg"] = "white";
$templateParams["slider"] = FALSE;

define("JS_DIR", "./js/add_product.js");

require("template/base.php");
?>