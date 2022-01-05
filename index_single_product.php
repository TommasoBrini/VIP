<?php
require_once("bootstrap.php");

if(!isset($_GET["id"])){
    header("location: index.php");
}

if(isUserLoggedIn()){
    $result = $dbh->checkSeller();
    $templateParams["venditore"]=$result;
}

$templateParams["titolo"] = "VIP - Single Product";
$templateParams["nome"] = "single_product.php";
$templateParams["bg"] = "white";
$templateParams["css"] = "./css/styleSingleProduct.css";
$templateParams["slider"] = FALSE;

$check=count($dbh->checkProduct($_GET["id"]));
if($check == 0){
    $bool = TRUE;
} else {
    $bool = FALSE;
}
$templateParams["check"]=$bool;
$risultato = $dbh->getProductById($_GET["id"], $check);
foreach($risultato as $ris):
    $templateParams["prodotto"] = $ris;
endforeach;

require("template/base.php");
?>