<div id='auction<?php echo $asta['IdAsta']?>' class='auction lose'  onclick="<?php echo "window.location.href='index_single_product.php?id=".$asta["IDProdotto"]."'"; ?>">
    <header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src="<?php echo UPLOAD_DIR.$asta["Immagine"];?>" alt='product photo'/>
    <div class='topright'>
        <button class='timer' id="timer<?php echo $asta["IDProdotto"]?>">00:00:00</button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button class='red'><?php echo $asta["quantita"] == NULL ? number_format($asta["Prezzo"]) : number_format($asta["quantita"]);?> €</button>
    <button class='red'>HAI PERSO!</button>
    <button class='last red'>VEDI IL PRODOTTO</button>
</div>