

/*------------------------------------------------------------------------------------
    
JS INDEX
=============

01 - Next Button
02 - Count

-------------------------------------------------------------------------------------*/
$(document).ready(function(){
   /* 
  =================================================================
  01 - Next Button 
  =================================================================	
  */


  $(".socialshow").click(function(){
     $(".socialshare, .overlayshare").show();
 })

 $(".socialbut").click(function(){
    $(".socialshare, .overlayshare").hide();
})

$(".overlayshare").click(function(){
    $(".socialshare, .overlayshare").hide();
})


});


