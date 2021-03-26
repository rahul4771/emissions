
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

var flEmailValidation = false;
var redirect_url = null;
var flPostCodeValidation = false;
var flOthrPostCodeValidation = false;
var flCallGetCountry = false;
var flPhoneValidation = false;
var flSubmitBtnClick = false;
var prevEmail = '';
var prevPhone = '';
var prevPostcode = '';
var flCarnoValidation = false;

$(document).ready(function(){
    // Add minus icon for collapse element which is open by default
  $(".collapse.show").each(function(){
    $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
  });

  // Toggle plus minus icon on show hide of collapse element
  $(".collapse").on('show.bs.collapse', function(){
    $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
  }).on('hide.bs.collapse', function(){
    $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
  });
});


$(document).ready(function() {

  $(".next001").on('click', function() {
    let vehicle_class = $.trim($('#vehicle_class').val());
    if (vehicle_class!='') {
      $("html, body").animate({
          scrollTop: 100
      }, "100");
      $("#slide01, #slide01, .arrow").hide();
      $("#slide6").show();
    } else {
      $("#vehicle_class_err").text("Please Select Mercedez-Benz Class").show();
      $("#vehicle_class").focus();
      jsShowHideTick($('#vehicle_class'), "N");
    }  
  });

  $(".next012").on('click', function() {
    let txtFName    = $("#txtFName").val();
    let txtLName    = $("#txtLName").val();
    let txtPostCode = $("#txtPostCode").val();
    let address1    = $("#address1").val();
    let lstDobDay   = $("#lstDobDay").val();
    let lstDobMonth = $("#lstDobMonth").val();
    let lstDobYear  = $("#lstDobYear").val();

    let FirstChr    = txtFName.charAt(0);
    let lastchr     = txtFName.slice(-1);
    let lastchrL    = txtLName.slice(-1);
    let FirstChrL   = txtLName.charAt(0);
    
    let patt1       = /^[a-zA-Z\s]+$/;
    let patt2       = /^[a-zA-Z\s\-]+$/;
    let patt3       =  /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9 ]+$/;
    //let patt3 =  /^[a-zA-Z0-9 ]*$/;
    //let patt3 =  /^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/;
    let valid       = true;
    let patt4       =  /^(?:1|7)\d+$/;    
    
    if (txtFName == "") {
      valid = false;
      $("#fName_err").text("Please Enter First Name");
      $("#fName_err").show();
      $('#txtFName').focus();
      jsShowHideTick($('#txtFName'), "N");
      return false;
    } else if (txtFName.length <= 2) {
      valid = false;
      $("#fName_err").text("Please Enter Valid First Name");
      $("#fName_err").show();
      $('#txtFName').focus();
      jsShowHideTick($('#txtFName'), "N");
      return false;
    } else if (!FirstChr.match(patt1)) {
      $(".ad_btn").prop('disabled', true);
      $("#fName_err").text("Your Name is Invalid. Please Recheck ").show();
      jsShowHideTick($('#txtFName'), "N");
      return false;
    } else if (!lastchr.match(patt1)) {
      $(".ad_btn").prop('disabled', true);
      $("#fName_err").text("Your Name is Invalid. Please Recheck ").show();
      jsShowHideTick($('#txtFName'), "N");
      return false;
    } else if (!txtFName.match(patt2)) {
      $(".ad_btn").prop('disabled', true);
      $("#fName_err").text("Your Name is Invalid. Please Recheck ").show();
      jsShowHideTick($('#txtFName'), "N");
      return false;
    } else if (txtFName.indexOf("--") !== -1) {
      $(".ad_btn").prop('disabled', true);
      $("#fName_err").text("Your Name is Invalid. Please Recheck ").show();
      jsShowHideTick($('#txtFName'), "N");
      valid = false;
      return false;
    }

    if (txtLName == "") {
      $("#lName_err").text("Please Enter Last Name").show();
      $('#txtLName').focus();
      jsShowHideTick($('#txtLName'), "N");
      return false;
    } else if (txtLName.length <= 1) {
      $("#lName_err").text("Last Name Length Greater Than 2").show();
      $('#txtLName').focus();
      jsShowHideTick($('#txtLName'), "N");
      return false;
    } else if (!FirstChrL.match(patt1)) {
      $(".ad_btn").prop('disabled', true);
      $("#lName_err").text("Your Name is Invalid. Please Recheck ").show();
      jsShowHideTick($(this), "N");
      return false;
    } else if (!lastchrL.match(patt1)) {
      $(".ad_btn").prop('disabled', true);
      $("#lName_err").text("Your Name is Invalid. Please Recheck ").show();
      jsShowHideTick($(this), "N");
      return false;
    } else if (!txtLName.match(patt2)) {
      $(".ad_btn").prop('disabled', true);
      $("#lName_err").text("Your Name is Invalid. Please Recheck ").show();
      jsShowHideTick($(this), "N");
      return false;
    } else if (txtLName.indexOf("--") !== -1) {
      $(".ad_btn").prop('disabled', true);
      $("#lName_err").text("Your Name is Invalid. Please Recheck ").show();
      jsShowHideTick($(this), "N");
      return false;
    } else {
      $("#lName_err").text("").hide();
      jsShowHideTick($('#txtLName'), "Y");
      valid = true;
    }

    if (lstDobDay == "") {
      $("#dobDay_err").text("Please Select Date").show();
      $("#lstDobDay").focus();
      jsShowHideTick($('#lstDobDay'), "N");
      valid = false;
      return false;
    } else {
      $("#dobDay_err").text("").hide();
      jsShowHideTick($('#lstDobDay'), "Y");
      valid = true;
    }
    if (lstDobMonth == "") {
      $("#dobMonth_err").text("Please Select Month").show();
      $("#lstDobMonth").focus();
      jsShowHideTick($('#lstDobMonth'), "N");
      valid = false;
      return false;
    } else {
      $("#dobMonth_err").text("").hide();
      jsShowHideTick($('#lstDobMonth'), "Y");
      valid = true;
    }
    if (lstDobYear == "") {
      $("#dobYear_err").text("Please Select Year").show();
      $("#lstDobYear").focus();
      jsShowHideTick($('#lstDobYear'), "N");
      valid = false;
      return false;
    } else {
      $("#dobYear_err").text("").hide();
      jsShowHideTick($('#lstDobYear'), "Y");
      valid = true;
    }
    if (!lib.jsValidateDOB(lstDobDay,lstDobMonth,lstDobYear)) {
      $("#dob_final_err").text("Invalid Date of Birth. Please Select Valid Date of Birth").show();
      valid = false;
      return false;
    } else {
      let minYr = lib.findMinMaxYear("105");
      let maxYr = lib.findMinMaxYear("15");
      if (minYr > lstDobYear || maxYr <= lstDobYear) {
        $("#dob_final_err").text("Invalid Year in DOB, Age Should be Above 15 and Less Than 105").show();
        return false;
      } else {
        $("#dob_final_err").text("").hide();
      }
    }

    if ($.trim(txtPostCode).length == 0) {
      valid = false;
      $("#postcode_err").text("Please Enter Valid UK Postcode");
      $("#postcode_err").show();
      $("#txtPostCode").focus();
      jsShowHideTick($('#txtPostCode'), "N");
      // jsHideSearchSelSection();//Function call to hide search area
      return false;
    } else if (!lib.validPostCode(txtPostCode)) {
      valid = false;
      $("#postcode_err").text("Invalid UK Postcode").show();
      $("#postcode_err").show();
      $("#txtPostCode").focus();
      jsShowHideTick($('#txtPostCode'), "N");
      return false;
    } else if ($.trim(address1).length == 0) { 
      valid = false;          
      $("#currentAddressCollapse").show(); 
      $("#address1_error").html('Please Select Address').show();
      $("#address1").focus();
      return false;
    }

    if (valid) {
      $("html, body").animate({
          scrollTop: 100
      }, "100");
      $("#slide6, #slide01, .arrow").hide();
      $("#slide2").show(); 
    } else { 
      return false;
    }
  });

  $("#Submitbutton_inter").on('click', function() {
    let txtEmail    = $("#txtEmail").val();
    let txtPhone    = $("#txtPhone").val();
    let valid       = true;
    let patt4       =  /^(?:1|7)\d+$/;

    if ($.trim(txtEmail).length == 0) {
      valid = false;
      $("#email_err").text("Please Enter Valid Email Address").show();
      $('#txtEmail').focus();
      prevEmail = $("#txtEmail").val();
      //jsShowHideTick($('#txtEmail'), "N");
      $(".email_wrap .validate_success").hide();
      $(".email_wrap .validate_error").show();
      return false;
    } else if (!lib.validateEmail(txtEmail)) {
      valid = false;
      $("#email_err").text("Invalid Email Address").show();
      $('#txtEmail').focus();
      prevEmail = $("#txtEmail").val();
      //jsShowHideTick($('#txtEmail'), "N");
      $(".email_wrap .validate_success").hide();
      $(".email_wrap .validate_error").show();
      return false;
    }
    else if ($.trim(txtPhone).length == 0) {
      valid = false;
      $("#phone_err").text("Please Enter Valid Phone Number").show();
      $('#txtPhone').focus();
      //jsShowHideTick($('#txtPhone'), "N");
      $(".telephone_wrap .validate_success").hide();
      $(".telephone_wrap .validate_error").show();
      return false;
    } else if (!$.trim(txtPhone).match(patt4) && $.trim(txtPhone).length != 11) {
      valid = false;
      $("#phone_err").text("Please Enter Valid Phone Number").show();
      $('#txtPhone').focus();
      //jsShowHideTick($('#txtPhone'), "N");
      $(".telephone_wrap .validate_success").hide();
      $(".telephone_wrap .validate_error").show();
      return false;
    } else if ($.trim(txtPhone).match(patt4) && $.trim(txtPhone).length != 10) {
      valid = false;
      $("#phone_err").text("Please Enter Valid Phone Number").show();
      $('#txtPhone').focus();
      //jsShowHideTick($('#txtPhone'), "N");
      $(".telephone_wrap .validate_success").hide();
      $(".telephone_wrap .validate_error").show();
      return false;
    } else {
      /*phoneVal(true, true);*/
      //if (prevPhone != txtPhone) {
        phoneVal(false);
      //}
    }

    if (valid) {
      $("#doAction").val("LP");
        $("#non_loader2").hide();
        $("#loader2").css('display','block');
        $("#Submitbutton").attr('disabled',true);
        // $("#btnSubmit").addClass('bthdn');
        //document.cust_info.btnSubmit();
        $("#cust_info").submit();
    } else { 
      return false;
    } 
  });

  $(".next03").on('click', function() {
      $("html, body").animate({
          scrollTop: 210
      }, "100");
      $("#slide3, .arrow").hide();
      $("#slide4").show();
  });

  $('#txtFName').on("change paste blur", function() {
    let txtFName = $.trim($('#txtFName').val());
    let lastchr = txtFName.slice(-1);
    let FirstChr = txtFName.charAt(0);
    let patt2 =  /^[a-zA-Z\s\-]+$/;
    let patt1 =  /^[a-zA-Z\s]+$/;
    let valid = true;
    if (txtFName == "") {
      valid = false;
      $("#fName_err").text("Please Enter First Name").show();
      jsShowHideTick($(this), "N");
      return false;
    } else if (txtFName.length <= 2) {
      valid = false;
      $("#fName_err").text("Please Enter Valid First Name").show();
      jsShowHideTick($(this), "N");
      return false;
    } else if (!FirstChr.match(patt1)) {
      $("#fName_err").text("Your Name is Invalid. Please Recheck ").show();
      valid = false;
      jsShowHideTick($(this), "N");
      return false;
    } else if (!lastchr.match(patt1)) {
      valid = false;
      $("#fName_err").text("Your Name is Invalid. Please Recheck ").show();
      jsShowHideTick($(this), "N");
      return false;
    } else if (!txtFName.match(patt2)) {
      valid = false;
      $("#fName_err").text("Your Name is Invalid. Please Recheck ").show();
      jsShowHideTick($(this), "N");
      return false;
    } else if (txtFName.indexOf("--") !== -1) {
      valid = false;
      $("#fName_err").text("Your Name is Invalid. Please Recheck ").show();
      jsShowHideTick($(this), "N");
      return false;
    } else {
      $("#fName_err").text("").hide();
      jsShowHideTick($(this), "Y");
    }
  });

  $('#txtFName').keypress(function(evt) {
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 123) && charCode != 32) {
      return false;
    }
    return true;
  });

  $('#txtLName').keypress(function(evt) {
    evt = (evt) ? evt : window.event;
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 123) && charCode != 32) {
      return false;
    }
    return true;
  });

  $('#txtLName').on("change paste blur", function() {
    let surname = $.trim($('#txtLName').val());
    let lastchr = surname.slice(-1);
    let FirstChr = surname.charAt(0);
    let patt2 =  /^[a-zA-Z\s\-]+$/;
    let patt1 =  /^[a-zA-Z\s]+$/;
    let valid = true;
    if (surname == "") {
      valid = false;
      $("#lName_err").text("Please Enter Last Name");
      $("#lName_err").show();
      jsShowHideTick($('#txtLName'), "N");
      return false;
    } else if (surname.length <= 1) {
      $("#lName_err").text("Please Enter Valid Last Name");
      $("#lName_err").show();
      jsShowHideTick($('#txtLName'), "N");
      valid = false;
      return false;
    } else if (!lib.lNameCheck(surname)) {
      $("#lName_err").text("Your Name is Invalid. Please Recheck");
      $("#lName_err").show();
      jsShowHideTick($('#txtLName'), "N");
      valid = false;
      return false;
    } else {
      $(".ad_btn").prop('disabled', false);
      $("#lName_err").text("").hide();
      jsShowHideTick($(this), "Y");
    }
  });

  $('#lstDobDay').on("change paste blur", function() {
    let lstDobDay = $('#lstDobDay').val();
    $("#dob_final_err").text("").hide();
    if (lstDobDay == "") {
      $(".ad_btn").prop('disabled', true);
      $("#dobDay_err").text("Please Select Date").show();
      jsShowHideTick($(this), "N");
    } else {
      $(".ad_btn").prop('disabled', false);
      $("#dobDay_err").text("").hide();
      jsShowHideTick($(this), "Y");
    }
  });  

  $('#lstDobMonth').on("change paste blur", function() {
    let lstDobMonth = $('#lstDobMonth').val();
    $("#dob_final_err").text("").hide();
    if (lstDobMonth == "") {
      $(".ad_btn").prop('disabled', true);
      $("#dobMonth_err").text("Please Select Month").show();
      jsShowHideTick($(this), "N");
    } else {
      $(".ad_btn").prop('disabled', false);
      $("#dobMonth_err").text("").hide();
      jsShowHideTick($(this), "Y");
    }
  });

  $('#lstDobYear').on("change paste blur", function() {
    let lstDobYear = $('#lstDobYear').val();
    $("#dob_final_err").text("").hide();
    if (lstDobYear == "") {
      $(".ad_btn").prop('disabled', true);
      $("#dobYear_err").text("Please Select Year").show();
      jsShowHideTick($(this), "N");
    } else {
      $(".ad_btn").prop('disabled', false);
      $("#dobYear_err").text("").hide();
      jsShowHideTick($(this), "Y");
    }
  });

  $('#txtPostCode').on("keyup blur change", function(e) {
    let txtPostCode = $('#txtPostCode').val();
    $("#address1_error").hide();
    jsHideSearchSelSection();//Function call to hide search area
    if ($.trim(txtPostCode).length == 0) {
      $("#postcode_err").text("Please Enter Valid UK Postcode").show();
      prevPostcode = txtPostCode;
      jsShowHideTick($('#txtPostCode'), "N");
      e.preventDefault();
    } else if (!lib.validPostCode(txtPostCode)) {
      $("#postcode_err").text("Invalid UK Postcode").show();
      prevPostcode = txtPostCode;
      jsShowHideTick($('#txtPostCode'), "N");
      e.preventDefault();
    } else if ($.trim(txtPostCode).length > 4) {
      //if (prevPostcode != txtPostCode) {
        postcodeVal(false);
      //}
    }
  });

  $("#postcodevalid").click(function(e) {
    let txtPostCode = $("#txtPostCode").val();
    let valid = true;
    if ($.trim(txtPostCode).length == 0) {
      $("#postcode_err").text("Please Enter Valid UK Postcode").show();
      $("#txtPostCode").focus();
      jsShowHideTick($('#txtPostCode'), "N");
      jsHideSearchSelSection();//Function call to hide search area
        return false;
    } else if (!lib.validPostCode(txtPostCode)) {
      $("#postcode_err").text("Invalid UK Postcode").show();
      valid = false;
      $("#txtPostCode").focus();
      jsShowHideTick($('#txtPostCode'), "N");
      jsHideSearchSelSection();//Function call to hide search area
      return false;
    } else {
      postcodeVal(txtPostCode, true);
      $("#address1").addClass('animated-effect');
    }
  });  

  $('#address1').on('change', function() {
    let addrid = $(this).val();
    let txtPostCode = $("#txtPostCode").val();
    let visitor_id = $('#visitor_id').val();
    if (addrid != '') {
      $("#address1_error").hide();
      $("#loader_divid").show();address1
      
      let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/get-addr-split-postcode-api';
      let strParam = '?AddressID=' + addrid+'&postcode=' +txtPostCode+'&visitor_id=' +visitor_id;
      $.ajax({
          url: strAjaxUrl + strParam,
      })
      .done(function(msg) {
        $('#strdivid').show();
        $('#housedivid').show();
        //$('#postcodevalll').hide();

        if (msg != ",,") {
          let res = JSON.stringify(msg);
          let obj=JSON.parse(res);
          let Company = $.trim(obj.Company);
          let Line1 = $.trim(obj.Line1);
          let Line2 = $.trim(obj.Line2);
          let Line3 = $.trim(obj.Line3);
          let Town = $.trim(obj.Town);
          let County = $.trim(obj.County);
          let Udprn = $.trim(obj.Udprn);
          let deliverypointsuffix = $.trim(obj.deliverypointsuffix);
          let pz_mailsort = $.trim(obj.pz_mailsort);
          let Country = $.trim(obj.Country);

          let street = Line2;
          let housenumber = Line1;
          
          $('#addrBox').show();
          $('#address2').val(addrid);                 
          $('#txtHouseName').val(Company);
          $('#txtHouseNumber').val(Line1);
          $('#txtStreet').val(Line2);
          $('#txtAddress3').val(Line3);
          $('#txtCounty').val(County);
          $('#txtTown').val(Town);
          $('#txtUdprn').val(Udprn);
          $('#txtDeliveryPointSuffix').val(deliverypointsuffix);
          $('#txtPz_mailsort').val(pz_mailsort);
          $('#txtCountry').val(Country);
         
          if (street == "") {
            $('#strdivid').hide();
          }

          if (housenumber == "") {
            $('#housedivid').hide();
          }
          $("#address1").removeClass('animated-effect');
        }
        $("#loader_divid").hide();
      });      
    } else {
      $('#strdivid').hide();
      $('#housedivid').hide();
      $("#address1").addClass('animated-effect');
      //$('#applynow03div').hide();
    }
  });

  $('#txtEmail').on("change paste blur", function(e) {
    let txtEmail = $('#txtEmail').val();
    let valid = true;
    if ($.trim(txtEmail).length == 0) {
      $("#email_err").text("Please Enter Valid Email Address").show();
      prevEmail = $("#txtEmail").val();
      $(".ad_btn").prop('disabled', true);
      //jsShowHideTick($(this), "N");
      $(".email_wrap .validate_success").hide();
      $(".email_wrap .validate_error").show();
      e.preventDefault();
      valid = false;
      return false;
    } else if (!lib.validateEmail(txtEmail)) {
      $("#email_err").text("Invalid Email Address").show();
      prevEmail = $("#txtEmail").val();
      $(".ad_btn").prop('disabled', true);
      //jsShowHideTick($(this), "N");
      $(".email_wrap .validate_success").hide();
      $(".email_wrap .validate_error").show();
      e.preventDefault();
      valid = false;
      return false;
    } else {
      if (prevEmail!=txtEmail) {
        emailVal(false);
      }
    }
  });

  $('#txtPhone').on("change blur paste", function(e) {
    let txtPhone = $('#txtPhone').val();
    txtPhone = txtPhone.replace(/\D/g,'');
    let patt4 =  /^(?:1|7)\d+$/;
    let valid = true;
    if ($.trim(txtPhone).length == 0) {
      $("#phone_err").text("Please Enter Valid Phone Number").show();
      $(".telephone_wrap .validate_success").hide();
      $(".telephone_wrap .validate_error").show();
      valid = false;
      return false;
      //jsShowHideTick($('#txtPhone'), "N");
    } else if (!$.trim(txtPhone).match(patt4)  && $.trim(txtPhone).length!=11) {
      $("#phone_err").text("Please Enter Valid Phone Number").show();
      $(".telephone_wrap .validate_success").hide();
      $(".telephone_wrap .validate_error").show();
      valid = false;
      return false;
    } else if ($.trim(txtPhone).match(patt4) && $.trim(txtPhone).length!=10) {
      $("#phone_err").text("Please Enter Valid Phone Number").show();
      $(".telephone_wrap .validate_success").hide();
      $(".telephone_wrap .validate_error").show();
      valid = false;
      return false;
    } else if($.trim(txtPhone).length>9){
      //if (prevPhone!=txtPhone) {
        phoneVal(false);
      /*} else {
        $(".telephone_wrap .validate_success").hide();
        $(".telephone_wrap .validate_error").hide();
        $("#phone_err").text("").show();
      }*/
    }
  });

  $('#txtPhone').keypress(function(evt) {
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
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
      $("#carRegNo").val($.trim($("#carRegNo").val()));
      $(".ad_btn").prop('disabled', false);
      $("#car_reg_err").text("").hide();
      //jsShowHideTick($(this), "Y");
      $(".carRegNo_wrap .validate_success").show();
      $(".carRegNo_wrap .validate_error").hide();

      carRegNoVal(false);
    }
  });

  $('.btn-remember').on('click', function() {
    $("#idntRemember").val(1);
    $("#carRegNo").val('');
    if ($("#joinanother").prop("checked") != true) {
      $("#joinanother").addClass('anim_ylw');
    }   
  });

  $('#joinanother').on('click', function() {
    if ($(this).prop("checked") == true){
      $('#joined_another_claim').val('no');
      if ($("#idntRemember").val()==1){
        $("#joinanother").removeClass('anim_ylw');
        if ($("#readagree").prop("checked") != true) {
          $("#readagree").addClass('anim_ylw');
        } else {
          $(".regNextBtn").addClass('anim_ylw');
        }
      }
    } else {
      $('#joined_another_claim').val('yes');
      if ($("#idntRemember").val()==1) {
        $("#joinanother").addClass('anim_ylw');
        $("#readagree").removeClass('anim_ylw');
        $(".regNextBtn").removeClass('anim_ylw');
      }
    }
  });

  $('#readagree').on('click', function() {
    if ($(this).prop("checked") == true){
      $("#readagree").removeClass('anim_ylw');
      if ($("#idntRemember").val()==1 && $("#joinanother").prop("checked") == true) {        
        $(".regNextBtn").addClass('anim_ylw');
      }
    } else {
      if ($("#idntRemember").val()==1) {
        if ($("#joinanother").prop("checked") == true) {
          $("#readagree").addClass('anim_ylw');
          $(".regNextBtn").removeClass('anim_ylw');
        } else {
          $("#readagree").removeClass('anim_ylw');
        }
      }      
    }
  });

  $("#Submitbutton").click(function() {
    
    let carRegNo = $.trim($('#carRegNo').val());
    let patt1       = /^[a-zA-Z\s]+$/;
    let patt2       = /^[a-zA-Z\s\-]+$/;
    let patt3       =  /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9 ]+$/;
    //let patt3 =  /^[a-zA-Z0-9 ]*$/;
    //let patt3 =  /^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/;
    let valid       = true;
    let patt4       =  /^(?:1|7)\d+$/;
    
    if (carRegNo != "") {
      if (!carRegNo.match(patt3)) {
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

        carRegNoValValidate(false);
      }
    }  

    if($("#joinanother").prop("checked") == false) {
      $("#join_err").html("Please Tick Checkbox").show();
      valid = false;
      return false;
    } else {
      $("#join_err").hide();
      //valid = true;
    }

    if($("#readagree").prop("checked") == false) {
      $("#tick_err").html("Please Tick Checkbox").show();
      valid = false;
      return false;
    } else {
      $("#tick_err").hide();
      //valid = true;
    }
    
    //if (valid && flPhoneValidation) {
    if (valid && carRegNo && flCarnoValidation) {
      /*
      $("#doAction").val("LP");
      $("#non_loader2").hide();
      $("#loader2").css('display','block');
      $("#Submitbutton").attr('disabled',true);
      // $("#btnSubmit").addClass('bthdn');
      //document.cust_info.btnSubmit();
      $("#cust_info").submit(); 
      // return true; 
      */
      
      // if (carRegNo && flCarnoValidation) {
      //   $("#doAction").val("LP");
      //   $("#non_loader2").hide();
      //   $("#loader2").css('display','block');
      //   $("#Submitbutton").attr('disabled',true);
      //   // $("#btnSubmit").addClass('bthdn');
      //   //document.cust_info.btnSubmit();
      //   $("#cust_info").submit(); 
      // } else if (carRegNo && flCarnoValidation==false) {
      //   return false;
      // } else {
        $("#doAction").val("LP");
        $("#non_loader2").hide();
        $("#loader2").css('display','block');
        $("#Submitbutton").attr('disabled',true);
        // $("#btnSubmit").addClass('bthdn');
        //document.cust_info.btnSubmit();
        $("#cust_info").submit(); 
      //}
    } else if (valid && !carRegNo) {
      $("#doAction").val("LP");
        $("#non_loader2").hide();
        $("#loader2").css('display','block');
        $("#Submitbutton").attr('disabled',true);
        // $("#btnSubmit").addClass('bthdn');
        //document.cust_info.btnSubmit();
        $("#cust_info").submit();
    } else { 
      // if((valid && flPhoneValidation) && !flEmailValidation){ 
      //   window.location.href = redirect_url; 
      // }else{
      return false;
      // }

    }
  });





  
  $(".bank-name").click(function() {
    $("#formpopup").show();
  });

  $(".clshyear, .orclick").click(function() {
    $("#poslide1").hide();
    $("#poslide2").show();
  });

  
  $(".nothis").click(function() {
    $("#poslide2").hide();
    $("#poslide3").show();
  });


  $("#nothisonly_yes").click(function() {
    $("#formpopup").hide();
  });

  $("#btn-calcu").click(function() {
    $("#formpopup, #slide1").hide();
    $("#slide2").show();
  });

  $('.count').each(function () {
    $(this).prop('Counter',0).animate({
      Counter: $(this).text()
    }, {
      duration: 4000,
      easing: 'swing',
      step: function (now) {
          $(this).text(Math.ceil(now));
      }
    });
  });
 
  $('.input_class_checkbox').each(function(){
    $(this).hide().after('<div class="class_checkbox" />');  
  });
  
  $('.class_checkbox').on('click',function(){
    $(this).toggleClass('checked').prev().prop('checked',$(this).is('.checked'))
  });






  function postcodeVal(flFocus, flForCountry) {
    let txtPostCode = $.trim($("#txtPostCode").val());
    let visitor_id = $('#visitor_id').val();
    prevPostcode = txtPostCode;
    if (flForCountry) {
      flCallGetCountry = true;
    }

    if (txtPostCode != '' && !flPostCodeValidation) {
      $("#txtPostCode").next(".tick").hide();
      $("#loader-txtPostCode").show();
      flPostCodeValidation = true;
      let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/ajax-postcode-val';
      let strParam = '?postcode=' + txtPostCode + '&visitor_id=' + visitor_id;
      $.ajax({
        url: strAjaxUrl + strParam,
      }).done(function(result) {
        $("#loader-txtPostCode").hide();
        flPostCodeValidation = false;
        if (result == 0) { 
          $("#postcode_err").text("Please Enter Valid Postcode").show(); 
          $("#next02").prop("disabled", true);
          $('#currentAddressCollapse').hide();
          if (flFocus) {
              $("#txtPostCode").focus();
          }
          jsShowHideTick($("#txtPostCode"), "N");
        } else {
          //if(flCallGetCountry){
          getcounty(txtPostCode);

          $('#currentAddressCollapse').show();
          $('#postbtndiv').hide();
          //}
          $("#postcode_err").text('').hide();
          $("#next02").prop("disabled", false);
          jsShowHideTick($("#txtPostCode"), "Y");
          $("#address1").addClass('animated-effect');
        }
      });
    }
  }

  function getcounty(postcode){
    if (postcode != '') {
      $("#loader_divid").show();
      let visitor_id = $('#visitor_id').val();
      let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/get-addr-list-postcode-api';
      let strParam = '?postcode=' + postcode + '&visitor_id=' + visitor_id;
      $.ajax({
        url: strAjaxUrl + strParam,
      })
      .done(function(msg) {
        if (msg != "Nothing found!") {
          $('#address1') .find('option') .remove() .end();
          $('#strdivid').hide();
          $('#housedivid').hide();
          //$('#applynow03div').hide();
          $('#address1').append(msg);
        } else {
          $('#addrBox').hide();
          $('#addrlistBox').hide();
        }
        $("#loader_divid").hide();
      });
    } else {
      $('#addrBox').hide();
      $('#addrlistBox').hide();
    }
  }

  function emailVal(flFocus, flenabelbutton) {
    prevEmail = $("#txtEmail").val();
    let txtEmail = $.trim($("#txtEmail").val());
    let visitor_id = $('#visitor_id').val();
    let product_slug = $('#product_name').val();
    if (txtEmail != '') {
      $("#loader-email").show();
      let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/ajax-email-val';
      let strParam = '?Email=' + txtEmail+'&visitor_id=' + visitor_id+'&product='+product_slug;
      $.ajax({
        url: strAjaxUrl + strParam,
      }).done(function(result) { 
        $("#loader-email").hide();
        if (result == 0) {
          $("#email_err").text("Invalid Email Address").show();
          /*$("#applynow04").prop('disabled', true);*/
          //jsShowHideTick($('#txtEmail'), "N");
          $(".email_wrap .validate_success").hide();
          $(".email_wrap .validate_error").show();
          if (flFocus) {
            $("#txtEmail").focus();
          }
          flEmailValidation = false;
          flSubmitBtnClick = false;
          
          //Get user id using
          let strAjaxUrl_2 = lib.jsGetSiteUrl() + 'ajax/ajax-get-user-id';
          let strParam_2 = '?Email=' + txtEmail;
          $.ajax({
            url: strAjaxUrl_2 + strParam_2,
          }).done(function(result2) {
            if(result2 != null){
              redirect_url = '/web/upsell-page?userId='+result2+'&visitorId='+visitor_id+'&upsell='+product_slug;
            }
          });          
        }
        /*else if (result == 2) {
            $("#email_err").text("The Email Address Already Exists in Our Records. Please Try Again Using A Different id");                
            jsShowHideTick($('#txtEmail'), "N");
            if(flFocus){
                $("#txtEmail").focus();
            }
            flEmailValidation = false;
            flSubmitBtnClick=false;
        }*/
        else if (result == 3) {
          $("#email_err").text("Invalid Email Address").show();
          //jsShowHideTick($('#txtEmail'), "N");
          $(".email_wrap .validate_success").hide();
          $(".email_wrap .validate_error").show();
          if (flFocus) {
            $("#txtEmail").focus();
          }
          flEmailValidation = false;
          flSubmitBtnClick=false;
        } else {
          $("#email_err").text('').hide();
          //jsShowHideTick($('#txtEmail'), "Y");
          $(".email_wrap .validate_success").show();
          $(".email_wrap .validate_error").hide();
          flEmailValidation = true;
          if (flSubmitBtnClick && flEmailValidation && flPhoneValidation) {
            flSubmitBtnClick = false;
            return true;
          }
        }
      });
    }
  }

  function phoneVal(flFocus) {
    prevPhone = $("#txtPhone").val();
    var txtPhone = $.trim($("#txtPhone").val());
    txtPhone = txtPhone.replace(/\D/g, '');
    var visitor_id = $('#visitor_id').val();
    if (txtPhone != '') {
      $("#loader-phone").show();
      $("#phone_err").text('').hide();
      let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/ajax-phone-val';
      let strParam = '?phonenumber=' + txtPhone + '&visitor_id=' + visitor_id;
      $.ajax({
      url: strAjaxUrl + strParam,
      }).done(function(result) {
        $("#loader-phone").hide();
        if (result == 0) {
          $("#phone_err").text("Please Enter Valid Working Phone Number").show();
          $("#phone_err").show()
          /*$("#applynow04").prop("disabled", true);*/
          //jsShowHideTick($('#txtPhone'), "N");
          $(".telephone_wrap .validate_success").hide();
          $(".telephone_wrap .validate_error").show();
          if (flFocus) {
            $("#txtPhone").focus();
          }
          flPhoneValidation = false;
          flSubmitBtnClick = false;
        } else if (result == 2) {
          $("#phone_err").text("This Phone Number is already in our records").show();
          $("#phone_err").show()
          /*$("#applynow04").prop("disabled", true);*/
          //jsShowHideTick($('#txtPhone'), "N");
          $(".telephone_wrap .validate_success").hide();
          $(".telephone_wrap .validate_error").show();
          if (flFocus) {
            $("#txtPhone").focus();
          }
          flPhoneValidation = false;
          flSubmitBtnClick = false;
        } else {
          $("#phone_err").text('').hide();
          //jsShowHideTick($('#txtPhone'), "Y");
          $(".telephone_wrap .validate_error").hide();
          $(".telephone_wrap .validate_success").show();
          flPhoneValidation = true;
          if (flSubmitBtnClick && flEmailValidation && flPhoneValidation) {
            flSubmitBtnClick = false;
            return true;
          }
        }
      });
    }
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

  function jsHideSearchSelSection(){
    /*Hide Post code lookup section*/
    $('#strdivid, #housedivid, #applynow03div, #currentAddressCollapse').hide();
    $('#postbtndiv').show();
    /*Hide Post code lookup section*/
  }

  function carRegNoVal(){
    ///flCarnoValidation = false;
    let carRegNo = $.trim($("#carRegNo").val()).replace(/\s+/g, '');
    let visitor_id = $('#visitor_id').val();
    if (carRegNo != '') {
      let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/ajax-carno-val';
      //let strParam = '?carRegNo=' + carRegNo + '&visitor_id=' + visitor_id;
      let strParam = '?carRegNo=' + carRegNo + '&visitor_id=' + visitor_id + '&source=LP';
      $.ajax({
        url: strAjaxUrl + strParam,
        type:"GET",
      }).done(function(result){
        $("#loader-txtPostCode").hide();
        // flPostCodeValidation = false;
        /*
        if (result.validity == 0) {
          $("#car_reg_err").text("Please Enter Valid Car Registration Number");
          $("#car_reg_err").show();
          $(".carRegNo_wrap .validate_success").hide();
          $(".carRegNo_wrap .validate_error").show();
          $("#carRegNo_wrap").focus();
          setTimeout(function(){
            $('#loade').modal('hide');
          },500);
        } else {
          $(".carRegNo_wrap .validate_success").show();
          $(".carRegNo_wrap .validate_error").hide();

          $("html, body").animate({
            scrollTop: 100
          }, "100");
          console.log(result.vehicleData.Make.toLowerCase());
          if (result.vehicleData.Make && result.vehicleData.Make.toLowerCase()=='mercedes-benz') {
            setTimeout(function(){
              $('#loade').modal('hide');
            },500);
            $('.vehicleModel').html(result.vehicleData.MakeModel);
            $("#slide1").hide();
            $("#slide31").show();
            $("#slide32").hide();
            //$("#loade").modal('hide');
            $("#idntRemember").val(0);
          } else {
            setTimeout(function(){
              $('#loade').modal('hide');
            },500);
            $("#slide1").hide();
            $("#slide32").show();
            $("#slide31").hide();
            //$("#loade").modal('hide');
          }
        }
        */

        if (result.validity==0) {
          $("#car_reg_err").text("Please Enter Valid Car Registration Number");
          $("#car_reg_err").show();
          $(".carRegNo_wrap .validate_success").hide();
          $(".carRegNo_wrap .validate_error").show();
          $("#carRegNo_wrap").focus();
          // setTimeout(function(){
          //   $('#loade').modal('hide');
          // },500);
          flCarnoValidation = false;
        } else if (result.validity==1) {
          $(".carRegNo_wrap .validate_success").show();
          $(".carRegNo_wrap .validate_error").hide();
          // $("html, body").animate({
          //   scrollTop: 100
          // }, "100");
          // $('#loade').modal('hide');
          // setTimeout(function(){
          //   $('#loade').modal('hide');
          // },100);  
          //CarKeepers(carRegNo);
         
                
          $("#car_reg_err").text('');
          $("#car_reg_err").hide();
          $('.vehicleModel').html(result.vehicleData.MakeModel);
          /***get keepers */ 
        

          $("#idntRemember").val(0);            
          //$("#slide6").hide();
          //$("#slide2").show();
          // $("#slide32").hide();
          //$("#loade").modal('hide');
          flCarnoValidation = true;
        } else if (result.validity==2) { 
          $("#car_reg_err").text("We are sorry, however, this vehicle does not meet our criteria. Please enter another");
          $("#car_reg_err").show();
          $(".carRegNo_wrap .validate_success").hide();
          $(".carRegNo_wrap .validate_error").show();
          // setTimeout(function(){
          //   $('#loade').modal('hide');
          // },500);
          // $("#slide1").hide();
          // $("#slide32").show();
          // $("#slide31").hide();
          flCarnoValidation = false;
        } else if (result.validity==3) {
          $("#car_reg_err").text("Record already exists");
          $("#car_reg_err").show();
          $(".carRegNo_wrap .validate_success").hide();
          $(".carRegNo_wrap .validate_error").show();
          // setTimeout(function(){
          //   $('#loade').modal('hide');
          // },500);
          // $("#slide1").hide();
          // $("#slide32").show();
          // $("#slide31").hide();
          flCarnoValidation = false;
        }

      }).fail(function(){
        console.log("Error");
      });
    }
  }

  function carRegNoValValidate(){
    //flCarnoValidation = false;
    let carRegNo = $.trim($("#carRegNo").val()).replace(/\s+/g, '');
    let visitor_id = $('#visitor_id').val();
    if (carRegNo != '') {
      let strAjaxUrl = lib.jsGetSiteUrl() + 'ajax/ajax-carno-val';
      //let strParam = '?carRegNo=' + carRegNo + '&visitor_id=' + visitor_id;
      let strParam = '?carRegNo=' + carRegNo + '&visitor_id=' + visitor_id + '&source=LP';
      $.ajax({
        url: strAjaxUrl + strParam,
        type:"GET",
      }).done(function(result){
        $("#loader-txtPostCode").hide();
        // flPostCodeValidation = false;
        /*
        if (result.validity == 0) {
          $("#car_reg_err").text("Please Enter Valid Car Registration Number");
          $("#car_reg_err").show();
          $(".carRegNo_wrap .validate_success").hide();
          $(".carRegNo_wrap .validate_error").show();
          $("#carRegNo_wrap").focus();
          setTimeout(function(){
            $('#loade').modal('hide');
          },500);
        } else {
          $(".carRegNo_wrap .validate_success").show();
          $(".carRegNo_wrap .validate_error").hide();

          $("html, body").animate({
            scrollTop: 100
          }, "100");
          console.log(result.vehicleData.Make.toLowerCase());
          if (result.vehicleData.Make && result.vehicleData.Make.toLowerCase()=='mercedes-benz') {
            setTimeout(function(){
              $('#loade').modal('hide');
            },500);
            $('.vehicleModel').html(result.vehicleData.MakeModel);
            $("#slide1").hide();
            $("#slide31").show();
            $("#slide32").hide();
            //$("#loade").modal('hide');
            $("#idntRemember").val(0);
          } else {
            setTimeout(function(){
              $('#loade').modal('hide');
            },500);
            $("#slide1").hide();
            $("#slide32").show();
            $("#slide31").hide();
            //$("#loade").modal('hide');
          }
        }
        */

        if (result.validity==0) {
          $("#car_reg_err").text("Please Enter Valid Car Registration Number");
          $("#car_reg_err").show();
          $(".carRegNo_wrap .validate_success").hide();
          $(".carRegNo_wrap .validate_error").show();
          $("#carRegNo_wrap").focus();
          // setTimeout(function(){
          //   $('#loade').modal('hide');
          // },500);
          // valid = false;
          // return false;
          flCarnoValidation = false;
        } else if (result.validity==1) {
          $(".carRegNo_wrap .validate_success").show();
          $(".carRegNo_wrap .validate_error").hide();
          // $("html, body").animate({
          //   scrollTop: 100
          // }, "100");
          // $('#loade').modal('hide');
          // setTimeout(function(){
          //   $('#loade').modal('hide');
          // },100);  
          //CarKeepers(carRegNo);
         
                
          $("#car_reg_err").text('');
          $("#car_reg_err").hide();
          $('.vehicleModel').html(result.vehicleData.MakeModel);
          /***get keepers */ 
        

          $("#idntRemember").val(0);            
          //$("#slide6").hide();
          //$("#slide2").show();
          // $("#slide32").hide();
          //$("#loade").modal('hide');
          //valid = true;
          flCarnoValidation = true;
          return true;
        } else if (result.validity==2) { 
          $("#car_reg_err").text("We are sorry, however, this vehicle does not meet our criteria. Please enter another");
          $("#car_reg_err").show();
          $(".carRegNo_wrap .validate_success").hide();
          $(".carRegNo_wrap .validate_error").show();
          // setTimeout(function(){
          //   $('#loade').modal('hide');
          // },500);
          // $("#slide1").hide();
          // $("#slide32").show();
          // $("#slide31").hide();
          // valid = false;
          // return false;
          flCarnoValidation = false;
        } else if (result.validity==3) {
          $("#car_reg_err").text("Record already exists");
          $("#car_reg_err").show();
          $(".carRegNo_wrap .validate_success").hide();
          $(".carRegNo_wrap .validate_error").show();
          // setTimeout(function(){
          //   $('#loade').modal('hide');
          // },500);
          // $("#slide1").hide();
          // $("#slide32").show();
          // $("#slide31").hide();
          // valid = false;
          // return false;
          flCarnoValidation = false;
        }

      }).fail(function(){
        console.log("Error");
      });
    }
  }

  
});