<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "VIP - Cart";
$templateParams["nome"] = "cart.php";
$templateParams["bg"] = "black";
$templateParams["slider"] = FALSE;
$templateParams["css"] = "./css/styleCart.css";
$templateParams["rows"] = $dbh->getRows();
$templateParams["orderExist"] = $dbh->checkOrderExist();
$templateParams["updateQuantity"] = "ajax/updateQuantity.php";

define("JS_DIR", "./js/home.js");

require("template/base.php");
?>