$(document).ready(function(){
    $("section:nth-child(3)").hide();

    $("#checkbox").click(function(e){
        if($("#checkbox").is(":checked")){
            $("section:nth-child(4)").hide();
            $("section:nth-child(3)").show();
        } else {
            $("section:nth-child(3)").hide();
            $("section:nth-child(4)").show();
        }
    });

    $("#immagine").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgshow').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

});