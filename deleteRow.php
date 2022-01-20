<?php
    require_once("bootstrap.php");
    
    if (isset($_GET["id"])) {
        $id = $_GET['id'];
        $dbh->deleteRow($id);
    }
    header("Location: index.php");
?>