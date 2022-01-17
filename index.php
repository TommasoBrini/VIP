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
$templateParams["auctionBefore"] = "auction/auctionBefore.php";
$templateParams["auctionWinning"] = "auction/auctionWinning.php";
$templateParams["auctionLosing"] = "auction/auctionLosing.php";
$templateParams["auctionLose"] = "auction/auctionLose.php";
$templateParams["auctionWin"] = "auction/auctionWin.php";
$templateParams["update"] = "ajax/update.php";
$templateParams["back"] = "ajax/back.php";
$templateParams["confirmBuyNow"] = "ajax/confirmBuyNow.php";
$templateParams["confirmRaise"] = "ajax/raise.php";
$templateParams["timer"] = "js/timer.php";
$templateParams["checkSeller"] = "js/checkSeller.php";
$templateParams["checkUpdate"] = "js/checkUpdate.php";
$templateParams["buyNow"] = "js/buyNow.php";
$templateParams["raise"] = "js/raise.php";
$templateParams["js"] = "./js/home.js";

require("template/base.php");
?>