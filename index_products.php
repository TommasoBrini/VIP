<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Home - Products";
$templateParams["nome"] = "products.php";
$templateParams["bg"] = "white";
$templateParams["button1"] = "AUCTIONS";
$templateParams["button2"] = "PRODUCTS";
$templateParams["href1"] = "index.php";
$templateParams["href2"] = "index_products.php";
$templateParams["css"] = "./css/style.css?v=1";
$templateParams["class1"] = FALSE;
$templateParams["class2"] = TRUE;
$templateParams["slider"] = TRUE;
$templateParams["products"] = $dbh->getProducts();
$templateParams["aviableProducts"] = $dbh -> getAviableProducts();
$templateParams["productAviable"] = "productAviable.php";
$templateParams["productSoldOut"] = "productSoldOut.php";


define("JS_DIR", "./js/home.js");

require("template/base.php");
?>