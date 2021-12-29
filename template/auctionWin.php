<div class='auction win'>
    <header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src="<?php echo UPLOAD_DIR.$asta["Immagine"];?>" alt='product photo'/>
    <div class='topright'>
    <button class='timer' id="timer<?php echo $asta["IDProdotto"]?>">00:00:00</button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button class='green'><?php echo number_format($asta["Prezzo"]);?> €</button>
    <button class='green'>HAI VINTO!</button>
    <button class='last green'>VEDI IL PRODOTTO</button>
</div>