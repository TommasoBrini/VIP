<?php
require_once("bootstrap.php");

if(!isset($_GET["id"])){
    header("location: index.php");
}

$templateParams["titolo"] = "VIP - Single Product";
$templateParams["nome"] = "single_product.php";
$templateParams["bg"] = "white";
$templateParams["css"] = "./css/style.css?v=1";
$templateParams["slider"] = FALSE;
$risultato = $dbh->getProductById($_GET["id"]);
foreach($risultato as $ris):
    $templateParams["prodotto"] = $ris;
endforeach;

define("JS_DIR", "./js/add_product.js");

require("template/base.php");
?>