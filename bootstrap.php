<?php
    define("UPLOAD_DIR", "./upload/");
    require_once("db/database.php");
    require_once("utils/functions.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "VIP", 3310);
    define("IMG_DIR", "./img/");
?>