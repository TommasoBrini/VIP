<script type="text/javascript">
    if(<?php echo !isset($_SESSION['email']) || $dbh->checkSeller()?>){
        if(!$("button#raise<?php echo $asta["IDProdotto"]?>").hasClass("unable")){
            $("button#raise<?php echo $asta["IDProdotto"]?>").addClass("unable");
        }
        if(!$("button#buyNow<?php echo $asta["IDProdotto"]?>").hasClass("unable")){
            $("button#buyNow<?php echo $asta["IDProdotto"]?>").addClass("unable");
        }
    }
</script>