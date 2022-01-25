<?php
require "../bootstrap.php";

    $idOrdine = $_POST['idOrdine'];
    $prodottiOut = $_POST['idProdottiOut'];
    $prodottiIn = $_POST['idProdottiIn'];
    $email = $_POST['email'];
    $emailSeller = $dbh->getSeller();
    if (count($prodottiIn) > 1){
        $somma = $dbh->checkOut($idOrdine, $prodottiOut, $prodottiIn);
        $productsIn = array();
        foreach($prodottiIn as $product){
            if($product != 0){
                $prod['nome'] = $dbh->getProductName($product);
                $prod['quantita'] = $dbh->getQuantityOfOrder($product);
                array_push($productsIn, $prod);
            }
        }
        $dbh->insertNotify($email, orderCompleted($productsIn, $idOrdine), NULL, $idOrdine, $somma , NULL);
        $dbh->insertNotify($emailSeller, orderCarriedOut($productsIn, $idOrdine),NULL, $idOrdine, $somma, NULL);
        echo json_encode(1);
    } else {
        echo json_encode(0);

    }
?>