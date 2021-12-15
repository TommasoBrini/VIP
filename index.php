<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Home - Aste";
$templateParams["nome"] = "aste.php";
$templateParams["aste"] = $dbh->getAuctions();


require("template/base.php");
?>