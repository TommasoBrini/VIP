<?php
require "../bootstrap.php";

    $idOrdine = $_POST['idOrdine'];
    $prodottiOut = $_POST['idProdottiOut'];
    $prodottiIn = $_POST['idProdottiIn'];
    $email = $_POST['email'];
    $emailSeller = $dbh->getSeller();
    if (count($prodottiIn) > 1){
        $somma = $dbh->checkOut($idOrdine, $prodottiOut, $prodottiIn);
        $dbh->insertNotify($email, "The order has been successfully!", NULL, $idOrdine, $somma , NULL);
        $dbh->insertNotify($emailSeller, "è stato eff un'ordine",NULL, $idOrdine, $somma, NULL);
        header("Location: ../index_pagamento.php");
    } else {
        header("Location: ../index_cart.php");
    }
?>