<div class='auction losing'  onclick="<?php echo "window.location.href='index_single_product.php?id=".$asta["IDProdotto"]."&check=1'"; ?>">
    <header>
        <label for="title"><?php echo $asta["Nome"]?></label>
    </header>
    <img class='img' src="<?php echo UPLOAD_DIR.$asta["Immagine"];?>" alt='product photo'/>
    <div class='topright'>
        <button class='timer' id="timer<?php echo $asta["IDProdotto"]?>">00:00:00</button>
        <textarea readonly class='description'><?php echo $asta["DescrizioneBreve"];?></textarea>
    </div>
    <button class='yellow price'><?php echo number_format($asta["Base_asta"]);?> €</button>
    <button class='red second label'>PUOI RILANCIARE</button>
    <button class='last1 grey raise' id='raise<?php echo $asta["IDProdotto"]?>'>RAISE</button><button class='last2 grey' id='buyNow<?php echo $asta["IDProdotto"]?>'>BUY NOW</button>
    <script type="text/javascript">
        $( document ).ready(function(){
            timer(<?php echo $asta["AnnoInizio"].", '".getMounth($asta["MeseInizio"])."', ".$asta["GiornoInizio"].", '".$asta["OraInizio"]."', ".$asta["IDProdotto"]?>);
        });

        document.getElementById('buyNow<?php echo $asta["IDProdotto"]?>').onclick = function(event) {
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