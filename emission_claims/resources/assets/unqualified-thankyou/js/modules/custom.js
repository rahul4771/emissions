

	$(function () {
        $('.selectpicker').selectpicker();
    });

$(document).ready(function() {
    

    $(".applynow01").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide01").hide();
        $("#slide02").show();
    });

    $(".applynow02").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide02").hide();
        $("#slide03").show();
    });
    $(".applynow02sub").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide02sub").show();
    });

    $(".applynow03").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide03, #slide03sub").hide();
        $("#slide04").show();
    });
    $(".applynow03aub").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide03sub").show();
        $("#slide03").hide();
    });

    $(".applynow04").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide04,#fstform").hide();
        $("#slide1,#scndfrm").show();
    });

    $("#next01").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide1").hide();
        $("#slide2").show();
    });
    $("#next02").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide2").hide();
        $("#slide3").show();
    });
    $("#back02").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide2").hide();
        $("#slide1").show();
    });
    $("#next03").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide3").hide();
        $("#slide4").show();
    });
    $("#lookup").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#postbtndiv").hide();
        $("#currentAddressCollapse").show();
        $("#applynow03div").show();

    });
    $("#back03").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide3").hide();
        $("#slide2").show();
    });
    $("#next04").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide4").hide();
        $("#slide1").show();
    });
    $("#back04").on('click', function() {
        $("html, body").animate({
            scrollTop: 170
        }, "100");
        $("#slide4,#currentAddressCollapse,#applynow03div").hide();
        $("#slide3,#postbtndiv").show();
       
    });


    
});


