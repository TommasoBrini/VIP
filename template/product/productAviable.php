<div class='product aviable' id='product<?php echo $product["IDProdotto"]?>' onclick="<?php echo "window.location.href='index_single_product.php?id=".$product["IDProdotto"]."'"; ?>">
    <header>
        <label><?php echo $product["Nome"];?></label>
    </header>
    <img class='img' src="<?php echo UPLOAD_DIR.$product["Immagine"];?>" alt='product photo'/>
    <div class='topright'>
        <textarea readonly class='description'><?php echo $product["DescrizioneBreve"];?></textarea>
    </div>
    <button class='yellow'><?php echo number_format($product["Prezzo"]);?> €</button>
    <button class='green aviable' id='aviable<?php echo $product["IDProdotto"]?>' value='<?php echo $product["Disponibilita"] ?>'><?php echo "AVIABLE: ".$product["Disponibilita"] ?></button>
    <button class='last grey addCart' id='addCart<?php echo $product["IDProdotto"]?>' value='<?php echo $product["IDProdotto"]?>'>ADD CART</button>
    <?php require($templateParams['addCart']);?>
    <?php require($templateParams['checkSeller']);?>
</div>


