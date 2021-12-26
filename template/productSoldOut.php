<div class='product soldout' id='product<?php echo $product["IDProdotto"]?>'>
    <header>
        <label for="title"><?php echo $product["Nome"]?></label>
    </header>
    <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($product["Immagine"]);?>' alt='product photo'/>
    <div class='topright'>
        <textarea readonly class='description'><?php echo $product["DescrizioneBreve"];?></textarea>
    </div>
    <button class='red'><?php echo number_format($product["Prezzo"]);?> €</button>
    <button class='red'>SOLD OUT</button>
    <button class='last red'>NOTIFY ME</button>
</div>