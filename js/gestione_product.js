$(document).ready(function(){
    if($("#checkbox").is(":checked")){
        $("form > ul > li:nth-child(5)").hide();
    } else{
        $("form > ul > li:nth-child(3)").hide();
        $("form > ul > li:nth-child(4)").hide();
    }

    $("#checkbox").click(function(e){
        if($("#checkbox").is(":checked")){
            $("form > ul > li:nth-child(5)").hide();
            $("form > ul > li:nth-child(3)").show();
            $("form > ul > li:nth-child(4)").show();
        } else {
            $("form > ul > li:nth-child(5)").show();
            $("form > ul > li:nth-child(3)").hide();
            $("form > ul > li:nth-child(4)").hide();
        }
    });

    $("#Immagine").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgshow').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    if($("input[type=hidden]").val() == 3){
        $("input[type!=submit]").attr("disabled", true);
        $("input[type=hidden]").attr("disabled", false);
        $("textarea").attr("disabled", true);
    }

});