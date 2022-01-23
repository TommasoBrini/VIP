<script type="text/javascript">
    $( document ).ready(function(){
        setInterval(function() {   
            $.ajax({
                url: "<?php echo $templateParams['checkNotify']?>?id=<?php echo $dbh -> getAuctionFromProduct($id) ?>&n=<?php echo $notificationNumber ?>",
                success: function(data) {
                    if(data != 0){
                        window.location.reload(true);
                    }
                }
            });
        }, 100);
    });
</script>