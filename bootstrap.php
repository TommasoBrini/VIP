<?php
    require_once("db/database.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "VIP", 3307);
    define("IMG_DIR", "./img/");
?>