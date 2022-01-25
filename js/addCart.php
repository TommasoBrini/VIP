<script type='text/javascript'>
        document.getElementById('addCart<?php echo $product["IDProdotto"]?>').onclick = function(event) {
            if (!event) event = window.event;
            event.stopPropagation();
            var select = "<form action='<?php echo $templateParams['confirmAddCart']?>?id=<?php echo $product["IDProdotto"]?>' method='POST' enctype='multipart/form-data'><select class='addCart' name='addCart' id='select<?php echo $product["IDProdotto"]?>' onclick='selectClick(event)'>";
            for(var i = 1; i <= <?php echo $product["Disponibilita"] ?>; i++){
                select = select + "<option value='"+ i +"'>"+ i +"</option>";
            }
            select = select + "</select><button class='last1 grey raise' type='submit'>ADD CART</button><button class='last2 grey back' type='submit' formaction='<?php echo $templateParams['back'].($templateParams['slider']?"":"?id=".$product["IDProdotto"])?>'>BACK</button></form>";
            $(this).prev().replaceWith("");
            $(this).next().replaceWith("");
            $(this).replaceWith(select);
        }
</script>