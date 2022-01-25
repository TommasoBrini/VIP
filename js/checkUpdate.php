<script>
    $( document ).ready(function(){
        var actual = document.getElementById("price<?php echo $asta["IDProdotto"]?>").value;
        var id = <?php echo $asta['IdAsta']?>;
        setInterval(function() {   
            $.ajax({
                url: "<?php echo $templateParams['update']?>?id=" + id + "&old=" + actual,
                success: function(data) {
                    if(data == 0){
                        document.location.reload(true);
                    } else if(data != -1) {
                        $("button#price<?php echo $asta["IDProdotto"]?>").replaceWith("<button id='<?php echo "price".$asta["IDProdotto"]?>' class='yellow price' value='" + data + "'>" + new Intl.NumberFormat("de-DE", {minimumFractionDigits: 0}).format(data) + " €</button>");
                        $("button#label<?php echo $asta["IDProdotto"]?>").replaceWith("<button id='label<?php echo $asta["IDProdotto"]?>' class='red second label'>PUOI RILANCIARE</button>");
                        if($("button#raise<?php echo $asta["IDProdotto"]?>").hasClass("unable") && <?php echo $dbh->checkSeller($_SESSION['email']) ? "false" : "true"?>){
                            $("button#raise<?php echo $asta["IDProdotto"]?>").removeClass("unable");
                            $("button#raise<?php echo $asta["IDProdotto"]?>").addClass("raise");
                        }
                    }
                }
            });
        }, 100);
    });
</script>