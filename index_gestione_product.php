<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "VIP - Add Product";
$templateParams["nome"] = "admin-form.php";
$templateParams["bg"] = "white";
$templateParams["slider"] = FALSE;
$templateParams["prodotto"] = getEmptyProduct();

define("JS_DIR", "./js/add_product.js");

require("template/base.php");
?>