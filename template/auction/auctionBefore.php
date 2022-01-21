<div id='auction<?php echo $asta['IdAsta']?>' class='auction before'  onclick="<?php echo "window.location.href='index_single_product.php?id=".$asta["IDProdotto"]."'"; ?>">
    <header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src="<?php echo UPLOAD_DIR.$asta["Immagine"];?>" alt='product photo'/>
    <div class='topright'>
        <button class="timer" id="<?php echo "timer".$asta["IDProdotto"]?>">00:00:00</button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button class='grey'><?php echo number_format($asta["Base_asta"], 0, ",", ".");?> €</button>
    <button class='grey'>START SOON</button>
    <button class='last grey'>PRODUCT INFO</button>
    <?php require($templateParams['timer']);?>   
</div>