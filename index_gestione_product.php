<?php
require_once("bootstrap.php");

if(!isset($_GET["action"]) || ($_GET["action"]!=1&& $_GET["action"]!=2 && $_GET["action"]!=3) || ($_GET["action"]!=1 && !isset($_GET["id"]))){
    header("location: index.php");
}

if($_GET["action"]!=1){
    $check=count($dbh->checkProduct($_GET["id"]));
    $risultato = $dbh->getProductById($_GET["id"], $check);
    $templateParams["id"]=$_GET["id"];
    foreach($risultato as $ris):
        $templateParams["prodotto"] = $ris;
    endforeach;
} else {
    $templateParams["prodotto"] = getEmptyProduct();
}

if(isUserLoggedIn()){
    $result = $dbh->checkSeller();
    $templateParams["venditore"]=$result;
}


$templateParams["titolo"] = "VIP - Admin";
$templateParams["nome"] = "admin-form.php";
$templateParams["css"] = "./css/style.css?v=1";
$templateParams["bg"] = "white";
$templateParams["slider"] = FALSE;
$templateParams["azione"] = $_GET["action"];
$templateParams["js"] = "./js/gestione_product.js";

require("template/base.php");
?>