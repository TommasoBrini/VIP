<div class='auction winning'>
<header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($asta["Immagine"]);?>' alt='product photo'/>
    <div class='topright'>
        <button class='timer' id="<?php echo $asta["IDProdotto"]?>" onchange="timer(25, Dec, 2021, 23, 00)">02:32</button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button class='yellow'><?php echo number_format($asta["Prezzo"]);?> €</button>
    <button class='green second'>STAI VINCENDO</button>
    <button class='last1 grey unable'>RAISE</button><button class='last2 grey'>BUY NOW</button></div>