<?php  
    $prodotto = $templateParams["prodotto"];
    $id = $prodotto["IDProdotto"];
    $check = $templateParams["check"];
?>

<form action='#' method='POST' enctype="multipart/form-data">
    <h1><?php echo strtoupper($prodotto["Nome"]);?></h1>
    <section>
        <ul>
            <li>
            <img src="<?php echo UPLOAD_DIR.$prodotto["Immagine"];?>" id="imgshow" alt="Prodotto"/>
            </li>
            <li>
                <?php if($check): ?>
                <button disabled><?php echo number_format($prodotto["Prezzo"], 0, ",", ".")." €"; ?> </button>
                <?php else: ?>
                <button disabled><?php echo number_format($prodotto["Base_asta"], 0, ",", ".")." €"; ?></button>
                <?php endif; ?>
            </li>            
            <li>
                <?php if($check): ?>
                <button disabled><?php echo "AVAIABLE: ".$prodotto["Disponibilita"]; ?> </button>
                <?php else: ?>
                <button type="button" onclick="window.location.href='index.php'">JOIN IN THE AUCTION!</button>
                <button id="timer<?php echo $prodotto['IDProdotto']?>">00:00:00</button>
                <?php endif; ?>
            </li>
            <li>
                <?php if($check): ?>
                <button type="button" onclick="window.location.href='index_cart.php'">ADD CART</button>
                <?php else: ?>
                <button type="button"><?php echo "BUY NOW: ".number_format($prodotto["Prezzo"], 0, ",", ".")." €"; ?></button>
                <?php endif; ?>
            </li>
        </ul>
        
    </section>
    <section>
        <h2>DESCRIPTION</h2>
        <textarea name="descrizione" id="descrizione" cols="30" rows="10" readonly><?php echo $prodotto["Descrizione"]; ?></textarea>
    

    <?php if(!$check): ?>
    <section>
    <table>
    <thead>
        <tr>
            <th id="data">DATE</th>
            <th id="utente">USER</th>
            <th id="testo">TEXT</th>
            <th id="puntata">BET</th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
     <!-- foreach per tutte le puntate -->
        <?php foreach($dbh->getBidsOfAuction($dbh->getAuctionFromProduct($prodotto['IDProdotto'])) as $bid): ?>
            <tr class="border_bottom">
                <td id="data" class="cell_date"><?php echo date('m/d/Y H:i:s', $bid['TimeStamp']) ?></td>
                <td id="utente" class="cell_testo"><?php echo isset($_SESSION['email']) && $_SESSION['email'] == $bid['CodCliente'] ? "YOU" : preg_replace('/[^@]+@([^\s]+)/', '***@$1', $bid['CodCliente']) ?></td>
                <td id="testo" class="cell_date"><?php echo $bid['Notifica'] ?></td>
                <td id="puntata" class="cell_testo"><?php echo number_format($bid['quantita'], 0, ",", ".") ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
    </section>
    
    <?php endif; ?>
    </section>

    <?php if(isset($templateParams["venditore"])): ?>
    <div>
        <button type="button" onclick="window.location.href='index_gestione_product.php?action=2&id=<?php echo $id?>'">UPDATE</button>
        <button type="button" onclick="window.location.href='index_gestione_product.php?action=3&id=<?php echo $id?>'">DELETE</button>
    </div>
        
    <?php endif; ?>

    <?php 
    if($prodotto['CodVincitore'] == NULL){
        $asta=$prodotto;
        require($templateParams["timer"]);
    }
    ?>
</form>
