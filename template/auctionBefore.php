<div class='auction before'  onclick="<?php echo "window.location.href='index_single_product.php?id=".$asta["IDProdotto"]."&check=1'"; ?>">
    <header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src="<?php echo UPLOAD_DIR.$asta["Immagine"];?>" alt='product photo'/>
    <div class='topright'>
        <button class="timer" id="<?php echo "timer".$asta["IDProdotto"]?>">00:00:00</button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button class='grey'><?php echo number_format($asta["Base_asta"]);?> €</button>
    <button class='grey'>INIZIERA' A BREVE</button>
    <button class='last grey'>VEDI IL PRODOTTO</button>
    <script type='text/javascript'>

        var startDate = new Date("<?php echo getMounth($asta["MeseInizio"])." ".$asta["GiornoInizio"].", ".$asta["AnnoInizio"]." ".$asta["OraInizio"].":00" ?>").getTime();
        
        var endDate = new Date("<?php echo getMounth($asta["MeseFine"])." ".$asta["GiornoFine"].", ".$asta["AnnoFine"]." ".$asta["OraFine"].":00" ?>").getTime();
        
        var startDistance = startDate - new Date().getTime();
        var endDistance = endDate - new Date().getTime();

        if(endDistance <= 0){
            $("<?php echo "button#timer".$asta["IDProdotto"] ?>").replaceWith("<?php echo "<button class='timer' id='timer".$asta["IDProdotto"] ?>'>00:00:00</button>");
        } else {
            // Update the count down every 1 second
            var x = setInterval(function() {                             
                // Find the distance between now and the count down date

                now = new Date().getTime();
                var distance;
                if(startDistance <=0){
                    distance = endDate - now;
                } else {
                    distance = startDate - now;
                }
                // Time calculations for hours, minutes and seconds
                var hours = Math.floor(distance / (1000 * 60 * 60));
                var minutes = Math.floor((distance / (1000 * 60 * 60) - hours) * 60);
                var seconds = Math.floor((((distance / (1000 * 60 * 60) - hours) * 60) - minutes) * 60);

                hours < 10 ? hours = '0'+hours : hours = hours;
                minutes < 10 ? minutes = '0'+minutes : minutes = minutes;
                seconds < 10 ? seconds = '0'+seconds : seconds = seconds;
                // Output the result in an element with id="demo"
                $("<?php echo "button#timer".$asta["IDProdotto"] ?>").replaceWith("<?php echo "<button class='timer' id='timer".$asta["IDProdotto"]."'>" ?>" + hours + ":" + minutes + ":" + seconds + "</button>");  

                // If the count down is over, write some text
                if (distance <= 0) {
                    clearInterval(x);
                    document.location.reload(true);
                }
            }, 1000);
        }
</script>
</div>