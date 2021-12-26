<script>
    function timer(day, month, year, hour, minute, id){
        var countDownDate = new Date(month + " " + day + ", " + year + " " + hour + ":" + minute + ":" + ":00").getTime();

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

            // Output the result in an element with id="demo"
            $("button#" + id).replaceWith("<button class='timer' id='" +  id +"'>" + hours + ":" + minutes + ":" + seconds + "</button>");
                                
                // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                $("button#" + id).replaceWith("00:00:00");
            }
        }, 1000);
    }
</script>

<?php foreach($templateParams["auctions"] as $asta): 
    switch($asta["Stato"]):
        case "BEFORE":?>
            <div class='auction before'>
                <header>
                    <label for="title"><?php echo $asta["Nome"]?></label>
                </header>
                <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($asta["Immagine"]);?>' alt='product photo'/>
                <div class='topright'>
                    <button class="timer" id="<?php echo $asta["IDProdotto"]?>" onclick="timer(25, 'Dec', 2021, 20, 00)"></button>
                    <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
                </div>
                <button class='grey'><?php echo number_format($asta["Prezzo"]);?> €</button>
                <button class='grey'>INIZIERA' A BREVE</button>
                <button class='last grey'>VEDI IL PRODOTTO</button>
            </div>
            <?php
            break; 
        
        case "FINITA":
            if($asta["OraFine"] == 20):?>
            <div class='auction win'>
                <header>
                    <label for="title"><?php echo $asta["Nome"]?></label>
                </header>
                <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($asta["Immagine"]);?>' alt='product photo'/>
                <div class='topright'>
                    <button class='timer' id="<?php echo $asta["IDProdotto"]?>" onchange="timer(25, Dec, 2021, 21, 00)"></button>
                    <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
                </div>
                <button class='green'><?php echo number_format($asta["Prezzo"]);?> €</button>
                <button class='green'>HAI VINTO!</button>
                <button class='last green'>VEDI IL PRODOTTO</button>
            </div>
            <?php
            else:
            ?>
                <div class='auction lose'>
                    <header>
                        <label for="title"><?php echo $asta["Nome"]?></label>
                    </header>
                    <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($asta["Immagine"]);?>' alt='product photo'/>
                    <div class='topright'>
                        <button class='timer' id="<?php echo $asta["IDProdotto"]?>" onchange="timer(25, Dec, 2021, 22, 00)"></button>
                        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
                    </div>
                    <button class='red'><?php echo number_format($asta["Prezzo"]);?> €</button>
                    <button class='red'>HAI PERSO!</button>
                    <button class='last red'>VEDI IL PRODOTTO</button>
                </div>
            <?php
            endif;
            break;
        case "INIZIATA":?>
            <div class='auction losing'>
                <header>
                    <label for="title"><?php echo $asta["Nome"]?></label>
                </header>
                <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($asta["Immagine"]);?>' alt='product photo'/>
                <div class='topright'>
                    <button class='timer' id="<?php echo $asta["IDProdotto"]?>" onchange="timer(25, Dec, 2021, 23, 00)">02:32</button>
                    <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
                </div>
                <button class='yellow'><?php echo number_format($asta["Prezzo"]);?> €</button>
                <button class='red second'>PUOI RILANCIARE</button>
                <button class='last1 grey raise'>RAISE</button><button class='last2 grey'>BUY NOW</button>
            </div>
            <?php
            break;
        default:
            break;?>
    <?php endswitch;
endforeach; ?>

