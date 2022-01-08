<script type="text/javascript">
    $( document ).ready(function(){
        var actual = document.getElementById("price<?php echo $asta["IDProdotto"]?>").value;
        var id = <?php echo $asta['IdAsta']?>;
        setInterval(function() {   
            $.ajax({
                url: "update.php?id=" + id + "&old=" + actual,
                success: function(data) {
                    if(data == 0){
                        document.location.reload(true);
                    } else if(data != -1) {
                        $("button#price<?php echo $asta["IDProdotto"]?>").replaceWith("<button id='<?php echo "price".$asta["IDProdotto"]?>' class='yellow price' value='" + data + "'>" + Number(data).toLocaleString("es-ES", {minimumFractionDigits: 0}) + " €</button>");
                        $("button#label<?php echo $asta["IDProdotto"]?>").replaceWith("<button id='label<?php echo "price".$asta["IDProdotto"]?>' class='red second label'>PUOI RILANCIARE</button>");
                        if($("button#raise<?php echo $asta["IDProdotto"]?>").hasClass("unable")){
                            $("button#raise<?php echo $asta["IDProdotto"]?>").removeClass("unable");
                            $("button#raise<?php echo $asta["IDProdotto"]?>").addClass("raise");
                        }
                    }
                }
            });
        }, 100);
    });
</script>