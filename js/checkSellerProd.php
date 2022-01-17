<script type="text/javascript">
    if(<?php echo (!isset($_SESSION['email']) || $dbh->checkSeller()) ? "true" : "false" ?>){
        if(!$("button#addCart<?php echo $product["IDProdotto"]?>").hasClass("unable")){
            $("button#addCart<?php echo $product["IDProdotto"]?>").addClass("unable");
        }
    }
</script>