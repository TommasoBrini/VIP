<div class='auction winning'>
<header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src="<?php echo UPLOAD_DIR.$asta["Immagine"];?>" alt='product photo'/>
    <div class='topright'>
        <button class='timer' id="timer<?php echo $asta["IDProdotto"]?>">00:00:00</button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button class='yellow'><?php echo number_format($asta["Prezzo"]);?> €</button>
    <button class='green second'>STAI VINCENDO</button>
    <button class='last1 grey unable'>RAISE</button><button class='last2 grey'>BUY NOW</button>
    <script type="text/javascript">
        $( document ).ready(function(){
            timer(<?php echo $asta["AnnoInizio"].", '".getMounth($asta["MeseInizio"])."', ".$asta["GiornoInizio"].", '".$asta["OraInizio"]."', ".$asta["IDProdotto"]?>);
        });
    </script>
</div>