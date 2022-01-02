<div class='auction winning'  onclick="<?php echo "window.location.href='index_single_product.php?id=".$asta["IDProdotto"]."&check=1'"; ?>">
<header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src="<?php echo UPLOAD_DIR.$asta["Immagine"];?>" alt='product photo'/>
    <div class='topright'>
        <button class='timer' id="<?php echo "timer".$asta["IDProdotto"]?>">00:00:00</button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button class='yellow price'><?php echo number_format($asta["Base_asta"]);?> €</button>
    <button class='green second label'>STAI VINCENDO</button>
    <button class='last1 grey unable' id='raise<?php echo $asta["IDProdotto"]?>'>RAISE</button><button class='last2 grey' id='buyNow<?php echo $asta["IDProdotto"]?>'>BUY NOW</button>
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

        $( document ).ready(function(){
            timer(<?php echo $asta["AnnoInizio"].", '".getMounth($asta["MeseInizio"])."', ".$asta["GiornoInizio"].", '".$asta["OraInizio"]."', ".$asta["IDProdotto"]?>);
        });

        document.getElementById('buyNow<?php echo $asta["IDProdotto"]?>').onclick = function (event) {
            if (!event) event = window.event;
            event.stopPropagation();
            $(this).prev().prev().prev().replaceWith("<button class='yellow price'><?php echo number_format($asta["Prezzo"]); ?> €</button>");
            $(this).prev().prev().replaceWith("<button class='yellow label'>SICURO?</button>");
            $(this).prev().replaceWith("<button class='last1 grey' id='yes<?php echo $asta["IDProdotto"]?>'>YES</button>");
            $(this).replaceWith("<button class='last2 grey' id='no<?php echo $asta["IDProdotto"]?>'>NO</button>");

            document.getElementById("no<?php echo $asta["IDProdotto"]?>").onclick = function(event) {
                if (!event) event = window.event;
                event.stopPropagation();
                document.location.reload(true);
            }

            document.getElementById("yes<?php echo $asta["IDProdotto"]?>").onclick = function(event) {
                if (!event) event = window.event;
                event.stopPropagation();
                alert("Hai acquistato <?php echo $asta["Nome"]?> al prezzo di <?php echo number_format($asta["Prezzo"]); ?> €.");
                document.location.reload(true);
            }
        }

        document.getElementById('raise<?php echo $asta["IDProdotto"]?>').onclick = function(event) {
            if (!event) event = window.event;
            event.stopPropagation();
            $(this).prev().replaceWith("<select class='raise' name='raise' id='select<?php echo $asta["IDProdotto"]?>' onclick='selectClick(event)'><option value='5'>5</option><option value='10'>10</option><option value='50'>50</option><option value='100'>100</option></select>");
            $(this).next().replaceWith("<button class='last2 grey back' id='back<?php echo $asta["IDProdotto"]?>'>BACK</button>");
            $(this).replaceWith("<button class='last1 grey raise' id='raise<?php echo $asta["IDProdotto"]?>'>RAISE</button>");

            document.getElementById('back<?php echo $asta["IDProdotto"]?>').onclick = function(event) {
                if (!event) event = window.event;
                event.stopPropagation();
                document.location.reload(true);
            }
                
            document.getElementById('raise<?php echo $asta["IDProdotto"]?>').onclick = function(event) {
                if (!event) event = window.event;
                event.stopPropagation();
                alert("Hai rilanciato " + document.getElementById("select<?php echo $asta["IDProdotto"]?>").value + " € per <?php echo $asta["Nome"];?>");
                document.location.reload(true);
            }
        }
    </script>
</div>