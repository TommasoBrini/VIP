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
        <tr class="border_bottom">
        <td id="selected" class="cell_selected"><input type='checkbox' id='selected'></td>
        <td id="photo" class="cell_photo"><img class="flex" src="<?php echo UPLOAD_DIR.$row["Immagine"];?>"/></td>
        <td id="name" class="cell_name"><?php echo $row["Nome"]?></td>
        <td id="unitPrice" class="cell_unitPrice"><?php echo $row["Prezzo"]?></td>
        <td id="quantity" class="cell_quantity"><input type='number' id='quantity' name='quantity' min=1 max='<?php echo $row["Disponibilita"]?>' value='<?php echo $row["Quantita"]?>'></td>
        <td id="total" class="cell_total"><?php echo $row["Quantita"] * $row["Prezzo"]?></td>
        <td id="trash"><img type="button" src="./img/trash.png" id="trash" onclick="window.location.href='deleteRow.php?id=<?php echo $row['IdRiga'] ?>'"/><br>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"><button name="checkOut" id="checkOut">CHECK OUT</button></td>
            <td colspan="2">"Just for you" shipping is free</td>
            <td>TOTAL</td>
            <td colspan="2">Funzione in js per calcolo totale, solo selezionate</td>
        </tr>
    </tfoot>
    <?php endif; ?>
</table>
