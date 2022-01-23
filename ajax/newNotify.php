<?php
require "../bootstrap.php";

$id = $_GET["id"];
$n = $_GET["n"];
$actual = $dbh->getNumberOfBids($id);
if($actual > $n){
    echo json_encode(1);
} else {
    echo json_encode(0);
}
?>