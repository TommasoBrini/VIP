$(document).ready(function(){
    $("form > div > div > section:nth-child(3)").hide();
    $("form > div > div > section:nth-child(4)").hide();
    $("form > div > div > section:nth-child(5)").hide();

    $("#checkbox").click(function(e){
        if($("#checkbox").is(":checked")){
            $("form > div > div > section:nth-child(6)").hide();
            $("form > div > div > section:nth-child(3)").show();
            $("form > div > div > section:nth-child(4)").show();
            $("form > div > div > section:nth-child(5)").show();
        } else {
            $("form > div > div > section:nth-child(3)").hide();
            $("form > div > div > section:nth-child(4)").hide();
            $("form > div > div > section:nth-child(5)").hide();
            $("form > div > div > section:nth-child(6)").show();
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

    $("#insert").click(function() {
        
    })

});