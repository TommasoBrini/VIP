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
            var select = "<select class='quantity' name='quantity' id='quantity'>";
            for(var i = 1; i <= <?php echo $product["Disponibilita"] ?>; i++){
                select = select + "<option value='"+ i +"'>"+ i +"</option>";
            }
            select = select + "</select>";
            $(this).prev().replaceWith(select);
            $(this).replaceWith("<button class='last1 grey addCart'>ADD CART</button><button class='last2 grey back'>BACK</button>");
        }
    </script>
</div>


