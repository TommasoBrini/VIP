<?php foreach($templateParams["rows"] as $row){
        $photo = getPhoto($row["CodProdotto"]);
        $name = getName($row["CodProdotto"]);
        $unitPrice = getUnitPrice($row["CodProdotto"]);
        $quantity = $row["Quantità"];
        $total = $quantity*$unitPrice;
?>