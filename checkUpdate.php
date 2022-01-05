<script type="text/javascript">
    $( document ).ready(function(){
        var actual = <?php echo $asta["quantita"] == NULL ? $asta["Base_asta"] : $asta["quantita"]; ?>;
        var id = <?php echo $asta['IdAsta']?>;
        setInterval(function() {   
            $.ajax({
                url: "update.php?id=" + id + "&old=" + actual,
                success: function(data) {
                    if(data != -1) {
                        $("<?php echo "button#price".$asta["IDProdotto"]?>").replaceWith("<button id='<?php echo "price".$asta["IDProdotto"]?>' class='yellow price'>" + data  + " €</button>");
                    }
                }
            });
        }, 100);
    });
</script>