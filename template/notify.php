<h1>NEWS</h1>
    <?php if(isset($templateParams["NoNews"])): ?>
        <p class="noOrder">You have no news to read. Keep shopping on our site, see you later!</p>
    <?php else: ?>
<table>
    <thead>
        <tr>
            <th id="date">DATE</th>
            <th id="testo">TEXT</th>
            <th id="ref"></th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($templateParams["notify"] as $news): ?>
        <tr class="border_bottom">
        <td id="date" class="cell_date"><?php echo date("Y-m-d", $news["TimeStamp"])?></td>
        <td id="testo" class="cell_testo"><?php echo $news["Text"]?></td>
        <td id="ref" classe="cell_ref"><?php if(!isset($news["IdOrdine"])){?>
                <a href="./index_single_product.php?id=<?php if(isset($news["IdAsta"])){
                        echo $news["IdAsta"];
                    } else {
                        echo $news["IDProdotto"];
                    }?>">PRODUCT INFO</a>
                <?php } else{ 
                    echo $news["TotaleOrdine"]."€";
                }
                ?>
        </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    <?php endif; ?>


