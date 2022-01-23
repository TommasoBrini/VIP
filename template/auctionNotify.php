<?php foreach($dbh->getBidsOfAuction($dbh->getAuctionFromProduct($prodotto['IDProdotto'])) as $bid): 
    $notificationNumber++;?>
    <tr class="border_bottom">
        <td id="data" class="cell_date"><?php echo date('m/d/Y H:i:s', $bid['TimeStamp']) ?></td>
        <td id="utente" class="cell_testo"><?php echo isset($_SESSION['email']) && $_SESSION['email'] == $bid['CodCliente'] ? "YOU" : preg_replace('/[^@]+@([^\s]+)/', '***@$1', $bid['CodCliente']) ?></td>
        <td id="testo" class="cell_date"><?php echo $bid['Notifica'] ?></td>
        <td id="puntata" class="cell_testo"><?php echo number_format($bid['quantita'], 0, ",", ".") ?></td>
    </tr>
<?php endforeach; ?>