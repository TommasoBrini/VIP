<script type='text/javascript'>
        document.getElementById('raise<?php echo $asta["IDProdotto"]?>').onclick = function(event) {
            if (!event) event = window.event;
            event.stopPropagation();
            var actual = document.getElementById("price<?php echo $asta["IDProdotto"]?>").value;
            $(this).prev().replaceWith("<form action='raise.php?id=<?php echo $asta["IdAsta"]?>&base=" + actual +"' method='POST' enctype='multipart/form-data'><select class='raise' name='raise' id='select<?php echo $asta["IDProdotto"]?>' onclick='selectClick(event)'><option value='5'>5</option><option value='10'>10</option><option value='50'>50</option><option value='100'>100</option></select><button class='last1 grey raise' type='submit'>RAISE</button><button class='last2 grey back' type='submit' formaction='back.php'>BACK</button></form>");
            $(this).next().replaceWith("");
            $(this).replaceWith("");
        }

</script>