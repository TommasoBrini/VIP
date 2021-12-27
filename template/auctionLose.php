<div class='auction lose'  onclick="<?php echo "window.location.href='index_single_product.php?id=".$asta["IDProdotto"]."'"; ?>">
    <header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($asta["Immagine"]);?>' alt='product photo'/>
    <div class='topright'>
        <button class='timer' id="timer<?php echo $asta["IDProdotto"]?>">00:00:00</button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button class='red price'><?php echo number_format($asta["Base_asta"]);?> €</button>
    <button class='red label'>HAI PERSO!</button>
    <button class='last red' onclick="<?php echo "window.location.href='index_single_product.php?id=".$asta["IDProdotto"]."'"; ?>">VEDI IL PRODOTTO</button>
    <script type="text/javascript">
        $( document ).ready(function(){
            var countDownDate = new Date("<?php echo "".getMounth($asta["MeseFine"])." ".$asta["GiornoFine"].", ".$asta["AnnoFine"]." ".$asta["OraFine"].":00:00"?>").getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();
                            
            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            var id = "<?php echo "timer".$asta["IDProdotto"] ?>";

            // Output the result in an element with id="demo"
            $("<?php echo "button#timer".$asta["IDProdotto"] ?>").replaceWith("<button class='timer' id='" +  id +"'>" + hours + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds < 10 ? "0" + seconds : seconds) + "</button>");
                                
                // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                $("<?php echo "button#timer".$asta["IDProdotto"] ?>").replaceWith("<button class='timer' id='" +  id +"'>00:00:00</button>");
            }
        }, 1000);
        });
    </script>
</div>