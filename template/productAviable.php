<div class='product aviable' id='product<?php echo $product["IDProdotto"]?>'>
    <header>
        <label for="title"><?php echo $product["Nome"];?></label>
    </header>
    <img class='img' src='data:image/jpeg;base64,<?php echo base64_encode($product["Immagine"]);?>' alt='product photo'/>
    <div class='topright'>
        <textarea readonly class='description'><?php echo $product["DescrizioneBreve"];?></textarea>
    </div>
    <button class='yellow'><?php echo number_format($product["Prezzo"]);?> €</button>
    <button class='green aviable' id='aviable<?php echo $product["IDProdotto"]?>' value='<?php echo $product["Disponibilita"] ?>'><?php echo "AVIABLE: ".$product["Disponibilita"] ?></button>
    <button class='last grey addCart' id='button<?php echo $product["IDProdotto"]?>' value='<?php echo $product["IDProdotto"]?>'>ADD CART</button>
    <script type="text/javascript">
        document.getElementById("button<?php echo $product["IDProdotto"]?>").onclick = function () {
            var select = "<select class='quantity' name='quantity' id='quantity<?php echo $product["IDProdotto"]?>'>";
            for(var i = 1; i <= <?php echo $product["Disponibilita"] ?>; i++){
                select = select + "<option value='"+ i +"'>"+ i +"</option>";
            }
            select = select + "</select>";
            $(this).prev().replaceWith(select);
            $(this).replaceWith("<button class='last1 grey addCart' id='addCart<?php echo $product["IDProdotto"]?>'>ADD CART</button><button class='last2 grey back' id='back<?php echo $product["IDProdotto"]?>'>BACK</button>");

            document.getElementById("addCart<?php echo $product["IDProdotto"]?>").onclick = function() {
                alert("Hai appena aggiunto " + document.getElementById("quantity<?php echo $product["IDProdotto"]?>").value + " <?php echo $product["Nome"];?> al carrello." );
                document.location.reload(true);
            }
            document.getElementById("back<?php echo $product["IDProdotto"]?>").onclick = function() {
                document.location.reload(true);
            }
        }
    </script>
</div>


