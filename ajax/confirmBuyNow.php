
<?php
    require "../bootstrap.php";
    $idAsta = $_POST['idAsta'];
    $idProdotto = $_POST['idProdotto'];
    $nome = $_POST['nome'];
    $prezzo = $_POST['prezzo'];
    $dbh->buyNow($idAsta, $_SESSION['email']);
    $dbh->insertNotify($_SESSION['email'], buyNowMessage($nome, $prezzo), $idProdotto, NULL, NULL, NULL);
?>