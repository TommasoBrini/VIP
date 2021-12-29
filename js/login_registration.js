$(document).ready(function(){
  
    $('#showHidePwd').on('click', function(){
       var passInput=$("#pwd");
       if(passInput.attr('type')==='password')
       {
           passInput.attr('type','text');
       } else {
          passInput.attr('type','password');
       }
   })
 })

