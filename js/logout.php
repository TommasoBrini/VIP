<script>
    function logout(){
        $.ajax({
            url: "<?php echo $templateParams['doLogout']?>"
        }).done(function( msg ) {
            window.location.href = "index.php";
        });
    }
</script>