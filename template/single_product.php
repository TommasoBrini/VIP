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
            <img src="<?php echo UPLOAD_DIR.$prodotto["Immagine"];?>" id="imgshow" alt="prodotto"/>
            </li>
            <li>
                <?php if($check): ?>
                <button disabled><?php echo number_format($prodotto["Prezzo"])."€"; ?> </button>
                <?php else: ?>
                <button disabled><?php echo number_format($prodotto["Base_asta"])."€"; ?></button>
                <?php endif; ?>
            </li>            
            <li>
                <?php if($check): ?>
                <button disabled><?php echo "AVAIABLE: ".$prodotto["Disponibilita"]; ?> </button>
                <?php else: ?>
                <button type="button" onclick="window.location.href='index.php'">PARTECIPA ALL'ASTA!</button>
                <button id="timer<?php echo $prodotto['IDProdotto']?>">00:00:00</button>
                <?php endif; ?>
            </li>
            <li>
                <?php if($check): ?>
                <button type="button" onclick="window.location.href='index_cart.php'">AGGIUNGI AL CARRELLO</button>
                <?php else: ?>
                <button type="button"><?php echo "BUY NOW: ".number_format($prodotto["Prezzo"]); ?></button>
                <?php endif; ?>
            </li>
        </ul>
        
    </section>
    <section>
        <h2>DESCRIZIONE</h2>
        <textarea name="descrizione" id="descrizione" cols="30" rows="10" readonly><?php echo $prodotto["Descrizione"]; ?></textarea>
    

    <?php if(!$check): ?>
    <section>
    <table>
    <thead>
        <tr>
            <th id="data">DATA</th>
            <th id="utente">UTENTE</th>
            <th id="testo">TESTO</th>
            <th id="puntata">PUNTATA</th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
     <!-- foreach per tutte le puntate -->
        <tr class="border_bottom">
            <td id="data" class="cell_date">PROVA</td>
            <td id="utente" class="cell_testo">PROVA</td>
            <td id="testo" class="cell_date">PROVA</td>
            <td id="puntata" class="cell_testo">PROVA</td>
        </tr>
    </tbody>
    </table>
    </section>
    
    <?php endif; ?>
    </section>

    <?php if(isset($templateParams["venditore"])): ?>
    <div>
        <button type="button" onclick="window.location.href='index_gestione_product.php?action=2&id=<?php echo $id?>'">Modifica</button>
        <button type="button" onclick="window.location.href='index_gestione_product.php?action=3&id=<?php echo $id?>'">Elimina</button>
    </div>
        
    <?php endif; ?>

    <?php 
    $asta=$prodotto;
    require($templateParams["timer"]);
    ?>
</form>
