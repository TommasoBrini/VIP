<script type='text/javascript'>
        document.getElementById('addCart<?php echo $product["IDProdotto"]?>').onclick = function(event) {
            if (!event) event = window.event;
            event.stopPropagation();
            var select = "<form action='addCart.php?id=<?php echo $product["IDProdotto"]?>' method='POST' enctype='multipart/form-data'><select class='addCart' name='addCart' id='select<?php echo $product["IDProdotto"]?>' onclick='selectClick(event)'>";
            for(var i = 1; i <= <?php echo $product["Disponibilita"] ?>; i++){
                select = select + "<option value='"+ i +"'>"+ i +"</option>";
            }
            select = select + "</select><button class='last1 grey raise' type='submit'>RAISE</button><button class='last2 grey back' type='submit' formaction='backProduct.php'>BACK</button></form>";
            $(this).prev().replaceWith(select);
            $(this).next().replaceWith("");
            $(this).replaceWith("");
        }
</script>