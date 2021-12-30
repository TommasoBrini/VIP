<div class='auction before'  onclick="<?php echo "window.location.href='index_single_product.php?id=".$asta["IDProdotto"]."&check=1'"; ?>">
    <header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src="<?php echo UPLOAD_DIR.$asta["Immagine"];?>" alt='product photo'/>
    <div class='topright'>
        <button class="timer" id="timer<?php echo $asta["IDProdotto"]?>">00:00:00</button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button class='grey'><?php echo number_format($asta["Base_asta"]);?> €</button>
    <button class='grey'>INIZIERA' A BREVE</button>
    <button class='last grey'>VEDI IL PRODOTTO</button>
    <?php require("template/timer.php") ?>
</div>