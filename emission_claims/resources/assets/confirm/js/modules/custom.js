
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


  $(".r1").click(function(){
    progressUp();
     $(".slide1").hide();
     $(".slide2").show();
 })
 
 
 $(".r2").click(function(){
    progressUp();
    $(".slide2").hide();
    $(".slide3").show();
})

$(".r3").click(function(){
    progressUp();
    $(".slide3").hide();
    $(".slide4").show();
})

$(".r4").click(function(){
    progressUp();
    $(".slide4").hide();
    $(".slide5").show();
})

$(".r5").click(function(){
    progressUp();
    $(".slide5").hide();
    $(".slide6").show();
})

$(".r6").click(function(){
    progressUp();
    $(".slide6, .slideno").hide();
    $(".slide7").show();
})


$(".slide8").click(function(){
    progressUp();
    $(".slide7, .slideno").hide();
    $(".slide8").show();
})

$(".slide9").click(function(){
    progressUp();
    $(".slide8").hide();
    $(".slide9").show();
})


$("#findad").click(function(){
    $("#addressdiv").show();
})

$("#address").click(function(){
    $("#viewadrs").show();
})

$(".persbut1").click(function(){
    progressUp();
    $(".pers1, .slideno").hide();
    $(".pers2").show();
})






/* 
=================================================================
02 - Count
=================================================================	
*/


$('.Count').each(function () {
var $this = $(this);
jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
  duration: 10000,
  easing: 'swing',
  step: function () {
    $this.text(Math.ceil(this.Counter));
  }
});
});


    	/* 
		=================================================================
		04 - Progress Bar
		=================================================================	
		*/


        var width = 0;
        var width1 = 50;
      
        function progressUp() {
            var elem = document.getElementById("myBar");
            document.getElementById("myProgress").style.display = "block";
            if (width < 100) {
                width+=10;
                elem.style.width = width + '%';
                elem.innerHTML = width * 1 + '%';
                $(".percent").text(" " + width + '%');
            }
        }
     
        function progressDown() {
            var elem = document.getElementById("myBar");
            if (width > 0) {
                width -=10;
                elem.style.width = width + '%';
                elem.innerHTML = width * 1 + '%';
                $(".percent").text(" " + width + '%');
            }
        }
     
     
     


});


