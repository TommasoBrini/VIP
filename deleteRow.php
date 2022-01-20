<?php
    require_once("bootstrap.php");
    $dbh->deleteRow($_GET['id']);
    header("Location: index_cart.php");
?>