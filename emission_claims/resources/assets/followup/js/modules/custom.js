
/*------------------------------------------------------------------------------------
    
JS INDEX
=============

01 - Next Button
02 - Popup Slides
03 - Back Button
04 - Progress Bar
05 - Tooltip

-------------------------------------------------------------------------------------*/
import * as lib from './lib';
'use strict';
var checkboxPurchase = false;
var checkboxAnother = false;
var flCarnoValidation = false;
$(document).ready(function() {
 
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });


  $('#carRegNo').on("change paste blur", function() {
    let carRegNo = $.trim($('#carRegNo').val());
    let valid = true;
    let patt3 =  /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9 ]+$/;
    //let patt3 =  /^[a-zA-Z0-9 ]*$/;
    //let patt3 =  /^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/;
    if (carRegNo == "") {
      valid = false;
      $("#car_reg_err").text("Please Enter Car Registration Number");
      $("#car_reg_err").show();
      $('#carRegNo').focus();
      //jsShowHideTick($('#carRegNo'), "N");
      $(".carRegNo_wrap .validate_success").hide();
      $(".carRegNo_wrap .validate_error").show();
     
      return false;
    } else if (carRegNo.length <= 1) {
      $("#car_reg_err").text("Please Enter Valid Car Registration Number");
      $("#car_reg_err").show();
      //jsShowHideTick($('#carRegNo'), "N");
      $(".carRegNo_wrap .validate_success").hide();
      $(".carRegNo_wrap .validate_error").show();
      valid = false;
      return false;
    }else if (!carRegNo.match(patt3)) {
      $("#car_reg_err").text("Please Enter Valid Car Registration Number");
      $("#car_reg_err").show();
      //jsShowHideTick($('#carRegNo'), "N");
      $(".carRegNo_wrap .validate_success").hide();
      $(".carRegNo_wrap .validate_error").show();
      valid = false;
      return false;
    } else {
      $("#carRegNo").val($.trim($("#carRegNo").val()));
      $(".ad_btn").prop('disabled', false);
      $("#car_reg_err").text("").hide();
      //jsShowHideTick($(this), "Y");
      $(".carRegNo_wrap .validate_success").show();
      $(".carRegNo_wrap .validate_error").hide();
    }
  });

  $("body").on("click",".popers",function(){ 
  
    let acqdate=$(this).attr('rel');
    var newArr = [];
    
    $(".popers").each( function( index, element )
    {
      // if(acqdate!= $(this).attr('rel'))
      // {
        newArr.push($(this).attr('rel'));
      // }
    });
    if(newArr!=""){
      var acq_dates = newArr.toString();
    
      let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/ajax-find-keeper-date';
      let strParam = '?acq_dates=' + acq_dates + '&acqdate=' + acqdate;
     
      $.ajax({
      url: strAjaxUrl + strParam,
      }).done(function(result) {
        //console.log(result);
        $("#keeperDate").val(result);
        $("#carAcuquiredDate").val(acqdate);
        $("#regNextBtn").attr('disabled',true);  
        $("#firstdiselgrouppop").hide();
        $("#cust_info").submit();
        // setTimeout(function(){
        //    $("#cust_info").submit();
        // },100);  
      });
  
    } else { 
      $("#carAcuquiredDate").val(acqdate);
      $("#regNextBtn").attr('disabled',true);  
      $("#firstdiselgrouppop").hide();
      setTimeout(function(){
        $("#cust_info").submit();
      },100);  
    }
  });



  $("#regNextBtn").click(function() {
    let carRegNo = $.trim($('#carRegNo').val());
    let user_answers = $('#user_answers').val();
    let valid = true;
    let patt3 =  /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9 ]+$/;
    //let patt3 =  /^[a-zA-Z0-9 ]*$/;
    //let patt3 =  /^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/;
    if (carRegNo == "") {
      valid = false;
      $("#car_reg_err").text("Please Enter Car Registration Number");
      $("#car_reg_err").show();
      $('#carRegNo').focus();
      //jsShowHideTick($('#carRegNo'), "N");
      $(".carRegNo_wrap .validate_success").hide();
      $(".carRegNo_wrap .validate_error").show();
      return false;
    } else if (carRegNo.length <= 1) {
      $("#car_reg_err").text("Please Enter Valid Car Registration Number");
      $("#car_reg_err").show();
      //jsShowHideTick($('#carRegNo'), "N");
      $(".carRegNo_wrap .validate_success").hide();
      $(".carRegNo_wrap .validate_error").show();
      valid = false;
      return false;
    } else if (!carRegNo.match(patt3)) {
      $("#car_reg_err").text("Please Enter Valid Car Registration Number");
      $("#car_reg_err").show();
      //jsShowHideTick($('#carRegNo'), "N");
      $(".carRegNo_wrap .validate_success").hide();
      $(".carRegNo_wrap .validate_error").show();
      valid = false;
      return false;
    } else {
      /*$("#carRegNo").val($.trim($("#carRegNo").val()));
      $(".ad_btn").prop('disabled', false);
      $("#car_reg_err").text("").hide();
      //jsShowHideTick($(this), "Y");
      $(".carRegNo_wrap .validate_success").show();
      $(".carRegNo_wrap .validate_error").hide();*/
      carRegNoVal(false);
    }
    if(user_answers == 0){
      if($("#purchase_finance_lease").prop("checked") == false) {
        $("#purchase_err").html("Please Tick Checkbox").show();
        return false;
      } else {
        $("#purchase_err").hide();
        checkboxPurchase = true;
      }
      if($("#joinanother").prop("checked") == false) {
        $("#join_err").html("Please Tick Checkbox").show();
        return false;
      } else {
        $("#join_err").hide();
        checkboxAnother = true;
      }
    } else {
      checkboxPurchase = true;
      checkboxAnother = true;
    }

    if (checkboxPurchase && checkboxAnother && flCarnoValidation) {
        $("#cust_info").submit();
    } else { 
      return false;
    }
  });

  function carRegNoVal(){
    let carRegNo = $.trim($("#carRegNo").val()).replace(/\s+/g, '');
    let visitor_id = $('#visitor_id').val();
    let user_id = $('#user_id').val();
    
    if (carRegNo != '') { 

      // let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/ajax-carno-val-followup';
      let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/ajax-carno-val';

      let strParam = '?carRegNo=' + carRegNo + '&visitor_id=' + visitor_id + '&user_id=' + user_id + '&source=FLP';
      
      $.ajax({
        url: strAjaxUrl + strParam,
        type:"GET",
      }).done(function(result){
        if (result.validity==0) {
          $("#car_reg_err").text("Please Enter Valid Car Registration Number");
          $("#car_reg_err").show();
          $(".carRegNo_wrap .validate_success").hide();
          $(".carRegNo_wrap .validate_error").show();
          $("#carRegNo_wrap").focus();
          setTimeout(function(){
            $('#loade').modal('hide');
          },500);
        } else if (result.validity==1) {
          $(".carRegNo_wrap .validate_success").show();
          $(".carRegNo_wrap .validate_error").hide();
          $("#car_reg_err").text('');
          $("#car_reg_err").hide();
          setTimeout(function(){
            $('#loade').modal('hide');
          },100);  
          //CarKeepers(carRegNo);         
                
          $("#car_reg_err").text('');
          $("#car_reg_err").hide();
          $('.vehicleModel').html(result.vehicleData.MakeModel);

          $("#slide6,#arrow").hide();
          flCarnoValidation = true;
        } else if (result.validity==2) {
          $("#car_reg_err").text("We are sorry, however, this vehicle does not meet our criteria. Please enter another");
          $("#car_reg_err").show();
          $(".carRegNo_wrap .validate_success").hide();
          $(".carRegNo_wrap .validate_error").show();
          setTimeout(function(){
            $('#loade').modal('hide');
          },500);
        } else if (result.validity==3) {
          $("#car_reg_err").text("Record already exists");
          $("#car_reg_err").show();
          $(".carRegNo_wrap .validate_success").hide();
          $(".carRegNo_wrap .validate_error").show();
          setTimeout(function(){
            $('#loade').modal('hide');
          },500);
        }
      }).fail(function(){
        $("#car_reg_err").text("Unable to process Please, try again laterd");
      });
    }
    return false;
  }

  /***to get keepers */
  function CarKeepers(carRegNo) {
    if(carRegNo != '') 
    { 
      let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/ajax-keeper-val';
      //let strParam = '?carRegNo=' + carRegNo + '&visitor_id=' + visitor_id;
      let strParam = '?carRegNo=' + carRegNo;
      $.ajax({
        url: strAjaxUrl + strParam,
        type:"GET",
      }).done(function(result) {
        if(result.keeper_count>0) {  
          $("#arrow").hide(); 
          // console.log(result.keeper_dates);
          $("#when_purchase_modal").html(result.keeper_dates);
          // flPostCodeValidation = false;
          // $('#firstdiselgrouppop').modal('show');  
          $('#loade').modal('hide');
          setTimeout(function(){
            $('#firstdiselgrouppop').modal('show');
          },200); 
        } else {
          $("#regNextBtn").attr('disabled',true); 
          $("#carAcuquiredDate").val(result.keeper_dates);
          $("#slide6,#arrow").hide();
          // $("#slide2").show();
          $('#loade').modal('hide'); 
          // $("html, body").animate({
          //   scrollTop: 100
          // }, "100");
          $("#cust_info").submit(); 

          $("#firstdiselgrouppop").hide(); 
        }      
      }).fail(function(){ 
        console.log("Error");
      });
    }
  }

  function jsHideSearchSelSection(){
    /*Hide Post code lookup section*/
    $('#strdivid, #housedivid, #applynow03div, #currentAddressCollapse').hide();
    $('#next02divid').hide();
    $('#postbtndiv').show();
    $('#postbtndiv').addClass('blink_yellow');
    /*Hide Post code lookup section*/
  }
  function jsShowHideTick(o,e) {
    if (e == 'N') {
      o.next(".validate").show();
      o.next(".validate").addClass("validate_error");
      o.next(".validate").removeClass("validate_success");
    } else {
      o.next(".validate").show();
      o.next(".validate").removeClass("validate_error");
      o.next(".validate").addClass("validate_success");
    }
  }
});


    /* 
    =================================================================
    05 - analysing
    =================================================================	
    */

  // function toggleDiv() {
  //    setTimeout(function () {
  //        $("#slide9").hide();
  //        setTimeout(function () {
  //            $("#slide10").show();
  //            toggleDiv();
  //        }, 11000);
  //    }, 3000);
  // }
  // toggleDiv();