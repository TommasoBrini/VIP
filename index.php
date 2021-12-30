<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Home - Auctions";
$templateParams["nome"] = "auctions.php";
$templateParams["bg"] = "white";
$templateParams["button1"] = "AUCTIONS";
$templateParams["button2"] = "PRODUCTS";
$templateParams["href1"] = "index.php";
$templateParams["href2"] = "index_products.php";
$templateParams["css"] = "./css/style.css?v=1";
$templateParams["class1"] = TRUE;
$templateParams["class2"] = FALSE;
$templateParams["slider"] = TRUE;
$templateParams["auctions"] = $dbh->getAuctions();
$templateParams["auctionBefore"] = "auctionBefore.php";
$templateParams["auctionWinning"] = "auctionWinning.php";
$templateParams["auctionLosing"] = "auctionLosing.php";
$templateParams["auctionLose"] = "auctionLose.php";
$templateParams["auctionWin"] = "auctionWin.php";
$templateParams["js"] = "./js/home.js";

require("template/base.php");
?>