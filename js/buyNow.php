<script type='text/javascript'>
        document.getElementById('buyNow<?php echo $asta["IDProdotto"]?>').onclick = function(event) {
            if (!event) event = window.event;
            event.stopPropagation();
            $(this).prev().prev().prev().replaceWith("<button id='<?php echo "price".$asta["IDProdotto"]?>' class='yellow price'><?php echo number_format($asta["Prezzo"]); ?> €</button>");
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
                $.ajax({
                    type: "POST",
                    url: "<?php echo $templateParams['confirmBuyNow']?>",
                    data: { idAsta: <?php echo $asta['IdAsta'] ?>, idProdotto: <?php echo $asta['IDProdotto'] ?>, nome: "<?php echo $asta['Nome'] ?>", prezzo: <?php echo $asta['Prezzo'] ?> }
                }).done(function( msg ) {
                    alert("Hai acquistato <?php echo $asta["Nome"]?> al prezzo di <?php echo number_format($asta["Prezzo"]); ?> €.");
                    document.location.reload(true);
                });
            }
        }
</script>