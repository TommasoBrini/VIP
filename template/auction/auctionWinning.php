<div id='auction<?php echo $asta['IdAsta']?>' class='auction winning'  onclick="<?php echo "window.location.href='index_single_product.php?id=".$asta["IDProdotto"]."'"; ?>">
<header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src="<?php echo UPLOAD_DIR.$asta["Immagine"];?>" alt='product photo'/>
    <div class='topright'>
        <button class='timer' id="<?php echo "timer".$asta["IDProdotto"]?>">00:00:00</button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button id="price<?php echo $asta["IDProdotto"]?>" class='yellow price' value='<?php echo $asta["quantita"] == NULL ? $asta["Base_asta"]."'>".number_format($asta["Base_asta"], 0, ",", ".") : $asta["quantita"]."'>".number_format($asta["quantita"], 0, ",", ".");?> €</button>
    <button id="label<?php echo $asta["IDProdotto"]?>" class='green second label'>WINNING</button>
    <button id="raise<?php echo $asta["IDProdotto"]?>" class='last1 grey unable'>RAISE</button><button id="buyNow<?php echo $asta["IDProdotto"]?>" class='last2 grey'>BUY NOW</button>
    <?php require($templateParams['timer']);?>
    <?php require($templateParams['raise']);?>
    <?php require($templateParams['buyNow']);?>
    <?php require($templateParams['checkUpdate']);?>
    <?php require($templateParams['checkSeller']);?>
</div>