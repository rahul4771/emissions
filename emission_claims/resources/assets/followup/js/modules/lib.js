/*#############################################################################
  # Vandalay - Copyright (C)  http://vandalay.in
  # This code is written by Vandalay, It's a sole property of
  # Vandalay and cant be used / modified without license.
  # Any changes / alterations, illegal uses, unlawful distribution, copying is strictly
  # prohibited
  #############################################################################*/

'use strict';

export function jsGetSiteUrl() {
  let ajaxpath = $('#ajax-path').val();
  let url = '';
  if (ajaxpath) {
    url = ajaxpath;
  } else {
    url = $(location).attr('protocol') + "//" + $(location).attr('hostname') + "/";
  }
  return url;
}

export function validPostCode(postcode) {
  postcode  = postcode.replace(/\s/g, "");
  let regex = /^(([A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2})|([A-Z]{1,2}[0-9][A-Z] ?[0-9][A-Z]{2,3}))$/i;
  return regex.test(postcode);
}


export function findMinMaxYear(year) {
  let d = new Date();
  year  = d.getFullYear() - year;
  return year;
}


export function validateEmail(sEmail) {
  let filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  if (filter.test(sEmail)) {
    return true;
  } else {
    return false;
  }
}

/*
# Purpose: Validate Number.
# @param Object (Event).
# @return Boolean (True / False).
*/
export function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  let charCode = (evt.which) ? evt.which : evt.keyCode;
  if ((charCode > 32 && charCode < 37) || (charCode > 40 && (charCode < 48 || charCode > 57))) {
    return false;
  }
  return true;
}

/*
# Purpose: Validate Name.
# @param String (Name).
# @return Boolean (True / False).
*/
export function nameCheck(name) {
  let str = $.trim(name);
  /*let patt1 = /[^a-z\s]/gi;*/
  let patt1 = /[^a-z\-\s]/gi;
  let result = str.match(patt1);
  let str1 = str.replace(/\s/g,'');

  if (result && result.length > 0) {
    return false;
  } else {
    /*return true;*/
    /*var count = (str.match(/-/g) || []).length;*/
    if (str.startsWith('-')) {
      return false;
    }
    /*else if(count>1){
        return false;
    }*/
    else if (str.endsWith('-')) {
      return false;
    } else if (str.indexOf("--") >= 1) {
      return false;
    } else {
      return true;
    }
  }
}

/*
# Purpose: Validate Last Name.
# @param String (Last Name).
# @return Boolean (True / False).
*/
export function lNameCheck(name) {
  let str = $.trim(name);
  /*let patt1 = /[^a-z\s\']/gi;*/
  let patt1 = /[^a-z\-\s\']/gi;
  let result = str.match(patt1);
  let str1 = str.replace(/\s/g,'');

  if (result && result.length > 0) {
    return false;
  } else {
    /*return true;*/
    if (str.startsWith('-')) {
      return false;
    } else if (str.endsWith('-')) {
      return false;
    } else if (str.indexOf("--") >= 1) {
      return false;
    } else {
      return true;
    }
  }
}

/*
# Purpose: Convert string into uppercase.
# @param String.
# @return String.
*/
export function capitalization(str) {
  str = str.toLowerCase();
  return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
        function($1){
            return $1.toUpperCase();
        });
}

/*
# Purpose: Validate Date of Birth.
# @return Boolean (True / False).
*/
export function jsValidateDOB(day , month , year) {
  // let lstDobDay = $('#lstDobDay').val();
  // let lstDobMonth = $('#lstDobMonth').val();
  // let lstDobYear = $('#lstDobYear').val();
  let strDate = day + "/" + month + "/" + year;

  let dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[\/]\d{4}$/;
  // Match the date format through regular expression
  if (strDate.match(dateformat)) {
    //Test which seperator is used '/'
    let opera1 = strDate.split('/');
    let lopera1 = opera1.length;

    // Extract the string into month, date and year
    let pdate = strDate.split('/');

    let dd = parseInt(pdate[0]);
    let mm = parseInt(pdate[1]);
    let yy = parseInt(pdate[2]);

    // Create list of days of a month [assume there is no leap year by default]
    let ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    if (mm == 1 || mm > 2) {
      if (dd > ListofDays[mm - 1]) {
        return false;
      }
    }
    if (mm == 2) {
      let lyear = false;
      if ((!(yy % 4) && yy % 100) || !(yy % 400)) {
        lyear = true;
      }
      if ((lyear == false) && (dd >= 29)) {
        return false;
      }
      if ((lyear == true) && (dd > 29)) {
        return false;
      }
    }
  } else {
    return false;
  }
  return true;
}
