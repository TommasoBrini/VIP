<?php
require "bootstrap.php";

$id = $_GET["id"];
$oldVal = $_GET["old"];
$newVal = $dbh->getAuctionPrice($id);

if($oldVal < $newVal){
    echo json_encode(number_format($newVal));
} else {
    echo json_encode(-1);
}
?>