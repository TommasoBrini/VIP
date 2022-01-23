<?php
require_once("bootstrap.php");

if(!isset($_GET["id"])){
    header("location: index.php");
}

if(isUserLoggedIn()){
    $result = $dbh->checkSeller();
    if($result){
        $templateParams["venditore"]=$result;
    }
} else {
    $templateParams["js"] = "./js/single_product.js";
}

$templateParams["titolo"] = "VIP - Single Product";
$templateParams["nome"] = "single_product.php";
$templateParams["bg"] = "white";
$templateParams["css"] = "./css/styleSingleProduct.css";
$templateParams["slider"] = FALSE;
$templateParams["notify"] = "auctionNotify.php";
$templateParams["loadNotify"] = "./js/checkNewNotify.php";
$templateParams["checkNotify"] = "./ajax/newNotify.php";


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