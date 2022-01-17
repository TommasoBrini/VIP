
<?php
    require "../bootstrap.php";
    $id = $_GET['id'];
    $quantity = $_POST['addCart'];

    $dbh->addCart($id, $quantity, $_SESSION['email']);
    header("Location: ../index_products.php");
?>