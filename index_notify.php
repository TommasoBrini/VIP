<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "VIP - News";
$templateParams["nome"] = "notify.php";
$templateParams["bg"] = "black";
$templateParams["slider"] = FALSE;
$templateParams["css"] = "./css/styleCart.css";
$templateParams["notify"] = $dbh -> getNotify();
if(count($dbh->getNotify())==0){
    $templateParams["NoNews"]="TRUE";
}

require("template/base.php");

?>