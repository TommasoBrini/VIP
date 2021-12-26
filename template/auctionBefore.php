<div class='auction before'>
    <header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($asta["Immagine"]);?>' alt='product photo'/>
    <div class='topright'>
        <button class="timer" id="<?php echo $asta["IDProdotto"]?>" onclick="timer(25, 'Dec', 2021, 20, 00)"></button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button class='grey'><?php echo number_format($asta["Prezzo"]);?> €</button>
    <button class='grey'>INIZIERA' A BREVE</button>
    <button class='last grey'>VEDI IL PRODOTTO</button>
</div>