<?php  
    $prodotto = $templateParams["prodotto"];
    $id = $prodotto["IDProdotto"];
    $check = $templateParams["check"];
?>

<form action='#' method='POST' enctype="multipart/form-data">
    <h1><?php echo strtoupper($prodotto["Nome"]);?></h1>
    <section id="immagine">
        <ul>
            <li>
            <img src="<?php echo UPLOAD_DIR.$prodotto["Immagine"];?>" id="imgshow" alt="Prodotto"/>
            </li>
            <li>
                <?php if($check): ?>
                <button disabled><?php echo number_format($prodotto["Prezzo"], 0, ",", ".")." €"; ?> </button>
                <?php else: ?>
                <button id="price" disabled>BASE PRICE: <?php echo number_format($prodotto["Base_asta"], 0, ",", ".")." €"; ?></button>
                <?php endif; ?>
            </li>            
            <li>
                <?php if($check): ?>
                <button disabled><?php echo "AVAIABLE: ".$prodotto["Disponibilita"]; ?> </button>
                <?php else: ?>
                <button disabled><?php echo "PRICE BUY NOW: ".number_format($prodotto["Prezzo"], 0, ",", ".")." €"; ?></button>
                <button type="button" onclick="window.location.href='index.php'">JOIN IN THE AUCTION!</button>
                <?php endif; ?>
            </li>
            <li>
                <?php if($check): ?>
                <button type="button" id="addCart<?php echo $prodotto['IDProdotto']?>" <?php if(isset($templateParams["venditore"]) || !isset($templateParams["loggato"])) {
                    echo "disabled"; 
                } ?> >ADD CART</button>
                <?php else: ?>
                <button id="timer<?php echo $prodotto['IDProdotto']?>">00:00:00</button>
                <?php endif; ?>
            </li>
        </ul>
        
    </section>
    <section id="descrizione">
        <h2>DESCRIPTION</h2>
        <textarea name="descrizione" id="desc" cols="30" rows="10" readonly><?php echo $prodotto["Descrizione"]; ?></textarea>
    

    <?php if(!$check): ?>
    <section>
        <div id='table'>
    <table id="tab">
    <thead>
        <tr>
            <th id="data">DATE</th>
            <th id="utente">USER</th>
            <th id="testo">TEXT</th>
            <th id="puntata">BET</th>
            <th> </th>
        </tr>
    </thead>
    <tbody id="notify">
        <?php $notificationNumber = 0; 
        require($templateParams["notify"]);
        if($notificationNumber == 0): ?>
            <tr class="border_bottom">
                <td colspan=4 style="border: 5px solid #707070">No bet has been made yet.</td>
            </tr>
        <?php endif;?>

    </tbody>
    </table>
    </div>
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
    if($check){
        $product = $prodotto;
        require($templateParams['addCart']);
    } else {
        if($prodotto['CodVincitore'] == NULL){
            $asta=$prodotto;
            require($templateParams["timer"]);
        }
        require($templateParams['loadNotify']);
    }
    ?>
</form>