<?php
    require_once("../bootstrap.php");
    $id = $_GET["idRiga"];
    $quantity = $_GET["quantity"];
    $dbh->updateQuantity($quantity,$id);
?>