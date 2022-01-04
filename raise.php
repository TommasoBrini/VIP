<?php
require "bootstrap.php";

$raise = htmlspecialchars($_POST["raise"]);

$dbh->raise($_GET['id'], $_GET['base']+$raise, $_SESSION['email']);

header("location: index.php");
?>