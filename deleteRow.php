<?php
    require_once("bootstrap.php");
    $idDelete = $_GET['id'];
    $dbh->deleteRow($idDelete);
    header("Location: index_cart.php");
?>