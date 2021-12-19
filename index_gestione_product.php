<?php
require_once("bootstrap.php");

if(!isset($_GET["action"]) || ($_GET["action"]!=1&& $_GET["action"]!=2 && $_GET["action"]!=3) || ($_GET["action"]!=1 && !isset($_GET["id"]))){
    header("location: index.php");
}

if($_GET["action"]!=1){
    $risultato = $dbh->getProductById($_GET["id"]);
    foreach($risultato as $ris):
        $templateParams["prodotto"] = $ris;
    endforeach;
} else {
    $templateParams["prodotto"] = getEmptyProduct();
}

$templateParams["titolo"] = "VIP - Add Product";
$templateParams["nome"] = "admin-form.php";
$templateParams["bg"] = "white";
$templateParams["slider"] = FALSE;
$templateParams["azione"] = getAction($_GET["action"]);

define("JS_DIR", "./js/add_product.js");

require("template/base.php");
?>