<script type="text/javascript">
    $( document ).ready(function(){
        var actual = document.getElementById("quantity<?php echo $row["IdRiga"]?>").value;
        var idRiga = <?php echo $row['IdRiga']?>;
        if ($dbh->$checkQuantity($idRiga)!=$actual) {
            $dbh->$updateQuantity($actual, $idRiga);
            document.location.reload(true);
        }
    });
</script>