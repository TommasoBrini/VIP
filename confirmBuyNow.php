
<?php
    require "bootstrap.php";
    $id = $_POST['id'];

    $dbh->buyNow($id, $_SESSION['email']);
?>