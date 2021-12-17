<?php foreach($templateParams["products"] as $product): 
    if($product["Disponibilita"] == 0):?>
        <div class='product soldout'>
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
    <?php else: ?>
        <div class='product aviable'>
            <header>
                <label for="title"><?php echo $product["Nome"]?></label>
            </header>
            <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($product["Immagine"]);?>' alt='product photo'/>
            <div class='topright'>
                <textarea readonly class='description'><?php echo $product["DescrizioneBreve"];?></textarea>
            </div>
            <button class='yellow'><?php echo number_format($product["Prezzo"]);?> €</button>
            <button class='green'><?php echo "DISPONIBILITA': ".$product["Disponibilita"] ?></button>
            <button class='last grey'>ADD CART</button>
        </div>
    <?php endif;
endforeach; ?>