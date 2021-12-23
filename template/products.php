<?php $div = 0;
    foreach($templateParams["products"] as $product):
        if($product["Disponibilita"] == 0): $div++?>
            <div class='product soldout' id='soldOut'>
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
    <?php else: 
        $aviable++;?>
        <div class='product aviable' id='aviable<?php echo $aviable?>'>
            <header>
                <label for="title"><?php echo $product["Nome"];?></label>
            </header>
            <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($product["Immagine"]);?>' alt='product photo'/>
            <div class='topright'>
                <textarea readonly class='description'><?php echo $product["DescrizioneBreve"];?></textarea>
            </div>
            <button class='yellow'><?php echo number_format($product["Prezzo"]);?> €</button>
            <button class='green aviable' value='<?php echo $product["Disponibilita"] ?>'><?php echo "AVIABLE: ".$product["Disponibilita"] ?></button>
            <button value='<?php echo $product["IDProdotto"]?>' class='last grey addCart'>ADD CART</button>
        </div>
    <?php endif;
endforeach; ?>