<h1>CART</h1>
<table>
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
    <?php foreach($templateParams["rows"] as $row){
        $photo = getPhoto($row["CodProdotto"]);
        $name = getName($row["CodProdotto"]);
        $unitPrice = getUnitPrice($row["CodProdotto"]);
        $quantity = $row["Quantità"];
        $total = $quantity*$unitPrice;
        <tr class="border_bottom">
            <td id="selected" class="cell_selected"><input type='checkbox' id='selected'></td>
            <td id="photo" class="cell_photo"><img class="flex" src="./img/occhiali.jpg"></td>
            <td id="name" class="cell_name">Name</td>
            <td id="unitPrice" class="cell_unitPrice">30€</td>
            <td id="quantity" class="cell_quantity"><input type='number' id='quantity' name='quantity'></td>
            <td id="total" class="cell_total">€</td>
            <td id="trash"><img type="button" src="./img/trash.png" id="trash" /><br>
        </tr>
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"><button name="checkOut" id="checkOut">CHECK OUT</button></td>
            <td colspan="2">"Just for you" shipping is free</td>
            <td>TOTAL</td>
            <td colspan="2">300000€</td>
        </tr>
    </tfoot>
</table>