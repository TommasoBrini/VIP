<div class='auction lose'>
    <header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($asta["Immagine"]);?>' alt='product photo'/>
    <div class='topright'>
        <button class='timer' id="<?php echo $asta["IDProdotto"]?>" onchange="timer(25, Dec, 2021, 22, 00)"></button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button class='red'><?php echo number_format($asta["Prezzo"]);?> €</button>
    <button class='red'>HAI PERSO!</button>
    <button class='last red'>VEDI IL PRODOTTO</button>
</div>