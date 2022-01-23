<h1>CART</h1>
<table>
    <?php if($templateParams["orderExist"]==0): ?>
        <p class="noOrder">Go back to the products screen to fill in the cart!</p>
    <?php else: ?>
    <thead>
        <tr>
            <th id="selected"></th>
            <th id="photo">PHOTO</th>
            <th id="description">NAME</th>
            <th id="unitPrice">UNIT PRICE</th>
            <th id="quantity">QUANTITY</th>
            <th id="total">TOTAL</th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($templateParams["rows"] as $row): ?>
        <?php if($row["Disponibilita"]>=$row["Quantita"]): ?>
        <tr class="border_bottom">
        <td id= "selection" class="cell_selection"><input type='checkbox' id='selected<?php echo $row['IdRiga'] ?>' onclick="updateTotal()" /></td>
        <td id="photo" class="cell_photo"><img class="flex" src="<?php echo UPLOAD_DIR.$row["Immagine"];?>"/></td>
        <td id="name" class="cell_name"><?php echo $row["Nome"]?></td>
        <td id="unitPrice" class="cell_unitPrice"><?php echo $row["Prezzo"]?></td>
        <td id="quantity" class="cell_quantity"><input type='number' id='quantity<?php echo $row['IdRiga'] ?>' name='quantity' min=0 max='<?php echo $row["Disponibilita"]?>' value='<?php echo $row["Quantita"]?>' readonly />
        <img type='button' id='up<?php echo $row['IdRiga'] ?>' name='up' src="./img/up.png" />
        <img type='button' id='down<?php echo $row['IdRiga'] ?>' name='down' src="./img/down.png" /></td>
        <td id='total<?php echo $row['IdRiga'] ?>' class="cell_total"><?php echo $row["Quantita"] * $row["Prezzo"]?></td>
        <td id="trash"><img type="button" src="./img/trash.png" id="trash" onclick="window.location.href='deleteRow.php?id=<?php echo $row['IdRiga'] ?>'"/><br>
        </tr>
        <?php else: $dbh->insertNotify($_SESSION["email"],'The requested quantity of the product is no longer available!',NULL,NULL,NULL,$row["CodProdotto"]); ?>
        <?php endif; ?>
        <script type='text/javascript'>
            document.getElementById('up<?php echo $row['IdRiga'] ?>').onclick = function(event){ 
                max=<?php echo $row["Disponibilita"]?>;
                if( document.getElementById('quantity<?php echo $row['IdRiga'] ?>').value < max) {
                    if (!event) event = window.event;
                    event.stopPropagation(); 
                    document.getElementById('quantity<?php echo $row['IdRiga'] ?>').value = document.getElementById('quantity<?php echo $row['IdRiga'] ?>').valueAsNumber+1;
                    newPrice= document.getElementById('quantity<?php echo $row['IdRiga'] ?>').value * <?php echo $row["Prezzo"]?>;
                    total= '<?php echo '<td id="total'.$row["IdRiga"].'" class="cell_total">' ?>'+ newPrice +'<?php echo '</td>' ?>';
                    $('td#total<?php echo $row['IdRiga'] ?>').replaceWith(total);
                        $.ajax({
                            url: "<?php echo $templateParams['updateQuantity']?>?idRiga=" + <?php echo $row['IdRiga'] ?> + "&quantity=" + document.getElementById('quantity<?php echo $row['IdRiga'] ?>').value
                        }).done(function( msg ) {
                        });

                }
            }
            document.getElementById('down<?php echo $row['IdRiga'] ?>').onclick = function(event){  
                if( document.getElementById('quantity<?php echo $row['IdRiga'] ?>').value > 1) {
                    if (!event) event = window.event;
                    event.stopPropagation(); 
                    document.getElementById('quantity<?php echo $row['IdRiga'] ?>').value = document.getElementById('quantity<?php echo $row['IdRiga'] ?>').valueAsNumber-1;
                    newPrice= document.getElementById('quantity<?php echo $row['IdRiga'] ?>').value * <?php echo $row["Prezzo"]?>;
                    total= '<?php echo '<td id="total'.$row["IdRiga"].'" class="cell_total">' ?>'+ newPrice +'<?php echo '</td>' ?>';
                    $('td#total<?php echo $row['IdRiga'] ?>').replaceWith(total);
                        $.ajax({
                            url: "<?php echo $templateParams['updateQuantity']?>?idRiga=" + <?php echo $row['IdRiga'] ?> + "&quantity=" + document.getElementById('quantity<?php echo $row['IdRiga'] ?>').value
                        }).done(function( msg ) {
                        });
                    }   
                }

            function updateTotal() {
                var totalCart = 0;
                if ($("input[id^='selected']").filter(":checked").each(function() {
                    id = $(this).attr('id');
                    totalCart += parseFloat($('td#total'+ id.substr(8)).first().text());
                }));  
                $('td#totalCart').text(totalCart+'€');
            }
        </script>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"><button name="checkOut" id="checkOut">CHECK OUT</button></td>
            <td colspan="2">"Just for you" shipping is free</td>
            <td class="titleTotal">TOTAL</td>
            <td colspan="2" class="cell_totalCart" id='totalCart' onclick="checkOut()">0€</td>
            <script type='text/javascript'>
                function checkOut() {
                    var oldOrder = <?php echo $templateParams["firstUnpaidOrder"] ?>;
                    <?php $dbh->createNewOrder() ?>
                    var newOrder = <?php echo $templateParams["secondUnpaidOrder"] ?>;
                        if ($("input[id^='selected']").filter(":not(:checked)").each(function() {
                            id = $(this).attr('id');
                            $dbh->updateRow($newOrder, $id);
                        }));  
                    <?php foreach($templateParams["rows"] as $row): ?>
                        var availability = <?php echo $row['Disponibilita'] ?>;
                        var quantity = <?php echo $row["Quantita"] ?>;
                        var newAvailability = (availability-quantity);  
                        <?php $dbh->updateQuantityAvailableProduct($row['CodProdotto'], $newAvailability); ?>
                        <?php if($row["Disponibilita"]==0): $dbh->insertNotify($templateParams["emailSeller"],'The product is finished!',NULL,NULL,NULL,$row["CodProdotto"]); ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                        totalCart = parseFloat($document.getElementById( "totalCart"));
                        <?php 
                            $dbh->insertNotify($templateParams["emailSeller"],'Order executed!',NULL,NULL,$totalCart,NULL); 
                            mail($_SESSION['email'],"Order executed","The order has been executed!","From: ".$templateParams["emailSeller"]."\r\n"); 
                            $dbh->updateOrder($oldOrder);
                            header("Location: index_pagamento.php"); 
                        ?>
                }
            </script>
        </tr>
    </tfoot>
    <?php endif; ?>
</table>