@extends('layouts.splits')
@section('body-class','d-lg-block d-md-block')
@section('title') 
  {{ $data['title'] }}
@endsection
@section('head')
  <link href="{{ $resourcePath }}css/main.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="{{ $resourcePath }}img/favicon.png">
@endsection

@section('content')

  <!-- ========= Header Area Start ========= -->
  <header>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 logo"> <img src="{{ $resourcePath }}img/logo.jpg" alt=""> </div>
        <div class="col-lg-2 d-md-block d-sm-none d-none text-center "> 
          <!-- <img src="dist/img/logocel.png" alt=""> --> 
        </div>
        <div class="col-lg-6 d-md-block d-sm-none d-none text-center">
          <h3>Mercedes Diesel Emission Claim Registration</h3>
        </div>
      </div>
    </div>
  </header>
  <!-- ========= Header Area End ========= --> 


  <!--  ========= FormSection  Area Start  ========= -->

  <section class="bnr_part">
    <div class="container">
      <div id="slide01" class="offset-lg-2 col-lg-8 offest-md-2 col-md-8 col-sm-12 col-12 text-center mp-0">
        <h1 class="animated bounceInDown">Owned, Leased, or Financed a Diesel Mercedes between 2008 - 2019?</h1>
        <h1>You May Be Entitled to £1,000's or more per vehicle!</h1>
      </div>

      
      <div class="offset-lg-3 col-lg-6 offest-md-2 col-md-8 col-sm-12 col-12">
        <div class="form">

          <form name="cust_info" id="cust_info" action="{{ $actionpage }}" method="post" class="pad-lef">
            @csrf
            <input type="hidden" name="visitor_id" id="visitor_id" value="{{$data['intVisitorId']}}" />
            <input type="hidden" name="doAction" id="doAction" value="" />
            <input type = "hidden" name = "ajax-path" id="ajax-path" value="{{ $data['APP_URL'] }}"/> 
            <input type="hidden" name="strFileName" value="{{ $data['strFileName'] }}"/>
            <input type="hidden" name="idntRemember" id="idntRemember" value="0" />
            <input type="hidden" name="carAcquiredDate" id="carAcuquiredDate"/>
            <input type="hidden" name="joined_another_claim" id="joined_another_claim" value="" />

            <!-- slide 1 -->
            <div class="row" id="slide01" style="display:;">
              <div class="animated-arrow d-lg-block d-md-none d-sm-block arrow" id="">
                <img src="{{ $resourcePath }}img/arrow.png" alt="">
              </div>
              <div class="col-lg-12 col-12 p-0">
                <fieldset class="second_step form-section" data-step="2">
                  <div class="col-lg-12 col-12 text-center">
                    <div class="fieldset-inner text-center">
                       <h4 style="font-size:22px; margin: 20px 0 20px !important;" class="d-none d-lg-block">Starting your diesel claims check is easy and 100% online. Select your Mercedes-Benz class<br class="d-none d-lg-block"> below to begin.</h4>
                       <h4 style="font-size:17px; margin: 20px 0 20px !important;" class="d-block d-md-none">Starting your diesel claims check is easy and 100% online. Select your Mercedes-Benz class below to begin.</h4>
                      <div class="row m-0 mb-2 carRegNo_wrap">
                        <div class="offset-lg-1 col-lg-10 col-12 p-0">
                          <select id="vehicle_class" name="vehicle_class" class="crg_num anim_ylw" style="font-weight:400;">
                            @foreach ($data['vehicle_class'] as $key => $value)
                              <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                          </select>
                        </div>
                        <i class="validate" aria-hidden="true" style="display:none;"></i>
                        <i class="validate validate_success" aria-hidden="true" style="display:none;"></i> 
                        <i class="validate validate_error" aria-hidden="true" style="display:none;"></i> 
                        <span id="vehicle_class_err" class="error_msg"></span>
                      </div>
                      <div class="offset-lg-1 col-lg-10 mb-pd text-center" style="margin-bottom: 10px; padding: 0px;"> 
                        <a href="javascript:void(0)" class="btn next001  regNextBtn"><span>Continue >> <br>
                        <img src="{{ $resourcePath }}img/clock.png" alt=""> <i>It only takes a minute</i></span></a>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>

            <div class="row" id="slide6" style="display: none;">
              <div class="form-section text-center">
                <div class="row">
                  <div class="col-lg-12">
                    <h4 style="margin-top:20px;"> Complete our instant eligibility checker to join the claim </h4>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                      <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Vehicle Registrant</legend>
                        <div class=" form-group">
                          <input placeholder="First Name" name="txtFName" id="txtFName" value="" type="text" class="form-control ">
                          <i class="validate" aria-hidden="true" style="display:none;"></i>
                          <span id="fName_err" class="error_msg"></span> 
                        </div>
                        <div class=" form-group">
                          <input placeholder="Last Name" name="txtLName" id="txtLName" value="" type="text" class="form-control ">
                          <i class="validate" aria-hidden="true" style="display:none;"></i>
                          <span id="lName_err" class="error_msg"></span> 
                        </div>
                        <div class="clearfix"></div>
                        <!-- date of birth -->
                        <div class="row">
                          <label class="col-12 text-left">Date of Birth</label>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="form-group">
                              <select name="lstDobDay" id="lstDobDay" class="form-control not_chosen hero-input">
                                <option value="">Day </option>
                                @for($i=1;$i<=31;$i++)
                                  <option value="{{$i}}">{{$i}}</option>
                                @endfor
                              </select>
                              <i class="validate" style="display:none;"></i>
                              <i class="tick fa" style="display:none;"></i>
                              <span id="dobDay_err" class="error_msg"></span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="form-group">
                              <select name="lstDobMonth" id="lstDobMonth" class="form-control not_chosen hero-input">
                                <option value="">Month </option>
                                @foreach ($data['months'] as $key => $value)
                                  <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                              </select>
                              <i class="validate" style="display:none;"></i>
                              <i class="tick fa" style="display:none;"></i>
                              <span id="dobMonth_err" class="error_msg"></span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="form-group">
                              <select name="lstDobYear" id="lstDobYear" class="form-control not_chosen hero-input">
                                <option value="">Year</option>
                                @for($i=2002;$i>=1910;$i--)
                                  <option value="{{$i}}">{{$i}}</option>
                                @endfor                            
                              </select>
                              <i class="validate" style="display:none;"></i>
                              <i class="tick fa" style="display:none;"></i>
                              <span id="dobYear_err" class="error_msg"></span>                              
                            </div>
                          </div>
                          <span id="dob_final_err" class="error_msg"></span> 
                        </div>

                        <div class="input-group mb-3">
                          <label class="col-12 text-left" style="padding-left: 0px;">Postcode</label>
                          <input type="text" class="form-control" id="txtPostCode" name="txtPostCode" placeholder="Enter Your Postcode" style="width: auto">
                          <div class="input-group-append i-g-a">
                            <button class="l-but br-r" type="button" id="postcodevalid">Lookup Address</button>
                          </div>
                          <i class="validate " aria-hidden="true" style="display:none;"></i>
                          <span id="postcode_err" class="error_msg "></span>
                        </div>

                        <div id="currentAddressCollapse" style="display: none;">
                          <div class="form-group">
                            <select name="address1" id="address1" class="form-control animated-effect watermark anim_ylw">
                            </select>
                            <span id="address1_error" class="error_msg"></span>
                            <i class="validate " aria-hidden="true" style="display:none;"></i>
                            <div class="error_msg "></div>
                          </div>
                          <div class=" form-group housedivid" id="housedivid" style="display: none;">
                            <input id="txtHouseNumber" name="txtHouseNumber" value="" type="text" class=" form-control" placeholder=" House Number/Name" readonly>                
                            <i class="validate validate_success" aria-hidden="true" ></i>
                            <span id="addr_err" class="error_msg"></span>
                          </div>
                          <div class=" form-group housedivid" id="strdivid" style="display: none;" >
                            <input id="txtStreet" name="txtStreet" autocomplete="off" type="text" class=" form-control  hero-input" placeholder="Street Address" value="" readonly>
                            <i class="validate validate_success" aria-hidden="true" ></i>
                            <i class="validate success" aria-hidden="true" style="display:none;"></i>
                            <i class="validate error" aria-hidden="true" style="display:none;"></i>
                            <div class="error_msg "></div>
                            <input type="hidden" name="address2" id="address2" value="">
                            <input type="hidden" name="txtHouseName" id="txtHouseName" value="">
                            <input type="hidden" name="txtCounty" id="txtCounty" value="">
                            <input type="hidden" name="txtTown"  id="txtTown" value="">
                            <input type="hidden" name="txtAddress3"  id="txtAddress3" value="">
                            <input type="hidden" name="txtUdprn"  id="txtUdprn" value="">
                            <input type="hidden" name="txtDeliveryPointSuffix"  id="txtDeliveryPointSuffix" value="">
                            <input type="hidden" name="txtPz_mailsort"  id="txtPz_mailsort" value="">
                            <input type="hidden" name="txtCountry"  id="txtCountry" value="">
                          </div>
                          <div class=" form-group housedivid" id="next02divid" style="display: none;" >
                          </div>
                        </div>
                        <!-- Postal Lookup end -->

                        <div class="offset-lg-1 col-lg-10 mb-pd text-center form-group text-center">
                          <input type="button" class="btn regNextBtn mrg-10 next012" id="" value="Continue">
                        </div>
                        <div class="col-lg-12">
                          <div class="progress" style="height:25px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%"> <span class="sr-only">25% Complete</span>
                            </div>
                          </div>
                        </div>
                        <div class="container-fluid  banner-bottom p-0">
                          <div class="col-12 text-center p-0">
                            <h6 style="font-size: 14px; margin-top: 17px;">PERSONAL INFORMATION GUARANTEE</h6>
                          </div>
                          <div class="col-md-12 col-12 text-center p-0"> 
                            <p style="text-align: center;">We do not cold call, spam or pass on your data for marketing</p>
                            <img src="{{ $resourcePath }}img/secure-signs.png" alt="" class="d-lg-none d-md-none d-sm-block d-block">
                          </div>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- slide 2 -->
            <div class="row" id="slide2" style="display:none;">
              <div class="col-lg-12 col-12 p-0">
                <fieldset class="second_step form-section" data-step="2">
                  <div class="col-lg-12 col-12 text-center">
                    <h4 style="margin-top: 20px;">What's the best way to communicate throughout the claims process?</h4>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                      <div class="input-group mb-3 email_wrap">
                        <input type="email" id="txtEmail" name="txtEmail" class="form-control" placeholder="Email Address" style="width:60%;" >
                        <div class="input-group-append">
                          <span class="input-group-text" id="">  <img src="{{ $resourcePath }}img/privacy.png" alt="" class="privacyimg"></span>
                        </div>
                        <!-- error msg -->
                        <i class="validate validnew validate_success" aria-hidden="true" style="display:none;"></i>
                        <i class="validate validnew validate_error" aria-hidden="true" style="display:none;"></i>
                        <i class="validate validnew" aria-hidden="true" style="display:none;"></i>
                        <i class="tick-loader_secured" id="loader-email" style="display:none;">
                        <img src="{{$resourcePath}}img/ajax-loader.gif">
                        </i>
                        <span id="email_err" class="error_msg  " style="display:none"></span>
                      </div>
                      <div class="input-group mb-3 telephone_wrap">
                        <input type="tel" id="txtPhone" name="txtPhone"  class="form-control" placeholder="Mobile Phone Number" style="width:60%;" >
                        <div class="input-group-append">
                          <span class="input-group-text" id="">  <img src="{{ $resourcePath }}img/privacy.png" alt="" class="privacyimg"></span>
                        </div>
                        <i class="validate validnew validate_success val2_11" aria-hidden="true" style="display:none;"></i>
                        <i class="validate validnew validate_error val2_11" aria-hidden="true" style="display:none;"></i>
                        <i class="validate validnew" aria-hidden="true" style="display:none;"></i>
                        <i class="tick-loader_secured" id="loader-phone" style="display:none;">
                        <img src="{{$resourcePath}}img/ajax-loader.gif">
                        </i>
                        <span id="phone_err" class="error_msg"></span>
                        <p class="alert-text">Automated <strong>SMS</strong> are sent to keep you up-to-date throughout the claims process.</p>
                        <!-- error msg next02-->
                      </div>

                      <div class="offset-lg-1 col-lg-10 mb-pd text-center form-group text-center">
                        <input type="submit" class="btn regNextBtn mrg-10" id="Submitbutton_inter" value="Continue">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="progress" style="height:25px;">
                        <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%"> <span class="sr-only">50% Complete</span> </div>
                      </div>
                    </div>
                    <div class="container-fluid  banner-bottom p-0">
                      <div class="col-12 text-center p-0">
                        <h6 style="font-size: 14px; margin-top: 17px;">PERSONAL INFORMATION GUARANTEE</h6>
                      </div>
                      <div class="col-md-12 col-12 text-center p-0"> 
                        <!-- <p><strong>Please note</strong> - you do not need to upload any  documents at this stage </p> -->
                        <p style="text-align: center;">We do not cold call, spam or pass on your data for marketing</p>
                        <img src="{{ $resourcePath }}img/secure-signs.png" alt="" class="d-lg-none d-md-none d-sm-block d-block"> 
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>        


            <div class="row" id="slide3" style="display:none;">
              <div class="col-lg-12 col-12 p-0">
                <fieldset class="second_step form-section" data-step="2">
                  <div class="col-lg-12 col-12 text-center">
                    <div class="fieldset-inner text-center">
                      <h4 style="margin: 16px 0 20px !important;"> Where did you purchase, finance, or lease your vehicle?</h4>
                      <div class="row custom_radio justify-content-center">
                        <div class="mr-25">
                          <input type="radio" class=" want_answer_yes" name="purchase_finance_lease" value="yes" id="named_tenant-eng">
                          <label class="label-text next03" for="named_tenant-eng"><span>England</span> </label>
                        </div>
                        <div class="">
                          <input type="radio" class="want_answer_yes" value="yes" name="purchase_finance_lease" id="named_tenant-wal">
                          <label class="label-text next03" for="named_tenant-wal"><span>Wales</span> </label>
                        </div>
                        <div class="">
                          <input type="radio" class="want_answer_yes" value="no" name="purchase_finance_lease" id="named_tenant-otr" data-toggle="modal" data-target="#diselgroup">
                          <label class="label-text"  for="named_tenant-otr" data-toggle="modal" data-target="#formModal"><span>Other</span> </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="progress" style="height:25px;">
                        <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:75%"> <span class="sr-only">75% Complete</span> </div>
                      </div>
                    </div>
                    <div class="container-fluid  banner-bottom p-0">
                      <div class="col-12 text-center p-0">
                        <h6 style="font-size: 14px; margin-top: 17px;">PERSONAL INFORMATION GUARANTEE</h6>
                      </div>
                      <div class="col-md-12 col-12 text-center p-0"> 
                        <p style="text-align: center;">We do not cold call, spam or pass on your data for marketing</p>
                        <img src="{{ $resourcePath }}img/secure-signs.png" alt="" class="d-lg-none d-md-none d-sm-block d-block">
                      </div>
                    </div>
                  </div>  
                </fieldset>
              </div>
            </div>      

            <div class="row" id="slide4" style="display:none;">
              <div class="col-lg-12 p-0">
                <fieldset class="third_step form-section" data-step="3">
                  <div class="col-lg-12 col-12 text-center"> 
                    <div class="fieldset-inner">
                      <h4 style="margin-top:20px;">Enter your Vehicle details below</h4>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                        <fieldset class="scheduler-border" style="padding-bottom: 10px;">
                          <legend class="scheduler-border">Vehicle Registration</legend>
                          <div class="row m-0 mb-2 carRegNo_wrap">
                            <div class="offset-lg-1 col-lg-10 col-12 p-0">
                              <span class="gb">
                                <img src="{{$resourcePath}}img/gb.png" alt=""><br>
                                    GB
                              </span>
                              <input type="text" class="crg_num" placeholder="e.g.ME12DAR" aria-label="Username" name="carRegNo" id="carRegNo" value="">
                            </div>
                            
                            <i class="validate" aria-hidden="true" style="display:none;"></i>
                            <i class="validate validate_success" aria-hidden="true" style="display:none;"></i>
                            <i class="validate validate_error" aria-hidden="true" style="display:none;"></i>
                            <span id="car_reg_err" class="error_msg"></span>
                          </div>
                          <!-- <p style="margin-bottom: 0px !important; color: #000">Dont have your registration number handy?</p>
                          <input type="button" name="dont_rem" class="btn btn-remember" id="" value="Click Here to SKIP"> -->
                        
                          <!-- <div class="border-b"> -->
                            <div class="custom-control custom-checkbox  text-left" style="margin: 10px;">
                              <input type="checkbox" class="custom-control-input" id="joinanother" name="joinanother">
                              <label class="custom-control-label" for="joinanother" style="font-size:16px;">I have <strong><u>not</u></strong> joined another Mercedes Emissions Claim
                                <span id="join_err" class="chk_error_msg" style="display: none;"></span>
                              </label>
                            </div>
                            <div class="clearfix"></div>
                            <div class="custom-control custom-checkbox  text-left" style="margin: 10px;">
                              <input type="checkbox" class="custom-control-input" id="readagree" name="readagree" value="0">
                              <label class="custom-control-label" for="readagree" style="font-size:16px;"> I agree to join Hausfeld's <strong><u>No Win</u></strong>, <strong><u>No Cost To Me</u></strong> terms below
                                <span id="tick_err" class="chk_error_msg" style="display: none;"></span>
                              </label>
                            </div>
                            <div class="clearfix"></div>
                            <div class="frmbtmcntnt col-12">
                              <div class="bs-example">
                                <div class="accordion" id="accordionExample">
                                  <div class="card">
                                    <div class="card-header" id="headingOne">
                                      <h2 class="mb-0"> <i class="fa fa-plus"></i>
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"> Claims Summary</button>
                                      </h2>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                      <div class="card-body">
                                        <p><u><b>MERCEDES EMISSIONS CLAIMS – SUMMARY OF FUNDING AND ENGAGEMENT DOCUMENTS</b></u> </p>
                                        <p><b>This note sets out a summary for claimants who wish to participate in the group claim against Mercedes represented by Hausfeld and using litigation funding provided by CF BH Ltd, an entity serviced by Black Hammer Capital.</b> </p>
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                        <p>Your claim against Mercedes will be run as part of a group, alongside other claimants’ claims. The claimants have formed a committee to make key decisions in relation to the claims on behalf of the claimant group, including giving instructions to us, Hausfeld, as your lawyers, regarding the running of the claims and any decision on settlement.</p>
                                        <p>The costs of bringing the claims will be paid on your behalf by the litigation funder, who will also take out adverse costs insurance to cover the risks of having to pay the defendant’s costs if the claim does not succeed. In return, the litigation funder is entitled to 40% of your compensation at the end of the case (which will include your liability for our fees and other costs), plus any unrecovered VAT payable on Hausfeld’s conditional fees, which we refer to below as the “Funding Fee”. If you win your claim, you will keep 60% of your compensation less any unrecovered VAT payable on Hausfeld’s conditional fees.</p>
                                        <p>To become a claimant, you must read and sign four legally binding agreements: (i) two engagements with your lawyers, Hausfeld; (ii) a litigation management agreement, which sets out how your claim and other claimants’ claims will be run together; and (iii) a funding participation agreement which says that you understand and agree to adhere to the terms of the funding agreement and the Priorities Agreement. <u> This summary is not a substitute for reading the agreements in detail but it is intended to help you understand what these agreements say.</u> </p>
                                        <p><b>1. YOUR LAWYERS - THE HAUSFELD ENGAGEMENTS</b> </p>
                                        <p>In conjunction with your agreement to the funding agreement, Hausfeld will work for you on the basis that if you don’t win your claim, no fee is required from you. The terms on which Hausfeld are engaged are contained in Hausfeld’s two engagement letters: the first engagement applies when Hausfeld’s fees are being paid in part by the funder; the second engagement will apply when the budget for Hausfeld’s fees under the Funding Agreement has been used up and Hausfeld’s fees are no longer being part-paid by the funder.</p>
                                        <p>Under the first engagement, 55% of Hausfeld’s fees and other litigation costs will be paid by the funder on your behalf, as the litigation progresses. The remaining 45% of Hausfeld’s fees are deferred and will only be due if you win your case, together with a success fee which is the equivalent of 45% of Hausfeld’s fees. Under the second engagement, Hausfeld will work for you with no payment at all unless the claim is successful. On success, the full fees will be payable together with a success fee which is equivalent of 100% of Hausfeld’s fees. You will be notified by the committee at the point at which the budget has been used up and Hausfeld’s second engagement starts to apply.</p>
                                        <p>If you win your case, Hausfeld will recover all or part of your legal fees, including the deferred fees to the extent possible, from Mercedes and these will be paid to Hausfeld, alongside their success fee, from the Funding Fee, which you agree to pay to the funder. Your liability in respect of Hausfeld’s fees and disbursements in the event that your claim is successful is as set out in the Hausfeld engagements. It is capped within the Funding Fee, so that you will receive 60% of the Damages Award (less any unrecovered VAT on Hausfeld’s conditional fees). If you lose your case, you will not have to pay any legal fees provided you have complied with your obligations under the agreements.</p>
                                        <p>The committee will instruct Hausfeld, on your behalf. Invoices for Hausfeld’s non-deferred fees and other litigation costs will be sent to the committee and the committee will be able to approve these on your behalf. In instructing Hausfeld, you agree that you will provide your lawyers with accurate and complete</p>
                                        <p>information about your claim, in a timely manner. Hausfeld will advise you as part of the group of claimants and will only be able to progress your claim once you have completed the registration process and information questionnaire in full. Hausfeld does not have to proceed with your claim if it isn’t appropriate to do so, for example because it does not have sufficient prospects of success, or if it is not suitable to be pursued as part of the group claim (for example due to needing to be issued before the rest of the group or where it might involve different parties which are not common to other claimants) – if this is the case, Hausfeld will inform you as soon as possible. As part of the agreement with the litigation funder, your claim will not be filed until the minimum group size of 27,500 claimants has been met and the funder has put in place the insurance policy to cover adverse costs.</p>
                                        <p>You can cancel your retainer with Hausfeld any time within 14 days of agreeing to the engagement terms. Outside of that 14 day period, you can cancel your retainer at any time but if you do so without Hausfeld’s written permission then you may be charged Hausfeld’s costs, as set out in the engagement letter and any costs incurred on your behalf by the funder as set out below. Hausfeld has the right to cancel their engagement with you if they have a good reason to do so, such as because you have failed to provide all the information required about your claim, and in this scenario you may be charged Hausfeld’s costs insofar as they relate to your claim.</p>
                                        <p><b><u>II RUNNING THE CLAIMS AS A GROUP – THE LITIGATON MANAGEMENT AGREEMENT</u></b> </p>
                                        <P>It would only be viable to bring your claim against Mercedes as part of a group of other claims, given the costs involved in litigation and the efficiencies created by grouping the claims together. It is in your best interests to cooperate with the other claimants represented by Hausfeld. It is also, in Hausfeld’s view, in your best interests to cooperate with a further group of claimants, whose claims are materially similar to the Hausfeld group’s claims and are being run by another law firm, Harcus Parker. Cooperation with the Harcus Parker claimants maximises the efficiencies and other benefits of bringing the claims as a group.</P>
                                        <P>In order for multiple claimants’ claims to be brought as a group, an agreement is needed between claimants as to how to run the claim – this document in the litigation management agreement. This agreement also, sets out how the committee will run your claim on your behalf, how the costs of running the litigation will be shared, governs the co-operation with the Harcus Parker claimants, how decisions on settlement of the claim will be made by the Committee and how the compensation will be divided between claimants in the event of a successful judgment or settlement.</P>
                                        <P>The costs of running the litigation will be met by the litigation funder and recovered from Mercedes if the claims are successful. A high proportion of those costs are expected to be common to all of the claims, including the Harcus Parker claimants. However, some costs may be specific to an issue which affects certain claimants or individual to certain claimants. Your allocation of the costs of bringing the claim will be calculated based on the number of vehicles which you have in the claim, as set out in more detail in the litigation management agreement. These costs will be paid on your behalf and recovered from the defendant and you will only have to pay the Funding Fee provided you do not breach any terms of the agreements.</P>
                                        <P>If damages are obtained via a successful judgment or settlement, the Committee will decide, following the advice of counsel how best to divide up those damages between the claimants. The claimants agree not to accept any settlement offer from Mercedes that does not account for the costs of running the litigation and if any such offer is made and accepted then you will be liable to Hausfeld and to the litigation funder for your costs.</P>
                                        <P>As with Hausfeld’s engagement, you can terminate your participation in the litigation management agreement within 14 days agreeing to its terms. Outside of this 14 day period, you may only terminate your involvement with the permission of the litigation funder and the insurer and if you do so then you may be liable for your share of the litigation costs. If you do not cooperate with reasonable requests from Hausfeld or the litigation funder during the claim, the committee may discontinue your claim and terminate your</P>
                                        <P>participation in the litigation management agreement. Hausfeld will no longer be able to represent you in relation to your claim and the Hausfeld engagement will also be terminated. If your participation in the litigation management agreement ends, your engagement with Hausfeld will be terminated and vice versa.</P>
                                        <P><u><b>lll. THE COSTS OF THE CLAIMS – THE FUNDING PARTICIPATION AGREEMENT</b></u> </P>
                                        <p>The Funding Agreement has been agreed with the Funder by the Chair of the Claimant Committee and in entering into the Funding Participation Agreement, you confirm your agreement to the terms of the Funding Agreement and to the Priorities Agreement.</p>
                                        <p>The Funding Agreement sets out the terms on which the Funder will advance the costs of the litigation on your behalf in accordance with the agreed budget and your agreement to pay the Funding Fee (being 40% of your damages and any unrecovered VAT on our Conditional Fees) if the claims are successful. •The Priorities Agreement explains how the claim proceeds will be allocated which sets out the payment to you of the agreed 60% of your damages aware less any unrecovered VAT on our conditional fees.</p>
                                        <p>The Funding Agreement provides that the projected costs of running the claims of £10,302,553 will be paid on your behalf by the litigation funder. This includes any non- deferred fees paid under the Hausfeld Engagements together with any anticipated disbursement costs and the costs of the insurance, which will cover the Hausfeld and the Harcus Parker claimants against the risk of having to pay Mercedes’ costs. The level of funding available under the funding agreement can be increased during the course of the proceedings by agreement between the committee and the funder if we believe it is reasonably necessary to conclude the claims.</p>
                                        <p>The funding agreement also provides protection to the claimants in the event that their claims are lost. Usually in litigation, the losing party is ordered to pay the winning side’s legal costs – however, in this case, the litigation funder has indemnified you against paying Mercedes’ costs up to £7.5 million on the terms of an insurance policy which it will take out. If you do not agree with the terms of the insurance which the funder obtains, including as to the level of indemnity provided under the insurance, then you will have 14 days from the terms of the insurance being made available to you to cancel your participation in the claims.</p>
                                        <p>There may be some circumstances in which adverse costs will not be covered by the insurance policy, for example where the funder believes it is not viable to continue running the claim and the insurer does not to agree to the claims being discontinued. It is also possible that the insurance may be inadequate in some respect, including due to the level of cover, insurer insolvency or the risk of avoidance, which may result in exposure to adverse costs. However, we believe the risk of these eventualities is low and in this case any liability for adverse costs would be split between all claimants by reference to the number of vehicles for which they claim such that each claimant is only liable for a share.</p>
                                        <p>If the claim is successful, in return for the Funder’s commitment to the claims, you agree to pay the funder the Funding Fee. The Funding Fee comprises 40% of your damages, plus any unrecovered VAT on the portion of legal fees which are contingent upon success, and 100% of all costs which are recovered from the defendants. You will retain 60% of the damages received less any unrecovered VAT on the portion of legal fees which are contingent upon success. The Funding Fee will be used to pay the funder, Hausfeld and counsel their conditional fees, the insurer and the US Consortium.</p>
                                        <p>As part of the agreement with the litigation funder, your claim will not be filed until the minimum group size of 27,500 claimants has been met and the funder has put in place the insurance.</p>
                                        <p>Obligations and warranties: As part of signing up to the action, you agree, via the Funding Participation Agreement, that you will adhere to the terms of the funding agreement. The claimants have obligations under the funding agreement, in particular:</p>
                                        <p>that the information provided to Hausfeld about your claim must be true and accurate and that there is nothing of relevance of which you are aware about your claim which you have failed to disclose to Hausfeld. If any further information about your claim comes to light then you will disclose this to Hausfeld. You also agree that all information which you provide can be shared with the Funder;</p>
                                        <p>that you have had the opportunity to take independent legal advice in relation to your participation in the claims; •that you will comply with the terms of the funder’s insurance once this is put in place, a copy of the terms of which will be made available to you. You will also comply with any steps required by the funder to procure, maintain or claim under the insurance and you will not take any steps which may jeopardise the insurance; •that you will follow the legal advice of Hausfeld and counsel and cooperate with them throughout the proceedings so as to maximise the chances of a successful outcome and minimise any exposure to having to pay the defendants’ costs; •that you agree that if you do not comply with your obligations under the Funding Agreement or if any of the warranties that you have provided are untrue, you may be in breach of the Funding Agreement and liable to pay the Funder your share of the costs the Funder has invested in the claims. You may also share liability for any breach by the claimant committee; and •to follow legal advice and to abide by the terms of the funder’s insurance, and it is important that you follow these obligations and comply with any requests from Hausfeld or the Committee or else you may be in breach of the funding agreement.</p>
                                        <p>Termination: The funder can terminate your participation in the funding agreement if you breach its terms or fail to co-operate with any request from Hausfeld or the Committee to progress the claims where requested to do so. In this scenario you will be liable to pay the Funder your share of the costs the Funder has invested in the claims. The funder may also terminate its funding of the claims if the size of the claimant group does not reach the target of 43,200 claimants, if the claims become commercially unviable or the prospects of success drop below a certain level and/or the Funder cannot obtain the insurance on terms which align with the Priorities Agreement. If the claims have been filed and the funder stops funding the claims because the claimant targets are not met, the funder will cover any exposure you have to Mercedes for paying Mercedes’ costs. However, if the funder stops funding the claims for any other reason and the insurer does not approve of the discontinuance of the claims, you may be exposed to paying to Mercedes your share of their costs. If you wish to withdraw from the claim, you can only do so with the agreement of the Funder and you will be liable to pay the Funder your share of the costs the Funder has invested in the claim.</p>
                                        <p>Under the Litigation Management Agreement, you agree that the Committee has the authority to amend the Funding Agreement and the Priorities Agreement including any increase to the budget, but it may only agree to change the amount of the Funding Fee in circumstances in which it is not otherwise be possible to put in place the insurance and is considered by the Claimant Committee in the claimants’ best interests in order to progress the claims. You understand that if the Committee proposes to change the amount of the Funding Fee, you will have the right within 14 days of notice to elect to cancel your participation in the Funding Agreement, the Priorities Agreement and the claims.</p>
                                        <p>THIS IS ONLY A SUMMARY: it is not a substitute for reading the agreements in full. You must now read each agreement and sign to say that you agree with its terms. You may wish to take independent legal advice on the agreements before entering into them. As set out in the agreements, if you are signing up as a consumer rather than a business then you have a right to cancel your participation in the agreements within 14 days by sending written notice to <a href="#">MercedesEmissionsClaim@hausfeld.com </a>.</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="card-header" id="headingTwo">
                                      <h2 class="mb-0"> <i class="fa fa-plus"></i>
                                        <button type="button" class="btn btn-link collapsed text-left" data-toggle="collapse" data-target="#collapseTwo">Conditional Fee Agreement and Subsequent Conditional Fee Agreement </button>
                                      </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                      <div class="card-body">
                                        <h2>ENGAGEMENT TERMS</h2>
                                        <p><b>INDEX</b> </p>
                                        <ol>
                                          <li><a href="#">Page 1  – Conditional Fee Agreement</a> </li>
                                          <li><a href="#">Page 36 – Subsequent Conditional Fee Agreement</a> </li>
                                        </ol>
                                        <h2>CONDITIONAL FEE AGREEMENT</h2>
                                        <img src="{{ $resourcePath }}img/logo.jpg" alt="">
                                        <p>12 Gough Square <br>
                                          London <br>
                                          EC4A3DW <br>
                                          Direct <br>
                                          44 (0)20 7665 5000 Main <br>
                                          44 (0)20 7665 5001 fax <br>
                                        </p>
                                        <p><b>CONFIDENTIAL</b> </p>
                                        <p>Dear Claimant</p>
                                        <p>Engagement letter: Proposed group claim in relation to Mercedes-Benz emissions</p>
                                        <p class="p11 ft8">Engagement letter: Proposed group claim in relation to Mercedes-Benz emissions</p>
                                        <br>
                                        <br>
                                        <p class="p11 ft11"><span class="ft8">1.</span><span class="ft10">Introduction</span> </p>
                                        <br>
                                        <br>
                                        <p class="p12 ft9"><span class="ft9">1.1.</span><span class="ft12">This letter, together with the enclosed Terms of Business (together the “</span><span class="ft8">Engagement Terms</span>”), set out the terms upon which Hausfeld &amp; Co LLP will provide legal services to you and other claimants in connection with the proposed group claim against Mercedes-Benz and related entities relating to the use of 'defeat devices' in emissions control technology in Mercedes vehicles. In the event of any conflict between this letter and the enclosed Terms of Business, this letter will prevail.</p>
                                        <p class="p13 ft15"><span class="ft9">1.2.</span><span class="ft13">We will provide legal services to you as part of a group of purchasers and lessees of Mercedes- Benz diesel vehicles (together, the “</span><span class="ft14">Hausfeld Claimants</span>” and each individually a “<strong>Claimant</strong>”) in relation to a claim arising from the failure by Daimler AG, Mercedes-Benz Cars UK Limited, Mercedes-Benz Financial Services UK Limited and/or any relevant subsidiary or associated companies, authorised agents or approved dealerships (strong) to comply with obligations in relation to emissions in respect of diesel vehicles supplied to the UK market (the “<strong>Group Claims</strong>” and each Claimant’s individual claim, a “<strong>Claim</strong>”).</p>
                                        <br>
                                        <br>
                                        <p class="p14 ft8">Litigation Management Agreement and Funding Agreement</p>
                                        <br>
                                        <br>
                                        <p class="p15 ft9"><span class="ft9">1.3.</span><span class="ft12">To allow the Group Claims to be pursued on a group basis and for us to represent you as part of the Group Claims, each Claimant also agrees to participate in:</span> </p>
                                        <p class="p16 ft9"><span class="ft9">a)</span><span class="ft16">the </span><span class="ft8">Litigation Management Agreement </span>(the “<strong>LMA</strong>”) - this sets out the terms on which:</p>
                                        <p class="p17 ft19"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft18">you agree that the Group Claims will be managed on behalf of the Claimants to allow the Claims to be pursued on a group basis;</span> </p>
                                        <p class="p18 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">you agree to the appointment of a number of the Claimants to act as a committee (the “</span><span class="ft8">Committee</span>”) who you and other Claimants authorise to take decisions in relation to the Group Claims including the day-to-day running of the Group Claims and decisions as to settlement in accordance with advice from ourselves and other advisors; and</p>
                                        <p class="p18 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">you authorise the Committee to provide instructions on your behalf in relation to the Group Claims and for us to provide updates on progress of the Group Claims to the Committee on your behalf.</span> </p>
                                        <p class="p19 ft9"><span class="ft3">b)</span><span class="ft16">the </span><span class="ft8">Funding Agreement </span>- this sets out the terms on which:</p>
                                        <p class="p20 ft22"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft21">subject to a minimum number of Claimants agreeing to participate in the Group Claims (as set out below) CF BH Claim Ltd, a company serviced by Black Hammer</span> </p>
                                        <p class="p22 ft9">Capital Limited (<a href="http://www.blackhc.com">http://www.blackhc.com</a>) (the “<strong>Funder</strong>”) agrees, subject to the terms of the Funding Agreement, to advance our Discounted Fees (as explained below), our expenses and third party disbursement costs (“<strong>Disbursement Costs</strong>”) of pursuing the Group Claims, in return for a fee as set out at paragraph 8.4(b) below (the “<strong>Funding Fee</strong>”). Subject to the terms of the Funding Agreement, the Funder also agrees to pay adverse costs ordered to be paid to the Defendants if the Group Claims are not successful. The Funder will put in place an insurance policy (the “<strong>Insurance</strong>”) to cover it against such adverse costs.</p>
                                        <p class="p23 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">you instruct us to comply with the terms of the Funding Agreement and fulfil any reporting obligations to the Funder on your behalf under an instruction letter sent to us by the Committee and with which we have undertaken to comply.</span> </p>
                                        <p class="p24 ft9"><span class="ft9">1.4.</span><span class="ft12">Under the Funding Agreement, the Funder acknowledges that we will provide our advice to you and other Claimants and take decisions in relation to the Group Claims in the best interests of the Claimants at all times, without any influence or control from the Funder.</span> </p>
                                        <p class="p25 ft9"><span class="ft9">1.5.</span><span class="ft12">These Engagement Terms will apply for the work which we carry out for you in accordance with the budget provided under the Funding Agreement where our Discounted Fees will be paid on your behalf by the Funder (as set out at paragraph 6 below). To allow for the possibility that the budget for our fees might be exceeded and we were not able to agree an increase with the Funder or any alternate funding arrangement, we have set out in a separate engagement letter the revised terms on which we would continue to work for you from that point on a fully deferred basis in order to conclude the work on the Claims (the “</span><span class="ft8">Subsequent Engagement Terms</span>”).</p>
                                        <br>
                                        <br>
                                        <p class="p26 ft11">Agreement to participate in Group Claims</p>
                                        <br>
                                        <br>
                                        <p class="p27 ft9"><span class="ft9">1.6.</span><span class="ft12">You acknowledge and agree in accepting these Engagement Terms:</span> </p>
                                        <p class="p28 ft9"><span class="ft3">(a)</span><span class="ft23">that you wish to participate in the Group Claims and participate in the LMA and the Funding Agreement, and you acknowledge that we are not able to advise Hausfeld Claimants on an individual basis;</span> </p>
                                        <p class="p29 ft15"><span class="ft3">(b)</span><span class="ft24">that we will only be able to proceed with your Claim once you have: (i) completed the registration process confirming your agreement to these Engagement Terms, the Funding Agreement and the LMA; </span><span class="ft14">and </span>(ii) fully completed the information questionnaire providing the details required to pursue your Claim;</p>
                                        <p class="p30 ft9"><span class="ft3">(c)</span><span class="ft25">that we will review the viability of your Claim together with claims of other Hausfeld Claimants and whether they are suitable to be brought as part of the Group Claims and have no obligation to proceed with your Claim if we do not think it is appropriate to do so;</span> </p>
                                        <p class="p28 ft9"><span class="ft3">(d)</span><span class="ft20">that we will not pursue and issue proceedings in relation to the Group Claims until the minimum claimant group size of 27,500 Claimants has been met under the Funding Agreement so that the costs will be advanced on your behalf and the Funder has confirmed that it has put in place the Insurance to cover its exposure under the Adverse Costs Cover, which covers you against Adverse Costs (each as defined below); and</span> </p>
                                        <p class="p32 ft15"><span class="ft3">(e)</span><span class="ft24">the Funder reserves the right to terminate the Funding Agreement if the Claimant group reaches 27,500 but does not reach 43,200 Claimants within eighteen months after the first payment is made under the Funding Agreement, but the Funder will cover you for the costs incurred or for which you could be liable up to that point.</span> </p>
                                        <br>
                                        <p class="p24 ft9"><span class="ft9">1.7.</span><span class="ft12">Under the provisions of the LMA, we will update the Committee, as your representative, as to the progress of the Group Claims. We will agree with the Committee the work required and anticipated timescales as matters progress and obtain the Committee’s instructions as required, in accordance with the terms of the LMA. You acknowledge the need to fully complete the information questionnaire and to provide us and the Committee with accurate and complete information in a timely manner when requested and the need to co-operate and keep us and the Committee informed of any developments relevant to our representation of you in relation to the Claim.</span> </p>
                                        <p class="p25 ft9"><span class="ft9">1.8.</span><span class="ft12">The Engagement Terms take effect from the date which you agree to them, save that under the LMA and these Engagement Terms you agree also to be liable for your share of any fees and disbursements which have been incurred in relation to any work which is common to you and other Claimants since the date on which we started work on the Group Claims on 1 March 2020. Our Discounted Fees and Disbursement Costs are covered by the Funding Agreement, as explained further below.</span> </p>
                                        <p class="p25 ft9"><span class="ft9">1.9.</span><span class="ft12">In the event of any conflict between these Engagement Terms, the terms of the LMA or the terms of the Funding Agreement, the Funding Agreement will take precedence with the exception of any regulatory requirements in respect of which the Engagement Terms will apply. Insofar as they are consistent with the Funding Agreement, these Engagement Terms will take precedence over the LMA.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p26 ft11"><span class="ft8">2.</span><span class="ft10">Scope of our Engagement</span> </p>
                                        <p class="p33 ft9"><span class="ft9">2.1.</span><span class="ft12">You agree that we will act for you in the Group Claims and will provide you and other Claimants with legal and strategic advice in relation to the Group Claims, working with Counsel, experts and other third-party advisors where appropriate to:</span> </p>
                                        <p class="p34 ft9"><span class="ft3">a)</span><span class="ft26">investigate and advise you (via the Committee) on the merits and viability of the Group Claims, whether and on what basis they can be pursued and whether your Claim can be included;</span> </p>
                                        <p class="p35 ft9"><span class="ft3">b)</span><span class="ft27">formulate a settlement strategy;</span> </p>
                                        <p class="p36 ft9"><span class="ft9">c)</span><span class="ft28">issue proceedings where necessary once the minimum number of Claimants has been met under the Funding Agreement and the Funder has confirmed that the Insurance is in place;</span> </p>
                                        <p class="p37 ft9"><span class="ft3">d)</span><span class="ft27">to liaise with the Committee to update them and take instructions in relation to the day to day running of the Group Claims;</span> </p>
                                        <p class="p38 ft15"><span class="ft3">e)</span><span class="ft29">to keep under review any opportunity to try and settle the Group Claims and to liaise with the Committee regarding the making or receipt of any settlement offers received; and</span> </p>
                                        <p class="p37 ft9"><span class="ft3">f)</span><span class="ft30">to generally represent you and other Claimants in respect of the Group Claims as agreed with the Committee from time to time.</span> </p>
                                        <p class="p39 ft15"><span class="ft9">2.2.</span><span class="ft13">In entering into these Engagement Terms, you acknowledge that we are not under an obligation to file your Claim and continue to act on these Engagement Terms if we do not think it is appropriate to do so within the Group Claims. In particular, we are entitled not to proceed</span> </p>
                                        <p class="p40 ft9">with your Claim and to terminate the Engagement Terms if:</p>
                                        <p class="p41 ft9"><span class="ft9">a)</span><span class="ft31">we do not think it has sufficient prospects of success;</span> </p>
                                        <p class="p42 ft9"><span class="ft3">b)</span><span class="ft31">we do not think it can reasonably be pursued as part of the Group Claims, due to a limitation deadline or otherwise, or that only some causes of action can be pursued as part of the Group Claims;</span> </p>
                                        <p class="p43 ft9"><span class="ft9">c)</span><span class="ft32">you do not co-operate with us in providing the information needed to pursue your Claim or do not do so in the required timetable; or</span> </p>
                                        <p class="p42 ft9"><span class="ft3">d)</span><span class="ft31">if we are unable, pursuant to paragraph 1.5(d) above, to meet the minimum Claimant group size required under the Funding Agreement or the Funder has not put in place the Insurance.</span> </p>
                                        <p class="p44 ft19"><span class="ft9">2.3.</span><span class="ft33">If we subsequently decide that we are not able to pursue your Claim on these Engagement Terms, we will inform you as soon as reasonably practicable.</span> </p>
                                        <p class="p45 ft9"><span class="ft9">2.4.</span><span class="ft34">Unless otherwise agreed, our advice will relate to the matters set out in paragraph 2.1 above in connection with the Group Claims only and be limited to English law. We will not provide any foreign law, economic, financial or accounting advice nor will we be responsible for any non-legal matters. We will, however, assist you in retaining third party advisors to obtain such advice and liaise with them as required.</span> </p>
                                        <p class="p46 ft36"><span class="ft9">2.5.</span><span class="ft35">Unless as expressly set out in these Engagement Terms, our advice is provided only to the Claimants and should not be relied on by any third party. It should be treated as confidential and privileged and not shared with any third party without our written consent.</span> </p>
                                        <p class="p47 ft9"><span class="ft9">2.6.</span><span class="ft12">We are regulated by the Solicitors Regulation Authority (SRA) and are bound by the SRA Code of Conduct 2019. Further information can be obtained from the SRA’s website: </span><span class="ft37"><a href="www.sra.org.uk">www.sra.org.uk</a> </span>.</p>
                                        <br>
                                        <br>
                                        <p class="p26 ft11"><span class="ft8">3.</span><span class="ft10">Our Team</span> </p>
                                        <p class="p24 ft9"><span class="ft9">3.1.</span><span class="ft12">Nicola Boyle will be the partner responsible for the overall supervision of the Group Claims and you should feel free to contact her at any time. She will involve additional members of our team with the appropriate experience and expertise as required to assist with the matter under my supervision.</span> </p>
                                        <p class="p39 ft15"><span class="ft9">3.2.</span><span class="ft13">Nicola will be assisted in the first instance by the following members of our team, whose details and hourly rates (excluding VAT) are set out below. The below rates are referred to as our Base Fees. We will involve additional members of our team as required whose hourly rate will be calculated in accordance with their status/band as set out in the table below. Please note that the hourly rates indicated are subject to change annually on 1</span><span class="ft38">st </span>January of each year and we will notify the Committee of any changes and agree these with the Committee.</p>
                                        <div class="table-responsive">
                                          <table cellpadding="0" cellspacing="0" class="table table-condensed">
                                            <thead>
                                              <tr>
                                                <td class="tr3 td3"><p class="p48 ft8">Status/band</p></td>
                                                <td class="tr3 td4"><p class="p49 ft8">Rate (excluding VAT) (£)</p></td>
                                                <td class="tr3 td5"><p class="p49 ft8">Current team members</p></td>
                                                <td class="tr3 td6"><p class="p49 ft8">Rate (excluding VAT) (£)</p></td>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td class="tr4 td7"><p class="p48 ft9">Partner</p></td>
                                                <td class="tr4 td8"><p class="p49 ft9">650 per hour</p></td>
                                                <td class="tr4 td9"><p class="p49 ft9">Anthony Maton, Nicola Boyle</p></td>
                                                <td class="tr4 td10"><p class="p49 ft9">650 per hour</p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr5 td7"><p class="p48 ft39">Counsel</p></td>
                                                <td class="tr5 td8"><p class="p49 ft39">525-575 per hour</p></td>
                                                <td class="tr5 td9"><p class="p49 ft39">Lucy Rigby</p></td>
                                                <td class="tr5 td10"><p class="p49 ft39">525 per hour</p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr4 td7"><p class="p48 ft9">Senior Associate</p></td>
                                                <td class="tr4 td8"><p class="p49 ft9">425-475 per hour</p></td>
                                                <td class="tr4 td9"><p class="p49 ft9">Duran Ross</p></td>
                                                <td class="tr4 td10"><p class="p49 ft9">450 per hour</p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr5 td7"><p class="p48 ft39">Associate</p></td>
                                                <td class="tr5 td8"><p class="p49 ft39">300-400 per hour</p></td>
                                                <td class="tr5 td9"><p class="p49 ft39">Edward Nyman</p></td>
                                                <td class="tr5 td10"><p class="p49 ft39">345 per hour</p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr4 td7"><p class="p48 ft9">Trainee Solicitor</p></td>
                                                <td class="tr4 td8"><p class="p49 ft9">225 per hour</p></td>
                                                <td class="tr4 td9"><p class="p49 ft9">Andrew Pickard</p></td>
                                                <td class="tr4 td10"><p class="p49 ft9">225 per hour</p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr5 td7"><p class="p48 ft39">Intern/Paralegal</p></td>
                                                <td class="tr5 td8"><p class="p49 ft39">175 per hour</p></td>
                                                <td class="tr5 td9"><p class="p49 ft39">Various</p></td>
                                                <td class="tr5 td10"><p class="p49 ft39">175 per hour</p></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                        <p class="p4 ft11"><span class="ft8">4.</span><span class="ft10">Cooperation with other claimant groups</span> </p>
                                        <p class="p24 ft9"><span class="ft9">4.1.</span><span class="ft12">In order to progress the Group Claims as effectively and efficiently as possible, you agree that it may be in your best interests to co-operate with other claimant groups, whose claims are materially similar to the Group Claims and which are brought by other law firms and where the court may expect you to do so.</span> </p>
                                        <p class="p39 ft15"><span class="ft9">4.2.</span><span class="ft13">The Funder has also agreed to fund claimants with similar claims who instruct the separate law firm, Harcus Parker Limited (“</span><span class="ft14">Harcus Parker</span>” and Harcus Parker’s claimants being the “<strong>HP Claimants</strong>”). To allow us to co-operate with Harcus Parker and to share costs of any work which is common between the Hausfeld Claimants and the HP Claimants, we have entered into a co-operation agreement with Harcus Parker (the “<strong>Cooperation Agreement</strong>”), which will allow the Group Claims and the claims of the HP Claimants to be brought more efficiently and for some categories of costs common to all claims to be shared. In entering into these Engagement Terms, you expressly agree that you will share costs in accordance with the Co- operation Agreement and the LMA and you authorise us to: (i) comply with the terms of the Cooperation Agreement on your behalf; and (ii) to work with Harcus Parker in relation to work which is common to all claimants where we believe it is in your best interests to do so.</p>
                                        <br>
                                        <br>
                                        <p class="p51 ft11"><span class="ft8">5.</span><span class="ft10">Estimate of costs and Claim Funding</span> </p>
                                        <p class="p24 ft9"><span class="ft9">5.1.</span><span class="ft12">The fees and Disbursement Costs required to pursue the Group Claims will depend on a number of factors including the willingness of the Defendants to engage in a settlement dialogue to try and resolve the Claims, the timetable which is set and directions given by the Court and the extent of issues and applications that are raised which require separate hearings prior to trial and any appeals.</span> </p>
                                        <p class="p52 ft9"><span class="ft9">5.2.</span><span class="ft12">The claim funding under the Funding Agreement (the “</span><span class="ft8">Claim Funding</span>”) has been agreed with the Funder based on a current best estimate of the fees and Disbursement Costs to pursue the Group Claims to trial, should it prove necessary to do so and allowing for the sharing of certain common Disbursement Costs with the HP Claimants. This is based on a total figure of £10,302,553, comprising approximately £2.1 million (including VAT) of our Discounted Fees, counsel fees of £2.9 million (representing 80% of senior and junior counsel’s fees as 20% of counsel’s fees are deferred and payable only if the action is successful, plus costs counsel’s fees), Insurance costs of £1.04 million (including Insurance Premium Tax) and approximately £4.26 million of other Disbursement Costs. These figures reflect the current budget agreed with the Funder but may be amended with the Funder’s agreement in the course of the litigation. You will not be responsible to the Funder for the HP Claimants’ proportionate share of the common Disbursement Costs.</p>
                                        <p class="p25 ft9"><span class="ft9">5.3.</span><span class="ft12">We will update the Committee should we believe this estimate to be materially changed at any stage and review with the Committee whether additional funding may be needed and whether the costs and associated risks of the Claim are still proportionate to the potential outcome.</span> </p>
                                        <p class="p24 ft9"><span class="ft9">5.4.</span><span class="ft12">As set out above, if the budget for our Discounted Fees has been exceeded and we are not able to agree any increase with the Funder or any alternate Funding, but we agree to continue the work for you on a fully deferred basis in order to conclude the work on the Claims, we will notify the Committee that we will do so under the terms of the second engagement letter, the Subsequent Engagement Terms</span><span class="ft8">.</span> </p>
                                        <p class="p54 ft9"><span class="ft9">5.5.</span><span class="ft12">We set out below the basis on which our fees and disbursements will be payable and allocated between you and other Claimants. Each Claimant’s share of the costs will depend on the number of Claimants which choose to instruct Hausfeld, and the degree of successful cooperation with other claimant groups with whom costs may also be shared. We will update the Committee as matters progress.</span> </p>
                                        <p class="p55 ft9"><span class="ft9">5.6.</span><span class="ft12">Under and subject to the terms of the Funding Agreement, any fees and Disbursement Costs within the agreed Claim Funding which you are liable to pay:</span> </p>
                                        <p class="p56 ft9"><span class="ft3">a)</span><span class="ft28">will be advanced by the Funder on your behalf pending the conclusion of your Claim;</span> </p>
                                        <p class="p36 ft9"><span class="ft3">b)</span><span class="ft27">will not be liable to be repaid to the Funder if your Claim does not succeed unless you terminate these Engagement Terms and the Funding Agreement prior to the conclusion of the Group Claims without our agreement and the agreement of the Funder, or if you breach the terms of the Funding Agreement, in which case the cost consequences under Clause 17.5 of the Funding Agreement and the provisions under paragraph 10.5 relating to Early Termination will apply; and</span> </p>
                                        <p class="p57 ft9"><span class="ft9">c)</span><span class="ft28">may be recoverable from the Defendants on your behalf where your Claim succeeds. If our fees and Disbursement Costs are not recovered from the Defendants, or not recovered in full, then the unrecovered fees and Disbursements Costs will be paid from the Funding Fee which you agree to pay.</span> </p>
                                        <p class="p25 ft19"><span class="ft9">5.7.</span><span class="ft33">Although our fees and Disbursements Costs within the agreed Claim Funding are being advanced on your behalf by the Funder, you remain ultimately liable for all our fees and Disbursements Costs.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p58 ft42"><span class="ft8">6.</span><span class="ft40">Our Fees, Expenses and Disbursements </span> <br>
                                          <span class="ft41">Our Fees</span> </p>
                                        <p class="p47 ft9"><span class="ft9">6.1.</span><span class="ft12">You agree that we will act for you under a discounted Conditional Fee Agreement subject to and in accordance with the terms of section 58 of the Courts and Legal Services Act 1990, whereby:</span> </p>
                                        <p class="p59 ft19"><span class="ft9">a)</span><span class="ft43">55% of our Base Fees (together with VAT) are payable whether or not the claim succeeds (the “</span><span class="ft44">Discounted Fees</span>”).</p>
                                        <p class="p41 ft9"><span class="ft3">b)</span><span class="ft27">If your Claim is successful, then you will also be liable to pay:</span> </p>
                                        <p class="p60 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">the remaining 45% of our Base Fees (together with VAT) (the “</span><span class="ft8">Deferred Base Fees</span>”); and</p>
                                        <p class="p61 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">a success fee, being 45% of our Base Fees (together with VAT) (the “</span><span class="ft8">Success Fee</span>”). The Success Fee is payable in addition to the Discounted Fees and the Deferred Base Fees in the event of success.</p>
                                        <p class="p62 ft9"><span class="ft9">c)</span><span class="ft28">If the Claim is not successful, you will not have to pay the Deferred Base Fees or the Success Fee save as set out in paragraph 10 below. You will have to pay the Discounted Fees, but the amounts of these will be advanced by the Funder on your behalf up to the budget referred to in Clause 5.2 and you will not need to repay to the Funder any amounts it has paid on your behalf if the Claim is not successful, subject to the terms of the Funding Agreement.</span> </p>
                                        <p class="p54 ft19"><span class="ft9">6.2.</span><span class="ft33">Our Base Fees will be calculated based on the time we spend on the Claims at our hourly rates set out in paragraph 3.2 above or as otherwise amended and notified to the Committee from time to time, together with VAT, if applicable.</span> </p>
                                        <p class="p64 ft15"><span class="ft9">6.3.</span><span class="ft13">To the extent that our fees exceed the agreed budget under the Funding Agreement and no amendment to level of funding for our fees is agreed with the Funder, or alternative funding agreed, if we agree to continue the work for you we will notify the Committee that we will do so under the terms of the second engagement letter, the Subsequent Engagement Terms.</span> </p>
                                        <p class="p46 ft15"><span class="ft9">6.4.</span><span class="ft13">Your Claim will be “successful” for the purposes of these Engagement Terms if by final judgment or earlier settlement you recover or obtain the right to recover money or costs (whether Common, Individual or Issue Costs), and/or you in any way derive financial gain as a result of your Claim. If you win on any interim application, hearing or issue (including preliminary issues) and costs are ordered to be paid by the Defendant(s), then we will be entitled to recover from you our Base Fees in full of the relevant application, hearing or issue and, if your Claim goes on to succeed, our Success Fee. Paragraphs 8.1 – 8.3 below will also apply to the time incurred by us in connection with that interim application, hearing or issue.</span> </p>
                                        <p class="p65 ft9"><span class="ft9">6.5.</span><span class="ft12">The level of the Success Fee has been determined taking into account:</span> </p>
                                        <p class="p66 ft9"><span class="ft9">a)</span><span class="ft45">the fact that it could take several years to negotiate a successful settlement of the Group Claims or to obtain a judgment allowing us to recover our fees;</span> </p>
                                        <p class="p67 ft19"><span class="ft3">b)</span><span class="ft46">the resources of the Defendants and the likelihood that they will vigorously defend the Group Claims;</span> </p>
                                        <p class="p68 ft9"><span class="ft9">c)</span><span class="ft47">the relative complexity of the Group Claims, the fact that they involve details of the emissions control and other technology used in Mercedes vehicles, the details of which are not in the public domain and which are subject to ongoing investigations by regulatory authorities and/or their decisions subject to court appeals;</span> </p>
                                        <p class="p69 ft19"><span class="ft3">d)</span><span class="ft46">the likelihood that the Group Claims could involve some novel issues on the causes of action which can be pursued by Claimants which have not yet been determined by the courts;</span> </p>
                                        <p class="p70 ft15"><span class="ft3">e)</span><span class="ft48">the fact that the Group Claims will also revolve around expert analysis on the emissions control technology and the evaluation of the loss to Claimants which has not yet been completed at this stage, will depend on disclosure of information by the Defendants and may remain open to differing interpretations and be heavily disputed by defendants;</span> </p>
                                        <p class="p66 ft9"><span class="ft3">f)</span><span class="ft12">the risk that if the Claim is not successful we will not recover our Deferred Base Fees; and</span> </p>
                                        <p class="p71 ft36"><span class="ft3">g)</span><span class="ft49">the risk that the costs which we are due under these Engagement Terms may exceed the amount that we receive pursuant to our commitment under the Priorities Agreement to cap what we receive at 40% of your share of the proceeds of any overall settlement or judgment award, as determined by reference to any offer from the Defendants or otherwise by the Committee in its discretion (the “</span><span class="ft50">Damages Award</span>”).</p>
                                        <p class="p72 ft51">Payment of third-party disbursements and expenses</p>
                                        <p class="p74 ft9"><span class="ft9">6.6.</span><span class="ft12">Whether or not the Group Claims are successful, you will also be liable for any expenses which we reasonably incur on your behalf in relation to the Group Claims such as court filing fees, courier charges, travel and hotels, translation costs and taxi fares. We will charge these expenses at cost, together with any applicable VAT. We may also charge for any significant photocopying that we may undertake in relation to the Group Claims. These are Disbursement Costs and will be advanced on your behalf by the Funder under and subject to the terms of the Funding Agreement.</span> </p>
                                        <p class="p75 ft9"><span class="ft9">6.7.</span><span class="ft12">You will also be liable to pay the costs of any third-party service providers required for the purposes of the Group Claims, such as forensic accountants, economists, barristers or data analysts (all such costs being Disbursement Costs). Where possible, if the Committee wishes to do so, we will seek to agree that Disbursement Costs are payable on a contingent or deferred basis (as appropriate) so that they only become due for payment by you at the conclusion of the Group Claim. Where this is not possible (such as in the case of expert witnesses) or third-party providers are not prepared to defer fees, you will be liable to fund Disbursement Costs as they fall due, together with VAT as appropriate.</span> </p>
                                        <p class="p76 ft15"><span class="ft9">6.8.</span><span class="ft13">Although the Funder will advance the Disbursement Costs on your behalf in accordance with the Funding Agreement, you will remain ultimately liable for our expenses and disbursements (including expenses and disbursements which the Funder is not liable for or does not pay). If the Claim fails then, unless you have breached the Funding Agreement, you will not be obliged to reimburse the Funder for any Disbursement Costs it has paid on your behalf.</span> </p>
                                        <p class="p77 ft51">Sharing of common costs</p>
                                        <p class="p78 ft15"><span class="ft9">6.9.</span><span class="ft13">Where our costs are common to you and other Claimants, these will be shared across the Claimants as further set out at section 7 below. We also explain how costs and disbursements will be shared with the HP Claimants when such work is common to the HP Claimants.</span> </p>
                                        <p class="p79 ft51">Billing</p>
                                        <p class="p76 ft15"><span class="ft9">6.10.</span><span class="ft24">Pursuant to the terms of the Funding Agreement, the Funder will advance our Discounted Fees and the Disbursement Costs on your behalf up to the value of the Claim Funding under the Funding Agreement. We will send interim bills for the Discounted Fees and Disbursement Costs incurred on behalf of you and other Claimants to the Committee for approval on behalf of the Claimants on a monthly basis, or periodically at such other intervals as separately agreed with the Committee and the Funder will meet these costs on an ongoing basis.</span> </p>
                                        <p class="p80 ft9"><span class="ft9">6.11.</span><span class="ft20">The invoices will be due for payment in accordance with paragraph 7 of our Terms of Business (attached in Schedule Three).</span> </p>
                                        <br>
                                        <br>
                                        <p class="p26 ft11"><span class="ft8">7.</span><span class="ft52">Sharing and allocation of costs with other Claimants</span> </p>
                                        <br>
                                        <p class="p81 ft51">Sharing of costs between the Hausfeld Claimants</p>
                                        <p class="p82 ft15"><span class="ft9">7.1.</span><span class="ft53">As you are participating in a group claim, under the terms of the LMA, you agree that the costs comprising our fees and Disbursement Costs, associated with the common elements of the Claims (the “</span><span class="ft14">Common Costs</span>”) will be shared between you and other Hausfeld Claimants in accordance with the LMA. Not all costs will be Common Costs: some will be unique to individual Claimants (“<strong>Individual Costs</strong>”); and some will apply to specific issues affecting some Claimants (“<strong>Issue Costs</strong>”), but it is anticipated that the majority of our fees and Disbursement</p>
                                        <p class="p84 ft19">Costs that are incurred on the Claim will be Common Costs or Issue Costs which will apply to the majority of the Claimants. Common Costs, Individual Costs and Issue Costs will all be covered by the Funding Agreement (subject to its terms).</p>
                                        <p class="p85 ft9"><span class="ft9">7.2.</span><span class="ft54">As set out in the LMA, you agree that, unless the court orders otherwise (in which case you shall be liable in accordance with the terms of the court order):</span> </p>
                                        <p class="p86 ft9"><span class="ft9">7.2.1</span><span class="ft32">we will allocate to you, as appropriate, any Individual Costs, together with a share of the Common Costs and Issue Costs, calculated as follows:</span> </p>
                                        <p class="p87 ft19"><span class="ft9">a)</span><span class="ft55">the amount of Costs referable to you in relation to Common Costs and Issue Costs shall be calculated on a several (not joint) liability basis as follows:</span> </p>
                                        <p class="p88 ft9"><span class="ft3">i.</span><span class="ft56">for the purposes of Common Costs in accordance with the number of vehicles in respect of which you are claiming as a percentage of the number of vehicles in respect of which all the Hausfeld Claimants claim; and</span> </p>
                                        <p class="p89 ft9"><span class="ft3">ii.</span><span class="ft57">in the case of Issue Costs, in accordance with the number of vehicles in respect of which you are claiming as a percentage of the number of vehicles in respect of which all the Hausfeld Claimants affected by that issue claim;</span> </p>
                                        <p class="p90 ft15"><span class="ft3">iii.</span><span class="ft58">and additionally in either i. and/or ii. immediately above, each Hausfeld Claimant who obtains an order for any Defendant to pay that Claimant’s Common and/or Issue Costs shall also be liable to indemnify the share of the Common and/or Issue Costs of any other Hausfeld Claimant who does not obtain such an order (the liability for such indemnity being only to the extent that the Common Costs of such unsuccessful Hausfeld Claimant are recovered from a Defendant, and the liability for such indemnity is calculated on a several basis in the same proportions between the successful Hausfeld Claimants alone as in a) or b) respectively, as may be the case, immediately above).</span> </p>
                                        <p class="p91 ft9">in each case (your “<strong>Proportionate Share</strong>”);</p>
                                        <p class="p92 ft9"><span class="ft9">7.2.2</span><span class="ft59">we are entitled to allocate to you a Proportionate Share of all work undertaken in respect of Common Costs and any relevant Issue Costs, from the date we first started to work on the Claims from 1 March 2020;</span> </p>
                                        <p class="p93 ft51">Sharing of common costs with Harcus Parker Claimants</p>
                                        <p class="p94 ft9"><span class="ft9">7.3</span><span class="ft60">Save where the court orders otherwise, where it is agreed that common work will be carried out by Hausfeld on behalf of and/or to the benefit of the Hausfeld Claimants and the Harcus Parker Claimants jointly, you agree that the associated fees for such work shall be charged to the Hausfeld Claimants in full under the terms of this agreement and allocated in accordance with Clause 7.2 above; and where such common work carried out by Harcus Parker on behalf of and/or to the benefit of the Harcus Parker Claimants and the Hausfeld Claimants jointly, then the associated fees for such work shall not be charged to the Hausfeld Claimants but to the Harcus Parker Claimants.</span> </p>
                                        <p class="p95 ft9"><span class="ft9">7.4</span><span class="ft60">Where there are common disbursements incurred either by us or Harcus Parker but for the</span> </p>
                                        <p class="p97 ft9">benefit of yourself, the other Hausfeld Claimants and the Harcus Parker Claimants jointly (“<strong>Common Disbursements</strong>”), then you agree that, in the event that your Claim is successful, you will be liable for your Proportionate Share of the Common Disbursements but as a Proportionate Share of all the Hausfeld Claimants and Harcus Parker Claimants together as a whole, rather than just of the Hausfeld Claimants alone.</p>
                                        <p class="p24 ft9"><span class="ft9">7.5</span><span class="ft60">If there are other groups of claimants bringing similar claims to the Group Claims and we believe it sensible to co-operate with them on common work and/or are ordered by the court to do so, you agree that we can do so and to put in place similar co-operation arrangements with their respective solicitors where agreed with the Committee in accordance with the terms of the LMA.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p26 ft8">8 Costs position on successful outcome to your Claim</p>
                                        <p class="p98 ft9"><span class="ft9">8.1</span><span class="ft61">Pursuant to Clause 6.1 of the LMA, if your Claim is successful, you will receive your Damages Award.</span> </p>
                                        <p class="p55 ft9"><span class="ft9">8.2</span><span class="ft60">If your Claim is successful, you will be liable for and we will seek to recover from the Defendants on your behalf, to the fullest extent possible:</span> </p>
                                        <p class="p99 ft9"><span class="ft9">a)</span><span class="ft16">our Base Fees (i.e. the Discounted Fees and the Deferred Base Fees);</span> </p>
                                        <p class="p40 ft9"><span class="ft3">b)</span><span class="ft62">any expenses and disbursements that we have incurred in pursuing your Claim; and</span> </p>
                                        <p class="p100 ft19"><span class="ft9">c)</span><span class="ft63">(if applicable) any VAT which you or the Funder have had to pay on our fees or the expenses and disbursements which you are not able to recover.</span> </p>
                                        <p class="p101 ft9">You agree that any costs recovered from the Defendants will be paid in accordance with the terms of the Funding Agreement.</p>
                                        <p class="p24 ft9"><span class="ft9">8.3</span><span class="ft60">Subject to the provisions of paragraph 8.4 below, you will remain liable to pay the balance of our fees, expenses and disbursements (including your Proportionate Share of the Common Disbursements), comprising:</span> </p>
                                        <p class="p102 ft9"><span class="ft9">a)</span><span class="ft20">any balance of our Base Fees which are not recovered from the Defendants, together with the Success Fee. The Success Fee is not recoverable from the Defendants and will therefore need to be paid in full by you;</span> </p>
                                        <p class="p103 ft9"><span class="ft3">b)</span><span class="ft20">the balance of any expenses or disbursements incurred on your behalf which are not recovered in full from the Defendants; and</span> </p>
                                        <p class="p104 ft9"><span class="ft9">c)</span><span class="ft23">any VAT element or our fees or disbursements which we are required to charge (if appropriate) and which cannot be recovered from the Defendants where you are able to reclaim the VAT;</span> </p>
                                        <p class="p105 ft9"><span class="ft3">d)</span><span class="ft20">for the avoidance of doubt, unless you breach these Engagement Terms and/or the Funding Agreement, your net liability (after recovery of any costs and/or disbursements from the Defendants) to pay us costs and disbursements under these Engagement Terms cannot in any circumstances exceed the Funding Fee as set out under paragraph 8.4(b) below.</span> </p>
                                        <p class="p44 ft9"><span class="ft9">8.4</span><span class="ft61">Your liability for any unrecovered costs under paragraph 8.3 will be covered by the terms of the Funding Agreement under which you agree that:</span> </p>
                                        <p class="p106 ft9"><span class="ft9">a)</span><span class="ft34">you will receive 60% of the Damages Award (less any unrecovered VAT on our Conditional Fees, as defined in Clause 1 of the Funding Agreement); and</span> </p>
                                        <p class="p108 ft9"><span class="ft3">b)</span><span class="ft34">40% of the Damages Award (plus any unrecovered VAT on our Conditional Fees) and 100% of any recovered costs will be payable to the Funder to reimburse the Funder for its outlay, cover the Funder’s fee and pay any other outstanding sums to the insurer, us, counsel and the US Consortium as set out in the Funding Agreement.</span> </p>
                                        <p class="p109 ft9">As per Clause 2.2 of the Funding Agreement and Clause 3.2 of the Priorities Agreement, unless you terminate or breach these Engagement Terms and/or the Funding Agreement, your liability for the purposes of paragraph 8.3 and 8.4 above is limited to the cap of the Funding Fee.</p>
                                        <p class="p25 ft9"><span class="ft9">8.5</span><span class="ft60">In the event that our fees, disbursements and expenses cannot be agreed with the Defendants and it is necessary to undergo a detailed costs assessment in order to recover the costs, the provisions of this paragraph 8 will, subject to the terms of the Funding Agreement, also apply in respect of that detailed costs assessment.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p27 ft11"><span class="ft8">9</span><span class="ft64">Costs position on unsuccessful outcome to your Claim</span> </p>
                                        <p class="p39 ft15"><span class="ft9">9.1</span><span class="ft65">If your Claim is unsuccessful, you will not be liable to pay our Deferred Base Fees or the Success Fee save in the exceptional circumstances where our engagement is terminated prior to the conclusion of the Claim set out in paragraph 10 below but we will retain the Discounted Fees that have already been paid or were due to be paid by the Funder up to the date of the unsuccessful outcome. The Funder also agrees under Clause 2.3 of the Funding Agreement that you will not be obliged to pay back any of the disbursements or expenses (including the Common Disbursements) which have been advanced by the Funder if your Claim is not successful save where you terminate or breach the provisions of the Funding Agreement.</span> </p>
                                        <p class="p45 ft19"><span class="ft9">9.2</span><span class="ft66">You may also be liable to pay your share of the Defendants’ costs under the loser pays rule in English litigation. The general rule in English litigation is that the unsuccessful party will have to pay the costs of the successful party (the “</span><span class="ft44">Adverse Costs</span>”):</p>
                                        <p class="p110 ft9"><span class="ft9">a)</span><span class="ft34">This is subject to the discretion of the court in any particular case and any award of costs may depend on factors such as the extent to which the case was successful, the conduct of the parties and the level and timing of any settlement offers;</span> </p>
                                        <p class="p111 ft9"><span class="ft3">b)</span><span class="ft34">In any hearing lasting less than one day, the court may determine the award of costs at the hearing by way of summary assessment and make an order that costs be paid within 14 days or another specified period;</span> </p>
                                        <p class="p111 ft9"><span class="ft9">c)</span><span class="ft59">Subject to this, costs will otherwise normally be dealt with at the conclusion of the matter in separate proceedings known as “detailed assessment” in which the court will assess in detail the level of costs payment unless this can otherwise be negotiated and agreed between the parties;</span> </p>
                                        <p class="p111 ft9"><span class="ft3">d)</span><span class="ft34">In both summary and detailed assessment, the successful party will only typically recover between 40% to 70% of its costs, save in certain exceptional cases where a reasonable settlement offer has been refused or there has been any misconduct in the litigation;</span> </p>
                                        <p class="p108 ft9"><span class="ft3">e)</span><span class="ft34">In cases where costs budgets have been served and approved by the Court, the unsuccessful party will normally be ordered to pay the successful party’s costs in full to the extent these correspond to the court-approved budget filed by the successful party and those costs will not normally be subject to detailed assessment; and</span> </p>
                                        <p class="p112 ft9"><span class="ft3">f)</span><span class="ft61">A party may only recover any VAT element of its fees and disbursements where it is not able to recover this cost in the course of its business.</span> </p>
                                        <p class="p54 ft9"><span class="ft9">9.3</span><span class="ft60">We believe a reasonable estimate of the Adverse Costs which may be awarded to the Defendants if the matter were to proceed to trial could be in the region of £7.5m for the combined claims of the Claimants and the HP Claimants. We will update the Committee if we believe this materially changes at any stage.</span> </p>
                                        <p class="p27 ft9"><span class="ft9">9.4</span><span class="ft60">To cover this estimate of the Adverse Costs to the Defendants if all or part of your Claim failed:</span> </p>
                                        <p class="p114 ft9"><span class="ft9">a)</span><span class="ft34">The Funder agrees under the Funding Agreement to pay the Adverse Costs to be paid by the Claimants together with the HP Claimants up to a total value of £7.5 million (the “</span><span class="ft8">Adverse Costs Cover</span>”), subject to the terms of the Funding Agreement. The Funder will cover its exposure under the Adverse Costs Cover with insurance (the “<strong>Funder’s Insurance</strong>”);</p>
                                        <p class="p111 ft9"><span class="ft3">b)</span><span class="ft34">The Claimants acknowledge and agree under LMA that the Adverse Costs Cover and Funder’s Insurance cover all of the Claimants and the HP Claimants (some of whom may have different bases of claim, such as fraud or contract). Where some of the claims fail and others succeed, the insurer may have a right to claim back any Adverse Costs which have been paid out for unsuccessful claims. It is anticipated that it will be possible to obtain insurance on terms that this will be taken from the Funding Fee relating to the successful Claimants’ recovery. If it is not possible to limit the insurer’s recovery to the Funding Fee, you will be informed of this and you will have 14 days from the point of being notified of the insurance terms to cancel your participation in the Group Claims; and</span> </p>
                                        <p class="p111 ft9"><span class="ft9">c)</span><span class="ft59">You and other Claimants also agree under Clause 11.3 of the LMA that the liability for Adverse Costs should be split between the Claimants so that you are individually liable only for your individual share of the Adverse Costs by reference to the number of vehicles for which you claim as a proportion of the total number of vehicles claimed by the Claimants and the HP Claimants in the event that the Funder’s Insurance or the cross-indemnity did not prove sufficient to cover or otherwise to meet the Adverse Costs in full.</span> </p>
                                        <p class="p55 ft9"><span class="ft9">9.5</span><span class="ft60">For the purposes of the Funder’s Insurance, in agreeing to adhere to the terms of the Funding Agreement, you also agree to:</span> </p>
                                        <p class="p115 ft9"><span class="ft9">a)</span><span class="ft16">comply with the terms of the Funder’s Insurance as provided to the Committee which are either: (a) covered under the Funding Agreement including the obligation to ensure that the information which you provide in relation to the Claim is true and accurate to the best of your knowledge and belief; b) as subsequently notified to you; or c) which we can undertake on our behalf, such as providing updates in relation to the Claim;</span> </p>
                                        <p class="p116 ft9"><span class="ft3">b)</span><span class="ft16">comply promptly with any step required by the Funder in order to procure, maintain or claim under any Insurance;</span> </p>
                                        <p class="p40 ft9"><span class="ft9">c)</span><span class="ft62">cooperate in providing any more information required in relation to the Claim; and</span> </p>
                                        <p class="p117 ft19"><span class="ft3">d)</span><span class="ft67">n</span>ot take or omit to take any step which might potentially lead to withdrawal, avoidance or cancellation of cover under the Insurance unless advised to do so by us and Counsel.</p>
                                        <br>
                                        <br>
                                        <p class="p51 ft11"><span class="ft8">10</span><span class="ft68">Costs associated with early termination</span> </p>
                                        <p class="p27 ft9"><span class="ft9">10.1</span><span class="ft45">In the event that:</span> </p>
                                        <p class="p118 ft9"><span class="ft3">a)</span><span class="ft69">you elect to discontinue your Claim or terminate the Engagement Terms (pursuant to</span> </p>
                                        <p class="p119 ft9">paragraph 14.4 below) or the LMA before a judgment or settlement has been obtained in the Claim entitling us to recover our fees and any Disbursement Costs without our prior written agreement that it is sensible to do so; or</p>
                                        <p class="p120 ft9"><span class="ft3">b)</span><span class="ft70">we terminate the Engagement Terms (pursuant to paragraph 14.5 below) due to a failure by you to provide us with adequate and timely instructions or information required, or where you otherwise fail to meet your obligations under these Engagement Terms or the LMA;</span> </p>
                                        <p class="p109 ft9">we shall be entitled to recover from you our Base Costs, including your Proportionate Share of the Common Costs and Issue Costs, plus all Individual Costs, as appropriate, incurred on your behalf up until the date of such termination or discontinuance and for any work which is reasonably required to conclude these Engagement Terms and the termination of your involvement in the Group Claims, unless we agree with you to waive these fees in whole or part.</p>
                                        <p class="p25 ft9"><span class="ft9">10.2</span><span class="ft71">You will also be liable under Clause 17.5 of the Funding Agreement to repay to the Funder your proportionate share of the fees and costs which it has paid or is liable to pay on your behalf in relation to the Claim up to the date of termination.</span> </p>
                                        <p class="p24 ft9"><span class="ft9">10.3</span><span class="ft71">If, having terminated these Engagement Terms, you go on to secure a successful outcome in your Claim, whether by negotiated settlement or judgment, we also reserve the right to require you to pay the Success Fee on our Base Costs for all time spent on your Claim up to the date of termination of these Engagement Terms and including any subsequent work required to conclude these Engagement Terms.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p26 ft11"><span class="ft9">11</span><span class="ft72">Conflicts</span> </p>
                                        <p class="p24 ft9"><span class="ft9">11.1</span><span class="ft71">We have undertaken a search of the Defendants on our conflicts database and, we have no conflict in pursuing the Group Claims against the Defendants. We are also not aware of any conflict in advising on any individual Claim. We will, however, keep this under review, and advise you promptly if we identify any conflict of interest that we believe may prevent us from advising you in relation to the Claim and discuss it with you.</span> </p>
                                        <p class="p25 ft9"><span class="ft9">11.2</span><span class="ft71">In signing these Engagement Terms, you agree to us acting for other Claimants in relation to the Group Claims. You also agree that in the event of settlement of your Claim in whole or part, we will not be required as a term of the settlement to waive our right to act for other claimants or future claimants in relation to similar claims.</span> </p>
                                        <p class="p24 ft9"><span class="ft9">11.3</span><span class="ft71">We will only agree to act for additional claimants in relation to similar claims where we do not perceive there to be any conflict of interest which would prevent us from doing so. In the event that we later identify any conflict of interest between you on the one hand and any other claimants on the other which may prevent us from continuing to act, we will raise and discuss this with you. If this arises, we will, if appropriate, seek to put in place information barriers to protect confidential client information. Where this is not possible, we may need to cease acting for you.</span> </p>
                                        <p class="p46 ft15"><span class="ft9">11.4</span><span class="ft73">You acknowledge and agree that in the context of acting for other claimants to represent them in relation to claims which are similar to your claim, we may obtain disclosure of documents and/or information, some of which may be advantageous or disadvantageous to you. We seek the agreement of each Claimant to share this information under the terms of the LMA, but you acknowledge that there may be circumstances in which we may be prevented from</span> </p>
                                        <p class="p122 ft19">communicating information received in relation to the claims of other Claimants to you either in whole or in part.</p>
                                        <p class="p123 ft9"><span class="ft9">11.5</span><span class="ft71">You acknowledge that we are engaged in an international practice in which we represent clients in a number of different practice areas and across multiple business sectors. You acknowledge that our agreement to act on your behalf pursuant to these Engagement Terms does not prevent us from acting for other clients (whether an existing client or a future client) in any factually unrelated matter even if adverse to you (or any parent, subsidiary or affiliate) so long as such representation involves a factually unrelated matter and would not adversely impact our duty of confidentiality to you.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p124 ft11"><span class="ft9">12</span><span class="ft72">Confidential information</span> </p>
                                        <p class="p78 ft15"><span class="ft74">12.1</span><span class="ft75">Pursuant to the terms of the LMA, you agree that the facts of your Claim and any documents produced by you or to you through disclosure can be disclosed on a common interest basis to the other Claimants, Harcus Parker, the HP Claimants, the Funder and the Committee in so far as we consider it necessary or helpful to compare the facts of individual Claims for the purposes of advising on and conducting the common aspects of the Claimants’ Claims.</span> </p>
                                        <p class="p125 ft9"><span class="ft74">12.2</span><span class="ft25">You also agree to disclose the facts and terms of any offer to settle any of the Claims made to them by the Defendants to Hausfeld and to the Committee. Hausfeld and the Committee may then disclose that information to other Claimants unless specifically prevented from doing so under the terms of the offer.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p126 ft11"><span class="ft9">13</span><span class="ft72">Disclosure of documents and data preservation</span> </p>
                                        <p class="p127 ft9"><span class="ft9">13.1</span><span class="ft54">If proceedings are issued and the Claims progress, you will be required to disclose documents which are relevant to the Claim to the Defendants and their advisers (which must be treated as confidential and used only for the purposes of the proceedings). This is likely to include all documents on which you wish to rely or which may be relevant to the issues in the dispute, whether or not they support or undermine your position. It is also likely to include documents (in hard copy or electronic format) which are in your possession or control and which you have the right to take possession or copies. We have tried to anticipate the information which may be needed in the Information Questionnaire which we ask you to complete. Please identify to us if there are other documents or information which is relevant to your Claim. We will liaise with you in due course on any additional information requests and how best to protect any confidential information and withhold from inspection any documents protected by legal privilege.</span> </p>
                                        <p class="p128 ft15"><span class="ft9">13.2</span><span class="ft53">In the meantime, as a potential claim is contemplated, you are obliged under English court rules to preserve all documents which may be relevant to the Claim. This includes both hard copy documents (such as letters, contracts, invoices and other paper documents) and electronic documents (including emails, text messages and voicemail, word processed documents and databases and documents stored on portable devices and other electronic forms). </span><span class="ft76">This is a key obligation which the court will require that you and/or the Committee confirm that you/it has complied with in due course and failure to do so may prejudice your Claim.</span> You should therefore take steps to safeguard all documentation relevant to the Claim, including those that would otherwise be deleted in the ordinary course of business and the postponement of any routine data destruction policies that would otherwise apply.</p>
                                        <br>
                                        <br>
                                        <p class="p130 ft79"><span class="ft8">14</span><span class="ft77">Cancellation and Termination </span> <br>
                                          <span class="ft78">Right of Cancellation for Consumers</span> </p>
                                        <p class="p131 ft9"><span class="ft9">14.1</span><span class="ft71">If you are contracting with us as a consumer, you have a right to cancel this agreement within 14 days from the date of agreement of these Engagement Terms with no liability for our fees. If you wish to do so, please complete and return the notice to us which is appended in the annex after the signature page to these Engagement Terms or email us at MercedesEmissionsClaim@hausfeld.com.</span> </p>
                                        <p class="p132 ft15"><span class="ft9">14.2</span><span class="ft73">You may request that we begin work on your claim during the cancellation period. If you would like us to do so then please confirm those instructions by signing and returning the Authority to Commence Work form in Schedule Two. This contains important further information about the consequences of requesting us to perform work during the cancellation period, including its effect on your right to cancel and your liability for our fees.</span> </p>
                                        <p class="p133 ft9"><span class="ft9">14.3</span><span class="ft71">If you requested us to begin the performance of services during the cancellation period, you shall pay us an amount which is in proportion to what has been performed until you have communicated to us your cancellation from this contract, in comparison with the full coverage of the contract.</span> </p>
                                        <p class="p134 ft51">Your right to terminate</p>
                                        <p class="p135 ft19"><span class="ft9">14.4</span><span class="ft80">You can terminate these Engagement Terms at any time on reasonable notice. The costs consequences as set out in Clause 14.6 may apply.</span> </p>
                                        <p class="p136 ft51">Our right to terminate</p>
                                        <p class="p137 ft9"><span class="ft9">14.5</span><span class="ft71">We may terminate these Engagement Terms on reasonable notice at any time before a final outcome is reached in the Claim if we have a good reason to do so. This includes, for example, the matters set out in paragraph 2.2 above, circumstances in which you fail to provide us with documentation or information which is important to your Claim, a failure by you to provide us with adequate and timely instructions or where you otherwise fail to meet your obligations under or ask us to act contrary to these Engagement Terms, the Funding Agreement or the LMA. Under paragraph 16.4 of the LMA, you also agree that the Committee has a right to instruct us to discontinue your Claim where you fail to co-operate and/or obstruct the progress of your Claim and/or the Group Claims.</span> </p>
                                        <p class="p134 ft51">Cost consequences of termination</p>
                                        <p class="p24 ft9"><span class="ft9">14.6</span><span class="ft71">Where these Engagement Terms are terminated by you (other than in the case of cancellation under Schedule One within 14 days) or by us in circumstances due to a breach by you of these Engagement Terms or failure to co-operate you will be liable, then:</span> </p>
                                        <p class="p138 ft9"><span class="ft3">a)</span><span class="ft20">You are liable to pay our Base Fees incurred up to the date of termination in full, together with a Success Fee should your Claim later be successful as set out in paragraph 10 above. You will also be liable to pay our expenses and disbursements incurred on your behalf up to the date of termination.</span> </p>
                                        <p class="p140 ft9"><span class="ft3">b)</span><span class="ft26">As the Funder would have paid our Discounted Fees and Disbursement Costs:</span> </p>
                                        <p class="p141 ft19"><span class="ft3">(i)</span><span class="ft81">You will repay the amounts paid by the Funder to the Funder pursuant to Clause 17.5 of the Funding Agreement; and</span> </p>
                                        <p class="p142 ft9"><span class="ft3">(ii)</span><span class="ft28">You will pay the remainder to us.</span> </p>
                                        <p class="p143 ft51">Terms surviving termination</p>
                                        <p class="p144 ft9"><span class="ft9">14.7</span><span class="ft54">Paragraphs 10 and 11 of this letter and clauses 4, 5, 7, 11, 12, 14 and 20 of the enclosed Terms of Business will survive termination of the Engagement Terms.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p26 ft11"><span class="ft8">15</span><span class="ft82">Client care and complaints</span> </p>
                                        <p class="p145 ft9"><span class="ft9">15.1</span><span class="ft54">We are committed to providing a high-quality legal service to all our clients. If you are not satisfied with any aspect of our service, including in relation to our bill, please let us know so that we can try to resolve any complaints at the earliest opportunity. We have a procedure in place which sets out how we handle complaints which is available upon request. If there are any causes for concern, please contact Anthony Maton, as the firm’s Client Care Partner, who will acknowledge receipt, send you a copy of our Complaints Handling Policy and set out how we propose to deal with the complaint.</span> </p>
                                        <p class="p146 ft15"><span class="ft9">15.2</span><span class="ft53">If for any reason we are unable to resolve the problem between us, you may wish to refer the matter to the complaints and redress scheme provided by the Solicitors Regulation Authority. If your complaint relates to the firm’s invoices, you may have a right to object to the invoice by applying to the court for assessment of the bill under Part III of the Solicitors Act 1974. You must make any such application within one month of delivery of the invoice.</span> </p>
                                        <p class="p147 ft15"><span class="ft9">15.3</span><span class="ft53">If we are unable to satisfactorily resolve your complaint within 8 weeks of receipt, you also have the right to ask the Legal Ombudsman to consider it. Details for the Legal Ombudsman and the complaints process can be found at </span><span class="ft83"><a href="www.legalombudsman.org.uk">www.legalombudsman.org.uk</a></span>, who can be contacted by email at <span class="ft83"><a href="mailto:enquiries@legalombudsman.org.uk">enquiries@legalombudsman.org.uk</a></span>, by post to Legal Ombudsman, P.O. Box 6806, Wolverhampton, WV1 9WJ, or by telephone on 0300 555 0333 or +44 121 245 3050 if calling from overseas. You must refer its complaint to the Legal Ombudsman: (a) no later than 6 months from the conclusion of our response to the complaint; <span class="ft76">and</span> (b) no later than six years from the act/omission or three years from when you should reasonably have known there was cause for complaint, whichever is the earlier.</p>
                                        <br>
                                        <br>
                                        <p class="p148 ft11"><span class="ft8">16</span><span class="ft72">Confidentiality</span> </p>
                                        <p class="p149 ft9">This letter should be treated as confidential as between us and you, save that it may be required to be disclosed in the course of litigation to the Defendants and/or the Court for the purposes of recovering our costs at the conclusion of the Claim.</p>
                                        <p class="p150 ft19">We look forward to working with you. If you have any questions regarding this letter or the enclosed Terms of Business, please let me know.</p>
                                        <br>
                                        <br>
                                        <p class="p4 ft9">Yours sincerely</p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p class="p2 ft9">Anthony Maton</p>
                                        <p class="p2 ft9">Partner</p>
                                        <p class="p2 ft3">For and on behalf of Hausfeld &amp; Co LLP</p>
                                        <br>
                                        <br>
                                        <p class="p2 ft9"> <br>
                                          <br>
                                          <br>
                                          <br>
                                          Nicola Boyle</p>
                                        <p class="p2 ft9">Partner</p>
                                        <p class="p2 ft3">For and on behalf of Hausfeld &amp; Co. LLP</p>
                                        <br>
                                        <br>
                                        <p class="p2 ft9">Encl.</p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p class="p152 ft9">I agree to the terms of this retainer</p>
                                        <span class="ft8">………………………………………………………………………………………………………………</span>
                                        <p class="p154 ft9">Claimant</p>
                                        <span class="ft8">Date……………………………………………………………………………………………………</span>
                                        <p class="p156 ft84" style="text-align:center">Schedule One - Notice of the Right to Cancel</p>
                                        <br>
                                        <br>
                                        <p class="p157 ft85">If you are an individual, you have the right to cancel our engagement within 14 days of agreeing to our engagement terms without giving any reason for doing so.</p>
                                        <br>
                                        <br>
                                        <p class="p158 ft9">If you wish to exercise your right to cancel, please notify us <strong class="ft8">in writing </strong>and delivering it personally or sending it by post or by e-mail to the contact and address below. The notice must be sent within 14 days of your agreement to our engagement terms and is deemed served as soon as it is posted or sent to us. You may use the form below but are not required to do so.</p>
                                        <br>
                                        <br>
                                        <p class="p65 ft9">Nicola Boyle (Mercedes Emissions Claim)</p>
                                        <p class="p159 ft9">Hausfeld &amp; Co. LLP, 12 Gough Square, London, EC4A3DW</p>
                                        <p class="p159 ft9">Email: MercedesEmissionsClaim@hausfeld.com</p>
                                        <br>
                                        <br>
                                        <div class="table-responsive noborder">
                                          <table cellpadding="0" cellspacing="0" class="table table-condensed">
                                            <tbody>
                                              <tr>
                                                <td class="tr9 td13"><p class="p2 ft9">Signed on behalf of Hausfeld &amp; Co. LLP:</p></td>
                                                <td class="tr9 td14"><p class="p2 ft9">…………..….………………………………………………</p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr10 td13"><p class="p2 ft9">Name/Position:</p></td>
                                                <td class="tr10 td14"><p class="p2 ft9">…………..………………………………………………….</p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr10 td13"><p class="p2 ft9">Date:</p></td>
                                                <td class="tr10 td14"><p class="p2 ft86">…………..………………………………....................</p></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                        <p class="p160 ft8">……………………………………………………………………………………………………………………………………………</p>
                                        <br>
                                        <br>
                                        <p class="p161 ft9">Complete, detach and return this form within 14 days of receipt ONLY IF YOU WISH TO CANCEL THE CONTRACT</p>
                                        <p class="p26 ft9">To: Nicola Boyle of Hausfeld &amp; Co. LLP, 12 Gough Square, London, EC4A 3DW</p>
                                        <p class="p4 ft9">Email: MercedesEmissionsClaim@hausfeld.com</p>
                                        <p class="p4 ft9">Case Reference No: Mercedes Emissions Claim</p>
                                        <p class="p27 ft9">I hereby give notice that I wish to cancel the Engagement Terms with your firm.</p>
                                        <div class="table-responsive noborder">
                                          <table cellpadding="0" cellspacing="0" class="trr">
                                            <tbody>
                                              <tr>
                                                <td class="tr9 td13"><p class="p2 ft9">Signed:</p></td>
                                                <td class="tr9 td14"><p class="p2 ft9">
                                                    <input type="text" size="30">
                                                  </p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr8 td13"><p class="p2 ft9">Name (please print):</p></td>
                                                <td class="tr8 td14"><p class="p2 ft9">
                                                    <input type="text" size="30">
                                                  </p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr10 td13"><p class="p2 ft9">Address:</p></td>
                                                <td class="tr10 td14"><p class="p2 ft9">
                                                    <input type="text" size="30">
                                                  </p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr10 td13"><p class="p2 ft2">&nbsp;</p></td>
                                                <td class="tr10 td14"><p class="p2 ft9">
                                                    <input type="text" size="30">
                                                  </p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr10 td13"><p class="p2 ft9">Date:</p></td>
                                                <td class="tr10 td14"><p class="p2 ft9">
                                                    <input type="text" size="30">
                                                  </p></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                        <p class="p163 ft8" style="text-align:center">Schedule Two</p>
                                        <p class="p164 ft8" style="text-align:center">Authority to Commence Work</p>
                                        <br>
                                        <br>
                                        <p class="p65 ft9">To: Nicola Boyle of Hausfeld &amp; Co. LLP, 12 Gough Square, London, EC4A 3DW</p>
                                        <p class="p159 ft9">Email: MercedesEmissionsClaim@hausfeld.com</p>
                                        <p class="p159 ft9">Case Reference No: Mercedes Emissions Claim</p>
                                        <br>
                                        <br>
                                        <p class="p165 ft9">I understand that I have a right to cancel the Engagement Terms within 14 days of the date of receipt of a notice of the right to cancel.</p>
                                        <p class="p166 ft19">I wish you to commence work under the Engagement Terms before the expiration of the cancellation period.</p>
                                        <br>
                                        <br>
                                        <p class="p167 ft9">I understand that if I subsequently cancel these Engagement Terms within the cancellation period I will be under a duty to pay in accordance with the reasonable requirements of the cancelled contract for work undertaken prior to the cancellation.</p>
                                        <div class="table-responsive noborder">
                                          <table cellpadding="0" cellspacing="0" class="trr">
                                            <tbody>
                                              <tr>
                                                <td class="tr9 td13"><p class="p2 ft9">Signed:</p></td>
                                                <td class="tr9 td14"><p class="p2 ft9">
                                                    <input type="text" size="30">
                                                  </p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr10 td13"><p class="p2 ft9">Name (please print):</p></td>
                                                <td class="tr10 td14"><p class="p2 ft9">
                                                    <input type="text" size="30">
                                                  </p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr10 td13"><p class="p2 ft9">Address:</p></td>
                                                <td class="tr10 td14"><p class="p2 ft9">
                                                    <input type="text" size="30">
                                                  </p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr10 td13"><p class="p2 ft2">&nbsp;</p></td>
                                                <td class="tr10 td14"><p class="p2 ft9">
                                                    <input type="text" size="30">
                                                  </p></td>
                                              </tr>
                                              <tr>
                                                <td class="tr8 td13"><p class="p2 ft9">Date:</p></td>
                                                <td class="tr8 td14"><p class="p2 ft9">
                                                    <input type="text" size="30">
                                                  </p></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                        <br>
                                        <br>
                                        <p class="p169 ft8" style="text-align:center">Schedule Three</p>
                                        <p class="p170 ft8" style="text-align:center">Standard Terms of Business for Hausfeld &amp; Co. LLP</p>
                                        <br>
                                        <br>
                                        <p class="p171 ft9">Hausfeld &amp; Co LLP (“<strong>H&amp;Co</strong>”) is a Limited Liability Partnership registered under the laws of the State of New York and with its head offices at 12 Gough Square, London, EC4A 3DW, and with representational offices in Brussels and Paris. It is a multinational partnership between Solicitors of the Supreme Court of England and Wales and Registered Foreign Lawyers and is regulated by the Solicitors Regulation Authority of England and Wales under Registration No. 513826. It is registered for VAT purposes with VAT registration number GB 975 248776. H&amp;Co is registered in the Data Protection Register of the UK Information Commissioner’s Office under registration number Z1953172. It is associated with Hausfeld LLP, which has offices in Washington DC, Boston, Philadelphia, New York and San Francisco, to Hausfeld Rechtsanwälte LLP, which has offices in Berlin and Düsseldorf and to Hausfeld Advocaten which has its offices in Amsterdam.</p>
                                        <br>
                                        <br>
                                        <p class="p172 ft9"><span class="ft9">1)</span><span class="ft87">These terms: </span>These terms (our "<span class="ft8">Terms of Business</span>") apply to all the work we do for you unless we agree otherwise in our Engagement Letter and until we give you written notice of a change to them. It may be necessary to amend these Terms and Conditions of Business from time to time. We will notify you of any such proposed changes and unless we hear from you to the contrary within 14 days following such notification, the amendments and/or new terms will come into effect from the end of that period. If there is any inconsistency between these Terms of Business and the terms of our Engagement Letter (and any Appendix), the Engagement Letter will prevail. You will be considered to have accepted these Terms of Business and the Engagement Letter if you instruct us or accept advice from us after receiving them. In these Terms of Business, our Engagement Letter and any other written communication from us, any reference to a "Partner" means a member of H&amp;Co, or an employee or consultant who is a lawyer with equivalent standing and qualification.</p>
                                        <br>
                                        <br>
                                        <p class="p173 ft9"><span class="ft9">2)</span><span class="ft87">Our advice and third parties: </span>Our advice is given on the basis of our experience and understanding of current law, rules and regulations as at the date it is given. From the date of termination of our engagement, we are not obliged to update any advice we had previously given. Our advice is provided solely for the purposes of the engagement and solely to you, our client. Without our prior written consent, our advice may not be used for any other purpose, or disclosed to any person other than your employees or agents who normally have access to your papers and records and your other professional advisers (on terms that they will not make further disclosure). You will not quote or refer to us or our advice in any public document or communication without our prior written consent. Our duty of care is to you as our client and does not extend to third parties. No third party shall have any right to rely on or enforce any term of our agreement with you under the Contracts (Rights of Third Parties) Act 1999 or otherwise, save for Partners and employees of H&amp;Co for the purposes of the limitation of liability as explained in Clause 4 below.</p>
                                        <br>
                                        <br>
                                        <p class="p174 ft8"><span class="ft9">3)</span><span class="ft87">Instructions to foreign lawyers and other professional advisors: </span><span class="ft9">Where the matter may require advice from a foreign law firm or other professional advisers (including expert witnesses, accountants, tax advisors, PR agencies or other third party professional advisors), you agree that unless otherwise agreed with you, we will instruct such advisors on your behalf and as your agent and that they will be responsible to you for the quality and accuracy of the advice they provide. Before making any such appointment on your behalf, we will consult with you and seek your agreement to the appointment.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p26 ft8"><span class="ft9">4)</span><span class="ft87">Limitation of Liability</span><span class="ft9">:</span> </p>
                                        <p class="p176 ft9"><span class="ft9">4.1</span><span class="ft25">The aggregate liability of all H&amp;Co Persons (meaning H&amp;Co and all of its Partners and employees) in contract, tort, under statute or otherwise, for any losses, damages, costs or expenses suffered or incurred by you arising from or in connection with this engagement, however caused, including by our negligence (but not by our fraud, fraudulent misrepresentation or the reckless disregard of our professional obligations) shall be limited to the sum of £3 million. We will not be liable for any consequential, special, indirect or exemplary damages, costs or losses attributable to lost profits or opportunities.</span> </p>
                                        <p class="p177 ft9"><span class="ft9">4.2</span><span class="ft25">H&amp;Co, with your agreement, accepts the benefit of the terms set out in this Agreement as agent and trustee for each H&amp;Co Person referred to above. Any claim (whether in contract, tort, under statue or otherwise) shall be brought only against H&amp;Co and no claim shall be made against any Partner, employee of or consultant to H&amp;Co. Each such Partner, employee and consultant shall be entitled to enforce and to have the benefit of this provision under the Contracts (Rights of Third Parties) Act 1999.</span> </p>
                                        <p class="p178 ft9"><span class="ft9">4.3</span><span class="ft25">The provisions of this Clause 4 shall not operate to exclude any liability which may not be excluded by any applicable law or by the rules of the Solicitors Regulatory Authority or any other competent authority. In accordance with the Solicitors’ Indemnity Insurance Rules, and the disclosure requirements of the Provision of Services Regulations 2009, H&amp;Co’s compulsory professional indemnity insurer is Endurance Worldwide Insurance Limited (Policy Number PI18END1826).</span> </p>
                                        <p class="p179 ft9"><span class="ft9">4.4</span><span class="ft25">Where any H&amp;Co Person and any third party such as another professional adviser are jointly and severally liable to you in respect of any loss, liability or cost suffered by you in connection with the engagement (a “Loss”), the extent to which such Loss shall be recoverable by you from H&amp;Co shall be limited in proportion to the H&amp;Co Person’s contribution to the overall fault for such Loss. For the purposes of assessing the contribution to the Loss, you agree that no account shall be taken of any limit imposed or agreed on the amount of liability of such third party by any agreement made before or after such Loss was incurred save with our written consent.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p173 ft9"><span class="ft9">5)</span><span class="ft87">IP rights: </span>Except as provided to the contrary by law, by the rules of the Solicitors Regulation Authority or any other competent authority, all intellectual property rights and documentation that we create or develop during the course of an engagement shall be our own absolute property.</p>
                                        <br>
                                        <br>
                                        <p class="p180 ft9"><span class="ft9">6)</span><span class="ft87">Electronic Communication: </span>We will communicate with and send documents to you and others by e-mail unless you tell us that you do not wish to do so or require any particular categories of documents to be sent by other means. We may also communicate with and make documents available to you and others by other forms of electronic communication. You accept the inherent risks of using electronic communication (including the security risks of interception of or unauthorised access to such e-mail, the risks of corruption of such communication and the risks of viruses or other harmful devices). As internet and e-mail communications are liable to data corruption we cannot accept responsibility for changes made after they are sent or any fraudulent emails purportedly coming from us. You accept that you will be responsible for performing virus checks on your own systems and ensure that emails coming from us are genuine before opening and relying on anything contained within them. Communications to and from you by email may be monitored by us to ensure that proper standards are maintained in the delivery of our services. You should also be aware that under the Regulation of Investigatory Powers Act 2000, our e-mail system and internet may be subject to monitoring and recording by us.</p>
                                        <br>
                                        <br>
                                        <p class="p181 ft15"><span class="ft9">7)</span><span class="ft88">Fees and disbursements generally: </span>Details of our charges and any special payment terms will be set out or referred to in our Engagement Letter (and any Appendix thereto). Unless we are acting in accordance with a full conditional fee arrangement or damages based agreement where we have agreed to defer our fees in full until the conclusion of the matter or unless otherwise agreed, we will issue monthly interim invoices during the course of our engagement or at such other appropriate interim stage as appropriate. Our invoices are payable on presentation. If payment is not received within 30 days of delivery of the invoice we reserve the right to charge interest on the outstanding amount at the rate of 3% over the base lending rate from time to time of the Royal Bank of Scotland plc. In addition to our fees we will charge you, and our invoice will include, directly incurred disbursements, significant postage, photocopying and stationery items and, where applicable, VAT at the appropriate rate. We may ask clients to make payments from time to time in advance (i.e. before we incur the costs) to meet anticipated fees or disbursements. If there are any difficulties in meeting these requests promptly, please let us know as soon as possible. In the event that requests for advance payments are not met or interim invoices are not paid, we reserve the right to stop working for you. We are entitled to look to you as our client for settlement of our professional charges. If another party takes responsibility for the payment of these (in whole or in part) but fails for whatever reason to settle these, you will be responsible for settling them.</p>
                                        <br>
                                        <br>
                                        <p class="p182 ft8"><span class="ft9">8)</span><span class="ft87">Client money:</span> </p>
                                        <p class="p177 ft9"><span class="ft9">8.1</span><span class="ft25">Unless we agree otherwise with you, any money that we hold for you will be deposited in our client account with the Royal Bank of Scotland, in accordance with the requirements of the SRA Accounts Rules from time to time. Where a third party wishes to deposit money into our client account on your behalf in connection with our retainer, we may need to satisfy anti- money laundering requirements in respect of the third party before the money can be accepted into our client account.</span> </p>
                                        <p class="p177 ft9"><span class="ft9">8.2</span><span class="ft25">In accordance with SRA Accounts Rules, where any sums are held on our client account on your behalf, we will account to you for any interest accrued from the date the funds are cleared into our account until the date the amount is paid, save where the interest accrued amounts to less than £20 (or foreign currency equivalent) in any three month period. Unless separately agreed with you interest will be paid at the applicable rate set by Royal Bank of Scotland and accruing on our client account from time to time.</span> </p>
                                        <p class="p183 ft15"><span class="ft9">8.3</span><span class="ft75">We will not be responsible for any loss due to any mistake or failure by the bank, or by reason of the insolvency or other financial difficulty of the bank and/or the loss by the bank of any licence, authorisation or permission required to carry out banking or deposit-taking activities under applicable law. Insolvency will extend to any voluntary arrangement for a composition of debts, the appointment of a liquidator, the making of a winding up order, the passing of a resolution for voluntary winding up, the appointment of an administrator or administrative receiver or any analogous arrangement and/or the inability of the bank to pay its debts, including any balance on our client account as they fall due.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p174 ft9"><span class="ft9">9)</span><span class="ft87">Assessment of Fees: </span>You may be entitled to have our charges reviewed by the Court by a process called "assessment" (and which was formerly known as “taxation”). The procedure is set out in Sections 70, 71 and 72 of the Solicitors Act 1974. You may also have a right to object to our fees and charges by making a complaint to the Legal Ombudsman, contact details for which are provided in our engagement letter.</p>
                                        <p class="p184 ft19"><span class="ft9">10)</span><span class="ft89">Fixed or conditional fees: </span>Where we have agreed to a fixed or conditional fee arrangement, it will not be a contentious business agreement under Section 57 or 59 of the Solicitors Act 1974. You will have the right to have our fee reviewed by a Court should you chose to do so.</p>
                                        <br>
                                        <br>
                                        <p class="p51 ft8"><span class="ft9">11)</span><span class="ft90">Confidentiality and disclosure</span> </p>
                                        <p class="p185 ft9"><span class="ft9">11.1</span><span class="ft91">We will keep information and documents provided to us for the purposes of the engagement confidential, except to the extent that you agree to allow us to disclose them (in the Engagement Letter or otherwise), where it otherwise is or becomes public, or where disclosure is required by law or by any persons responsible for regulating our business (for example in relation to anti-money laundering compliance, an audit by the Solicitors Regulation Authority or an audit by our accountants or auditors). You authorise under this engagement to share information with the employees and partners of our associate firms, Hausfeld Rechtsanwälte LLP in Germany, Hausfeld LLP in the United States and Hausfeld Advocaten in the Netherlands, subject to compliance with the same confidentiality terms set out in this Clause 11.</span> </p>
                                        <p class="p186 ft9"><span class="ft9">11.2</span><span class="ft91">We are required, in the same way, to maintain the confidentiality of information provided to us when acting for other clients and cannot disclose that information to you without their express written permission.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p26 ft8"><span class="ft9">12)</span><span class="ft90">Data protection</span> </p>
                                        <p class="p187 ft19"><span class="ft9">12.1</span><span class="ft43">We comply with obligations under data protection legislation in force from time to time and require our clients to do likewise.</span> </p>
                                        <p class="p188 ft9"><span class="ft9">12.2</span><span class="ft27">Insofar as the information which we acquire in relation to the engagement may contain personal data within the meaning of the EU General Data Protection Regulation, the UK Data Protection Act 2018 or other relevant UK legislation which may supplement or supersede those obligations from time to time, we shall hold, use and process the personal data on the terms set out in our Client Data Protection Policy (“the Policy”) which is attached at Appendix 1.</span> </p>
                                        <p class="p189 ft19"><span class="ft9">12.3</span><span class="ft92">You agree to comply with the client responsibilities set out in the Policy in relation to any personal data which you share with us for the purposes of the engagement, in particular:</span> </p>
                                        <p class="p190 ft9"><span class="ft9">a)</span><span class="ft27">that you are authorised to provide us with any personal data which you share for the purposes of the instruction,</span> </p>
                                        <p class="p191 ft9"><span class="ft3">b)</span><span class="ft27">to ensure that the personal data which you provide to us is accurate and kept up to date, adequate, relevant and the minimum necessary for the purposes of us providing the legal services to you and not subject to any restriction which could prevent you from disclosing it to us or our using it for the purposes of the engagement;</span> </p>
                                        <p class="p191 ft9"><span class="ft9">c)</span><span class="ft28">that you have complied with all obligations that you may have to relevant individuals in relation to the lawful, fair and transparent processing of personal data in passing it to us and agree to take responsibility for passing on information to the individual in relation to our identity, how we will use that information for the purposes of our instruction on the terms set out in the Policy and the rights of the individual in relation to any personal data which we hold.</span> </p>
                                        <p class="p192 ft9"><span class="ft9">12.4</span><span class="ft27">We will act as a data controller in relation to any personal data which you provide or we otherwise obtain for the purposes of your instruction on the terms set out in the Policy,</span> </p>
                                        <p class="p193 ft9">including:</p>
                                        <p class="p194 ft9"><span class="ft3">a)</span><span class="ft28">ensuring that the personal data is used only for the purposes of providing our legal services to you, managing and operating our business and complying with our regulatory and legal obligations as identified in the Policy;</span> </p>
                                        <p class="p195 ft9"><span class="ft3">b)</span><span class="ft27">determining the extent and means of any processing of the personal data to ensure it complies with the data processing principles set out in GDPR and complying with those principles to the extent that Hausfeld processes personal data including ensuring that any processing is lawful, fair and transparent, necessary for the identified purposes, and the personal data is accurate, adequate, relevant and limited to that needed for the identified purpose;</span> </p>
                                        <p class="p196 ft9"><span class="ft9">c)</span><span class="ft28">only sharing personal data with third parties where it is necessary for the identified purposes set out in the Policy, ensuring appropriate contractual provisions are in place where personal data is shared for processing with third parties to ensure compliance by those third parties with confidentiality and other obligations in relation to the processing of personal data and that any transfer of the personal data outside of the EEA is on terms which provides equivalent protection to the requirements of GDPR;</span> </p>
                                        <p class="p195 ft9"><span class="ft3">d)</span><span class="ft27">taking all reasonable technical and organisational measures to protect the integrity and security of the personal data which we hold to guard against unauthorised or unlawful access, alteration, disclosure or destruction of personal data and against accidental loss or destruction of or damage to personal data;</span> </p>
                                        <p class="p197 ft39"><span class="ft3">e)</span><span class="ft93">retaining the personal data in accordance with our retention policy for the minimum period necessary for the identified purposes and compliance; and</span> </p>
                                        <p class="p198 ft19"><span class="ft3">f)</span><span class="ft94">compliance with data subject rights as may apply in respect of any personal data which we hold.</span> </p>
                                        <p class="p199 ft9"><span class="ft9">12.5</span><span class="ft91">As set out in the Policy, you agree that:</span> </p>
                                        <p class="p200 ft15"><span class="ft9">a)</span><span class="ft29">we may share personal data with partners, staff, and consultants of Hausfeld &amp; Co and its associated entities (Hausfeld LLP and the United States, Hausfeld Rechtsanwälte LLP in Germany and Hausfeld Advocaten in the Netherlands), with third party service providers that we engage to process data for the purposes of your engagement and with other third parties that we engage for the purposes of the operation of our business, subject to ensuring appropriate agreements are in place to ensure the protection and processing of personal data in accordance with data protection obligations;</span> </p>
                                        <p class="p201 ft9"><span class="ft17">b)</span><span class="ft91">that as a global law firm, we may transfer your personal data to countries outside of the EEA which do not provide the same level of data protection as the UK. If we do make such a transfer then we will ensure that there is an equivalent level of protection to the requirements of the GDPR; and</span> </p>
                                        <p class="p201 ft9"><span class="ft17">c)</span><span class="ft27">we may use personal data to provide you with information about our services. With your agreement, we may also keep you updated on legal developments that we believe might be of interest. If at any time you do not wish to receive such information you can notify us by using the subscribe option in any emails which we send or by notifying us by email to </span><a href="mailto:dataprivacy@hausfeld.com">dataprivacy@hausfeld.com</a>.</p>
                                        <p class="p174 ft9"><span class="ft9">12.6</span><span class="ft27">Neither party shall, by its acts or omissions, cause the other party to breach its respective obligations under the GDPR or equivalent UK data protection laws. In the event of a breach by either party of their respective obligations under applicable data protection laws, the party in breach shall be liable to the other party for all or any losses incurred by the other party, or for which the other party becomes liable as a result of such breach.</span> </p>
                                        <p class="p202 ft9"><span class="ft9">12.7</span><span class="ft91">Save as otherwise described in the Policy, personal data will be retained by us and will not be</span> </p>
                                        <p class="p204 ft19">sold, transferred or otherwise disclosed to any third party, unless such disclosure is required by law or court order.</p>
                                        <p class="p205 ft15"><span class="ft9">13)</span><span class="ft95">Your documents</span>: You agree that we may store documents and papers electronically. We prefer to return original documents to our clients but reserve the right to store these if you do not instruct us to do otherwise or if we have to do this by law or under rules of the Solicitors Regulation Authority. We reserve the right to charge for storage of documents following the end of our retainer to cover our costs and for retrieving papers or documents from storage. If we charge for this service we will let you know and (unless Clause 14 below applies) give you the option of having the original documents returned to you. Archived files and papers may be destroyed without further notice in accordance with our records policy and any relevant guidelines of the Solicitors Regulatory Authority unless you have previously requested in writing the opportunity to remove them from our archives or expressly asked for them to be retained.</p>
                                        <br>
                                        <br>
                                        <p class="p174 ft9"><span class="ft9">14)</span><span class="ft90">Our right to retain funds, papers and property</span>: We reserve the right to retain funds paid as an advance on our fees/disbursements, files and documents belonging to you until all of our outstanding fees and disbursements owed by you have been paid.</p>
                                        <br>
                                        <br>
                                        <p class="p206 ft15"><span class="ft9">15)</span><span class="ft95">Financial Services and Markets Act 2000 (FSMA): </span>The provision of our legal services may relate to investments within the meaning of FSMA. H&amp;Co is not authorised by the Financial Conduct Authority to provide investment advice and may refer you to someone who is authorised to provide such advice where required. We are, however, included on the register maintained by the Financial Conduct Authority so that we can carry out insurance distribution activity, which is broadly the advising on, selling and administration of insurance contracts. This allows us to advise on and assist in arranging insurance contracts where this is required in connection with the dispute on which are advising you. This part of our business, including arrangements for complaints or redress or if something goes wrong, is regulated by the Solicitors Regulation Authority. The register can be accessed via the Financial Conduct Authority website at <span class="ft83"><a href="www.fca.org.uk/firms/financial-services-register">www.fca.org.uk/firms/financial-services-register</a></span> or by contacting the Financial Conduct Authority on +44 20 7066 1000. We will not provide services constituting insurance distribution activity unless we agree to do so in writing. Our engagement does not and will not include giving you any advice on the merits of entering into any transaction relating to investments, unless we agree in writing to give such advice in relation to insurance distribution activities. Otherwise, we will assume that you have taken, or will take, your own decision to negotiate or enter into any such transaction solely on the basis of your own evaluation of the merits of the transaction and any advice received from a person authorised under the FSMA to give investment advice. We will not communicate, either to you or on their behalf, to any other person any invitation or inducement to engage in investment activity unless that communication is exempt from the FSMA restrictions on financial promotions. Nothing we write or say is intended to be or should be construed as any such invitation or inducement.</p>
                                        <br>
                                        <br>
                                        <p class="p207 ft8"><span class="ft9">16)</span><span class="ft90">Consumer Contracts (Information, Cancellation and Additional Charges) Regulations 2013: </span><span class="ft9">If you are contracting with us as a consumer pursuant to a distance or off-premises contract, you will have a 14 day period to cancel the contract unless you request us to start working on your behalf before the end of the 14 day period. Where you ask us to do so, the contract cannot be cancelled where the services have been provided in full. Where the services have been partially performed at your request within the 14 day period, you will be liable to pay for the services provided up to the date of cancellation.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p173 ft19"><span class="ft9">17)</span><span class="ft89">Money Laundering: </span>In order to comply with our statutory obligations with respect to prevention of money laundering, we may from time to time request you to provide certain</p>
                                        <p class="p208 ft9">documents in order to verify your identity and the source and destination of any funds being paid into, or out of our client account. Our engagement and our ability to act for you is at all times subject to your complying with any such requests promptly and so that we are satisfied that we have fulfilled our statutory obligations. In certain circumstances we may be required by statute to make a disclosure to the National Crime Agency and may not be permitted to tell you that a disclosure has been made.</p>
                                        <br>
                                        <br>
                                        <p class="p173 ft9"><span class="ft9">18)</span><span class="ft90">Bribery/corruption: </span>As a law firm operating globally, we ensure strict compliance with all applicable laws, statutes, regulations, and codes relating to anti-bribery and anti-corruption including but not limited to the Bribery Act 2010 and the Foreign Corrupt Practices Act 1977 (USA).</p>
                                        <br>
                                        <br>
                                        <p class="p209 ft15"><span class="ft9">19)</span><span class="ft95">Prevention of facilitation of tax evasion: </span>In compliance with our legal and ethical obligations, we ensure strict compliance with the requirements of the Criminal Finances Act 2017, and any equivalent legislation designed to prevent the facilitation of tax evasion. In agreeing to the terms of this engagement, you confirm that: a) you will not engage in any activity, practice or conduct which would constitute either a UK tax evasion facilitation offence or a foreign tax evasion facilitation offence; b) you will maintain in place such policies and procedures as are reasonable to prevent tax evasion and the facilitation thereof; and c) you will not at any point during our engagement make any request to the firm, or any of its partner, employees or consultants to act in any way which might involve us in the facilitation of any tax evasion offence in breach of the Criminal Finances Act 2017 or otherwise.</p>
                                        <br>
                                        <br>
                                        <p class="p174 ft9"><span class="ft9">20)</span><span class="ft90">Benefit: </span>These Terms of Business and our Engagement Letter are entered into by H&amp;Co on its own behalf and on behalf of all Partners, employees and consultants for the purposes of the limitation of liability provisions set out in Clause 3 above.</p>
                                        <br>
                                        <br>
                                        <p class="p209 ft9"><span class="ft9">21)</span><span class="ft90">General: </span>If any of the provisions of our Engagement Letter or these Terms of Business is or becomes invalid, illegal or unenforceable, the validity, legality or enforceability of the remaining provisions shall not in any way be affected. We will not be liable for any delay in or failure to perform our obligations as a result of any cause beyond our reasonable control. Any variation of the terms of our engagement must be made in writing and will not be effective unless signed by each of us. These Terms of Business together with the relevant Engagement Letter form the entire agreement and understanding between us with respect to its subject matter and replace all previous arrangements and understandings between us with respect to the subject of this engagement, which shall cease to have any further force or effect. We reserve the right to assign our rights and/or obligations under our Engagement Letter to any business which is a successor to our current business.</p>
                                        <br>
                                        <br>
                                        <p class="p174 ft19"><span class="ft9">22)</span><span class="ft89">Governing Law and Jurisdiction: </span>Our agreement is governed by English Law. The courts of England and Wales shall have exclusive jurisdiction in relation to any claim, dispute or difference concerning our terms of engagement and any matter arising from it.</p>
                                        <p class="p211 ft8" style="text-align:center;">Appendix</p>
                                        <p class="p212 ft8" style="text-align:center;">Hausfeld &amp; Co. LLP - Client Data Protection Policy</p>
                                        <br>
                                        <br>
                                        <p class="p213 ft9">In the course of acting for you, we will collect personal data as necessary to carry out your instructions, to manage and operate our business and to comply with our legal and regulatory obligations. This may include information relating to you, your directors, shareholders, beneficial owners, employees, consultants and associates, clients, customers or other individuals relevant to the instruction which we refer to in this policy as "personal data".</p>
                                        <p class="p214 ft15">We will use your personal data primarily to provide legal services to you and in managing and operating our business and complying with our legal and regulatory obligations, as described below. We may also use your personal data to send you information about our services and, where you agree, information relating to legal developments that we believe may be of interest. You have the right to opt out of receiving marketing communications at any time, as explained below.</p>
                                        <p class="p215 ft9">Our use of personal data is subject to your instructions, our professional duty of confidentiality and the requirements of relevant data protections laws regarding the use and protection of personal data pursuant to the EU General Data Protection Regulation, the UK Data Protection Act 2018 and other relevant UK legislation which may add or supersede those obligations from time to time. This policy sets out:</p>
                                        <p class="p216 ft9"><span class="ft3">A.</span><span class="ft27">the respective responsibilities of Hausfeld and our clients in respect of personal data which we hold in the course of providing our legal services; and</span> </p>
                                        <p class="p217 ft19"><span class="ft9">B.</span><span class="ft43">how Hausfeld will use, process, store and share with third parties any personal data which we hold and the rights of the individual to whom the data relates.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p218 ft8"><span class="ft8">A.</span><span class="ft96">Allocation of Responsibilities</span> </p>
                                        <p class="p219 ft9">Where we receive personal data from you, or obtain it from any third party on your behalf in the course of acting for you, Hausfeld will act in the capacity of a data controller, jointly with you. Both parties shall comply with their respective obligations under data protection laws and shall use all reasonable efforts to assist the other to comply with their respective legal obligations, as set out below.</p>
                                        <p class="p220 ft19"><strong class="ft44">Client responsibilities </strong>- In providing personal data to us for the purposes of acting for you, you agree that you will comply with your obligations to ensure:</p>
                                        <p class="p221 ft19"><span class="ft3">a)</span><span class="ft18">that the personal data which you provide to us is accurate and, where appropriate, kept up to date;</span> </p>
                                        <p class="p221 ft9"><span class="ft3">b)</span><span class="ft26">that the personal data is adequate, relevant and the minimum necessary for the purposes of us providing the legal services to you;</span> </p>
                                        <p class="p222 ft15"><span class="ft9">c)</span><span class="ft97">that it is not subject to any prohibition of restriction which could prevent you from disclosing or transferring to us or prevent or restrict our use of it for the purposes of our engagement;</span> </p>
                                        <p class="p223 ft9"><span class="ft9">d)</span><span class="ft26">that you have complied with all obligations which you may have to relevant individuals in relation to the lawful, fair and transparent processing of personal data in passing it to us and agree to take responsibility for passing on information to the individual in relation to our identity, how we will use that information for the purposes of our instruction, and the rights of the data subject as set out in this policy;</span> </p>
                                        <p class="p225 ft19"><span class="ft3">e)</span><span class="ft18">that you will comply with obligations for security, international transfer and retention of any personal data which you hold in relation to the matters on which we act for you and compliance with all data subject rights.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p226 ft9"><strong class="ft8">Hausfeld responsibilities – </strong>where you provide personal data to us or we otherwise obtain this for the purposes of acting for you, we will be responsible for:</p>
                                        <p class="p227 ft9"><span class="ft9">a)</span><span class="ft20">ensuring that the personal data which you share with us is used only for the purposes of providing our legal services to you and related business purposes, as set out below;</span> </p>
                                        <p class="p228 ft9"><span class="ft3">b)</span><span class="ft20">determining the extent and means of any processing of the personal data, ensuring that any processing complies with the data processing principles set out in GDPR and complying with those principles to the extent that Hausfeld processes personal data including ensuring that any processing is lawful, fair and transparent, necessary for the identified purposes, and the personal data is accurate, adequate, relevant and limited to that needed for the identified purpose</span> </p>
                                        <p class="p223 ft9"><span class="ft9">c)</span><span class="ft23">only sharing personal data with third parties where it is necessary for the identified purposes set out in the Policy, ensuring appropriate contractual provisions are in place where personal data is shared for processing with third parties to ensure compliance by those third parties with confidentiality and other obligations in relation to the processing of personal data and that any transfer of the personal data outside of the EEA is on terms which provides equivalent protection to the requirements of GDPR;</span> </p>
                                        <p class="p229 ft9"><span class="ft9">d)</span><span class="ft26">taking reasonable technical and organisational measures to protect the integrity and security of the personal data which we hold to guard against unauthorised or unlawful access, alteration, disclosure or destruction of personal data and against accidental loss or destruction of or damage to personal data;</span> </p>
                                        <p class="p227 ft19"><span class="ft3">e)</span><span class="ft18">retaining the personal data in accordance with our retention policy for the minimum periods necessary </span><span class="ft98">for the identified purposes and compliance</span>; and</p>
                                        <p class="p230 ft19"><span class="ft3">f)</span><span class="ft99">compliance with any data subject rights as may apply in respect of any personal data which we hold.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p231 ft9"><strong class="ft8">Liability </strong>- Neither party shall, by its acts or omissions, cause the other party to breach its respective obligations under the data protection laws. In the event of a breach by either party of their respective obligations under applicable data protection laws, the party in breach shall be liable to the other party for all or any losses incurred by the other party, or for which the other party becomes liable as a result of such breach.</p>
                                        <br>
                                        <br>
                                        <p class="p232 ft102"><span class="ft8">B.</span><span class="ft100">Information regarding Hausfeld’s use of personal data </span><span class="ft101">We set out below further information regarding:</span> </p>
                                        <p class="p233 ft9"><span class="ft9">1.</span><span class="ft28">The types of personal data which we may collect and potential categories of data subject;</span> </p>
                                        <p class="p234 ft9"><span class="ft9">2.</span><span class="ft28">The purposes for which we will process personal data;</span> </p>
                                        <p class="p234 ft9"><span class="ft9">3.</span><span class="ft28">The circumstances in which we may share personal data with third parties;</span> </p>
                                        <p class="p234 ft9"><span class="ft9">4.</span><span class="ft28">How we protect and store the personal data which we hold;</span> </p>
                                        <p class="p234 ft9"><span class="ft9">5.</span><span class="ft28">When we may transfer personal data abroad;</span> </p>
                                        <p class="p4 ft9"><span class="ft9">6.</span><span class="ft28">How long will we retain personal data;</span> </p>
                                        <p class="p236 ft19"><span class="ft9">7.</span><span class="ft103">Rights of data subjects to review, update, restrict the use of and/or request the erasure of personal data;</span> </p>
                                        <p class="p237 ft9"><span class="ft9">8.</span><span class="ft28">Changes to this privacy policy; and</span> </p>
                                        <p class="p234 ft9"><span class="ft9">9.</span><span class="ft28">Contact details.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p238 ft8">1. The personal data which we may collect and potential categories of data subject</p>
                                        <p class="p219 ft9">We collect personal data as necessary to enable us to carry out your instructions, to manage and operate our business and to comply with our legal and regulatory obligations.</p>
                                        <p class="p182 ft8">1.1 Personal data and potential categories of data subjects</p>
                                        <p class="p219 ft19">Personal data may include any information which can be used to identify or be linked to any individual including name, contact information, job title and any associated organisation, qualification, gender, nationality, date of birth or any other personal data. It may relate to:</p>
                                        <p class="p239 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">you, your employees, directors, shareholders, beneficial owners, agents and other associates or representatives;</span> </p>
                                        <p class="p236 ft19"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft18">your customers, clients or other contacts who are relevant to the matter on which you have instructed us;</span> </p>
                                        <p class="p240 ft36"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft104">individuals who provide statements in respect of the matters on which we act for you or whom we may otherwise instruct, or correspond with, in relation to the engagement on your behalf; and</span> </p>
                                        <p class="p241 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">individuals otherwise connected with any dispute on which we act on your behalf.</span> </p>
                                        <p class="p182 ft8"><span class="ft8">1.2</span><span class="ft105">Sources of personal data</span> </p>
                                        <p class="p242 ft19">Whilst we will obtain the majority of information from you directly, we may also obtain personal data from:</p>
                                        <p class="p241 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">public data sources or third-party service providers;</span> </p>
                                        <p class="p243 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">our IT systems, reception logs or use of our website (see the Privacy and Cookies Notice on our website);</span> </p>
                                        <p class="p234 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">individuals who provide statements in relation to disputes; and</span> </p>
                                        <p class="p244 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">documents disclosed by other parties in relation to the matters on which we act for you.</span> </p>
                                        <p class="p182 ft8">1.3 Special categories of personal data</p>
                                        <p class="p245 ft36">Personal data may also include special categories of sensitive personal data which relate to an individual’s health, racial or ethnic origin, religious or philosophical beliefs, or information relating to criminal convictions and offences. We will only request and process sensitive personal data:</p>
                                        <p class="p246 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">where the individual to whom it relates has given his/her explicit consent for us to do so;</span> </p>
                                        <p class="p244 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">for the purposes of providing or obtaining confidential advice;</span> </p>
                                        <p class="p234 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">where the information is manifestly made public by the individual;</span> </p>
                                        <p class="p244 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">for the establishment, exercise or defence of legal claim; or</span> </p>
                                        <p class="p248 ft19"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft18">for the purposes of prevention or detection of fraud or unlawful activity or as otherwise required by law.</span> </p>
                                        <br>
                                        <br>
                                        <p class="p218 ft8">2. The purposes for which we will process information</p>
                                        <p class="p219 ft9">We may process personal data for the following purposes, for any related and/or ancillary purpose which is compatible with the purpose for which it is provided, or any other purpose for which your personal data was provided to us.</p>
                                        <p class="p182 ft8">2.1 Providing our legal services to you</p>
                                        <p class="p219 ft9">We will process data that is necessary in responding to your initial enquiry and acting for you pursuant to any agreed engagement. This will also include processing of personal data necessary for the management and administration of our business relationship, including corresponding with you, processing payments, accounting, auditing, billing and collection and support services.</p>
                                        <p class="p238 ft8">2.2 Processing in our legitimate business interests</p>
                                        <p class="p219 ft9">We may also process data where processing is necessary for the purposes of our legitimate interests or those of any third party recipients that receive your personal data provided that such interests are not overridden by your own interests or fundamental rights and freedoms. This may be relied on for the purposes of:</p>
                                        <p class="p249 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft71">contacting you about our services and events which we believe may be of interest and internal analysis to identify those area which may be relevant;</span> </p>
                                        <p class="p250 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft71">internal analysis in monitoring and assessing compliance with our policies and standards and assessing and improving the effectiveness of our services and communications to you;</span> </p>
                                        <p class="p234 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft71">for insurance purposes;</span> </p>
                                        <p class="p250 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft71">detecting, preventing and responding to actual or potential fraud or other illegal activities or intellectual property infringement;</span> </p>
                                        <p class="p251 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft71">processing of any personal data which we hold for the operation of our IT and data security systems including backups of any element of our IT systems or databases containing personal data to ensure the resilience of our IT systems and the integrity and recoverability of our data; and</span> </p>
                                        <p class="p249 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft71">processing of any personal data which we hold for the purposes of protecting and asserting our legal rights and those of others in relation to legal claims.</span> </p>
                                        <p class="p182 ft8">2.3 Compliance with our legal obligations</p>
                                        <p class="p252 ft9">We may process personal data to comply with our legal, regulatory and professional obligations including:</p>
                                        <p class="p253 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">compliance screening, record keeping and recording obligations (for example in complying with anti-money laundering, financial and credit check, fraud and crime prevention and detection purposes);</span> </p>
                                        <p class="p244 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">compliance with data subject access requests; and</span> </p>
                                        <p class="p234 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">compliance with court orders and regulatory requests and defending and pursuing our legal rights.</span> </p>
                                        <p class="p4 ft8">2.4 Bulletins and updates</p>
                                        <p class="p214 ft36">Where you confirm your consent to do so, we will also keep you updated in relation to relevant legal updates, but you can choose not to receive such material at any time by choosing the unsubscribe option in any email update which we send, or by email at any time to <a href="mailto:dataprivacy@hausfeld.com">dataprivacy@hausfeld.com</a>.</p>
                                        <br>
                                        <br>
                                        <p class="p255 ft8">3. The circumstances in which we may share personal data with third parties</p>
                                        <p class="p219 ft9">We may share your personal data with third parties in the following circumstances, further details of which are available upon request:</p>
                                        <p class="p253 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">with our employees, partners and consultants and with other associated Hausfeld entities (Hausfeld LLP in the United States, Hausfeld Rechtsanwälte LLP in Germany and Hausfeld Advocaten in the Netherlands whose details can be found in our Legal Notice (</span><span class="ft37"><a href="https://www.hausfeld.com/legalnotice">https://www.hausfeld.com/legalnotice</a></span>) on a confidential basis where required for provision of our legal services, internal administration, billing, and compliance and reporting, promoting our events and services and other business purposes;</p>
                                        <p class="p256 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">with other third party advisors and providers in accordance with your instructions and for the purposes of providing our litigation services to you, including (without limitation) where appropriate barristers and their respective Chambers, experts, other professional advisors whom you have instructed, litigation funders and insurers, providers of reprographic, document and disclosure services, foreign lawyers, translators, court transcribers, court officials and providers of electronic court bundles and related services;</span> </p>
                                        <p class="p253 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">with third party providers who host the services on which our data is stored, our IT and marketing consultants and other third party providers of business and administrative services, including debt recovery that we may use to assist in business administration and to make our business more efficient from time to time;</span> </p>
                                        <p class="p236 ft19"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft18">with third party providers for the purposes of money laundering and other compliance and reference checks and other fraud and crime prevention purposes;</span> </p>
                                        <p class="p240 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">with our professional indemnity insurers and brokers and professional advisors as is necessary for the purposes of obtaining and maintaining insurance cover, obtaining professional advice, managing legal disputes and maintaining accounts records and financial audits; and</span> </p>
                                        <p class="p253 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">with any third party to whom we assign or novate any of our rights or obligations or any part of our business is sold or transferred to, or integrated with another organization, in which event you will be notified of the transfer and we will ensure a commitment to equivalent compliance with data protection laws.</span> </p>
                                        <p class="p219 ft9">Any information which we share with third party providers will be pursuant to contractual arrangements which we put in place, which will require that the data is processed only in accordance with our instructions for specified purposes, subject to appropriate security arrangements and applicable data protection laws.</p>
                                        <p class="p215 ft9">Hausfeld also reserves the right to disclose any information which it holds where it considers in good faith that it is necessary: a) to appropriate courts, law enforcement authorities, governmental or regulatory authorities, if required to do so by law or regulation or by any governmental or law enforcement agency; and b) in order to protect the vital interests of the data subject or of any other individual. Where information is so disclosed, we will inform you of the disclosure to the extent we are permitted by law to do so.</p>
                                        <p class="p4 ft8"><span class="ft8">4.</span><span class="ft107">How we protect and store the personal data which we hold</span> </p>
                                        <p class="p219 ft9">We use administrative, technical and physical measures to keep personal data confidential and secure, in accordance with our internal procedures to protect it from being accidentally lost, altered, used, accessed or disclosed in an unauthorised way. Personal data may be held on our data technology systems, those of our third party contractors and/or in paper files. Where we share information with third parties, we will obtain written commitments that they will protect the data with appropriate safeguards.</p>
                                        <p class="p258 ft9">Although we do our best to ensure the security of your personal data and to use only reputable service providers, no information system can be 100% secure and we cannot guarantee the absolute security of your information, in particular we will not be responsible for the security of any information which you transmit to us over networks that we do not control including the internet and wireless networks or those of third party providers.</p>
                                        <p class="p259 ft19">We have in place procedures to deal with any suspected personal data breach and will notify you and any applicable regulator of a breach where we are legally required to do so.</p>
                                        <p class="p218 ft8"><span class="ft8">5.</span><span class="ft107">When we may transfer your personal data abroad</span> </p>
                                        <p class="p258 ft9">As Hausfeld operates globally, in delivering our services to you, we may transfer your personal data abroad for storage or processing where required for any of the purposes set out above, and any of the countries in which Hausfeld and its affiliates, agents or contractors have offices.</p>
                                        <p class="p260 ft15">Where personal data is transferred to countries outside of the EEA (including the United States) which do not always have the same standard of data protection as those inside the EEA, we will ensure a data protection level equivalent to the minimum level within the EEA, by transferring personal data to a country which the European Commission has determined ensures an adequate level of protection, entering into standard contractual clauses which have been approved by the European Commission, pursuant to the the EU-US Privacy Shield which allows U.S. businesses to self-certify as a means of complying with EU data protection laws or by other similar protective measures.</p>
                                        <p class="p259 ft9">If you require additional information regarding the specific mechanisms in place in relation to international transfers, please contact us.</p>
                                        <p class="p182 ft8"><span class="ft8">6.</span><span class="ft107">How long we will retain personal data</span> </p>
                                        <p class="p261 ft9">Personal data will be retained for as long as necessary for fulfilling our engagement. Following the conclusion of the engagement, personal data will be retained to enable us to respond to any queries, complaints or claims made by you and to the extent permitted for legal, regulatory, fraud and other financial crime prevention and legitimate business purposes. We may also hold data in backup systems which are put in place to maintain the integrity of our IT systems for the minimum retention periods.</p>
                                        <p class="p262 ft9">Where personal data is held for the purposes of acting for you, it may be retained for the duration of the client agreement and beyond the termination of that retainer in accordance with Hausfeld’s data retention policy which is line with statutory and professional rules on retention of client data. This will usually be a period of 7 years form the end of the matter, but may be longer in appropriate cases. Details can be provided on request on conclusion of the matter. Where necessary, we will also retain personal data where it may be required for Hausfeld to assert or defend any legal claims or otherwise asserts its rights or those of third parties until the end of the relevant retention period or until any claims have been resolved.</p>
                                        <p class="p264 ft44"><span class="ft9">7.</span><span class="ft108">Rights of data subjects to review, update, restrict the use of and/or request the erasure of personal data</span> </p>
                                        <p class="p265 ft9">Hausfeld has a legal obligation to ensure that any personal information which it holds remains accurate and up to date and relies on its clients to notify any changes to the information provided. Individuals whose personal data we hold will have rights in relation to the personal data which we hold.</p>
                                        <p class="p266 ft9">Subject to certain legal conditions, any individual has a right at any time:</p>
                                        <p class="p267 ft36"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft109">to request details of any categories of personal data which we hold about you, the purposes for which we process the data and any third parties with whom it is shared. Provided the rights and freedoms of others are not affected we will supply the individual with a copy of the data;</span> </p>
                                        <p class="p268 ft15"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft73">to ask us to update or correct any personal information which we hold, object to or ask us to restrict the processing of that personal data for particular purposes. You may object to the processing of personal data for direct marketing purposes and withdraw any consent you have previously given to us at any stage by notifying us by email to </span><span class="ft83"><a href="mailto:dataprivacy@hausfeld.com">dataprivacy@hausfeld.com</a></span> or using the other contact details below. Where you object to the data being processed for other purposes, we will cease such processing, unless we can demonstrate compelling legitimate grounds for the processing which overrides your interests, rights and freedoms, including compliance with legal obligations and for the purposes of legal claims;</p>
                                        <p class="p269 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft71">where the personal data is no longer necessary for the purposes for which it was collected, you may have the right to request that it be erased but this may be overridden where the data is necessary for other purposes including compliance with a legal obligation or in connection with potential legal claims;</span> </p>
                                        <p class="p270 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft71">where we hold personal data with your consent or for the performance of a contract with you and processing is carried out by automated means, you may have the right to receive your personal data from us in a commonly used format so that it can be transferred to an alternative third party provider, provided it would not adversely affect the rights and freedoms of others; and</span> </p>
                                        <p class="p250 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft45">to lodge a complaint with the appropriate supervisory authority. Contact details for the Information Commissioner’s Office, the supervisory authority in the UK, are provided below.</span> </p>
                                        <p class="p271 ft9">If you wish to exercise any of your rights in relation to your personal data or raise a complaint, please contact us by email or post using the contact details below. In the event we have any reasonable doubts concerning the identity of the person making the request, we may request additional information prove your identity to prevent unauthorised disclosure of data.</p>
                                        <p class="p272 ft15">We will consider any requests or complaints which we receive in a timely manner. We reserve the right to charge a reasonable administrative fee for any manifestly unfounded or excessive requests and for any additional copies. If you are not satisfied with our response, you may take your complaint to the Information Commissioner’s Office, the details for which are provided below.</p>
                                        <p class="p273 ft8"><span class="ft8">8.</span><span class="ft107">Changes to this privacy policy</span> </p>
                                        <p class="p274 ft9">We may revise and update this Privacy Policy from time to time in order to reflect any changes to the way in which we process your personal data, changes in applicable legal requirements or guidance. We will notify you in the event of any changes.</p>
                                        <p class="p4 ft8"><span class="ft8">9.</span><span class="ft107">How to contact us</span> </p>
                                        <p class="p242 ft19">If you require any further information or would like to contact us with any queries or comments, please use the contact details set out below.</p>
                                        <p class="p276 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft71">By email to </span><span class="ft37"><a href="mailto:dataprivacy@hausfeld.com">dataprivacy@hausfeld.com</a></span>; or by post to the Data Manager, Hausfeld &amp; Co. LLP, 12 Gough Square, London, EC4A3DW</p>
                                        <p class="p277 ft36"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft109">Hausfeld &amp; Co is registered in the Data Protection Register of the UK Information Commissioner’s Office under registration number Z1953172. The Information Commissioner’s Office can be contacted via its website https://ico.org.uk or by telephone on 0044 (0)303 123 1113.</span> </p>
                                        <img src="{{ $resourcePath }}img/logo.jpg" alt="">
                                        <p class="p5 ft6">12 Gough Square</p>
                                        <p class="p6 ft6">London</p>
                                        <p class="p6 ft6">EC4A3DW</p>
                                        <p class="p7 ft7">Direct</p>
                                        <p class="p8 ft7"><a href="tel:44(0)2076655000">44 (0)20 7665 5000</a> Main</p>
                                        <p class="p6 ft7"><a href="fax:44(0)2076655001">44 (0)20 7665 5001</a> fax</p>
                                        <div class="dclr"></div>
                                        <div id="id38_1">
                                          <p class="p286 ft8"> <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            CONFIDENTIAL</p>
                                          <p class="p287 ft9">Dear Claimant</p>
                                          <p class="p288 ft44">Subsequent Engagement Terms (following exhaustion of funding budget for our fees) Proposed group claim in relation to Mercedes-Benz emissions</p>
                                          <p class="p289 ft8"><span class="ft8">1.</span><span class="ft110">Background</span> </p>
                                          <p class="p290 ft9"><span class="ft9">1.1.</span><span class="ft12">We refer to the Engagement Terms which we have agreed with you today setting out the terms on which Hausfeld &amp; Co LLP will provide legal services to you and other claimants in connection with the proposed group claim against Mercedes-Benz and related entities relating to the use of 'defeat devices' in emissions control technology in Mercedes vehicles. We use the defined terms set out in the Engagement Terms.</span> </p>
                                          <p class="p291 ft9"><span class="ft9">1.2.</span><span class="ft12">Those Engagement Terms cover the payments to be made to us in respect of our fees for work until the agreed budget for our fees in the Funding Agreement is exhausted. Paragraph 6.1 of the Engagement Terms provide that, in respect of those fees, we will act on a the terms of a partial Conditional Fee Agreement under which our Discounted Fees (being 55% of our standard hourly rates or “base fees” (together with VAT) will be payable on a monthly basis with the remaing 45% of our fees (together with VAT) being deferred and subject to a success fee which is 45% of our base fees (together with VAT).</span> </p>
                                          <p class="p292 ft8"><span class="ft8">2.</span><span class="ft110">Subsequent Engagement Terms (following exhaustion of funding budget for our fees)</span> </p>
                                          <p class="p13 ft8"><span class="ft9">2.1.</span><span class="ft96">These Subsequent Engagement Terms set out a separate agreement in respect of the payments to be made to us in respect of our fees for work performed after the agreed budget for our fees under the Funding Agreement has been exhausted. We will notify you when that has occurred and this agreement will only apply to cover the fees after we have notified you that the agreed fee budget has been exhausted and so these terms apply. All the work on your claim thereafter will be carried out pursuant to this agreement.</span> </p>
                                          <p class="p293 ft19"><span class="ft9">2.2.</span><span class="ft33">Although these Subsequent Engagement Terms only apply to work carried out once the agreed fee budget under the Funding Agrement has been exhausted, by signing this agreement you are agreeing these terms in advance.</span> </p>
                                          <p class="p294 ft9"><span class="ft9">2.3.</span><span class="ft12">We have set out in the attached Schedule the different provisions which will apply under these Subsequent Engagement Terms as follows:</span> </p>
                                          <p class="p295 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">Our Fees, Expenses and Disbursements (Clause 6);</span> </p>
                                          <p class="p296 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">Costs position on successful outcome to your Claim (Clause 8); and</span> </p>
                                          <p class="p297 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">Costs position on unsuccessful outcome to your Claim (Clause 9)</span> </p>
                                          <p class="p13 ft15"><span class="ft9">2.4.</span><span class="ft13">The revised budget for our fees under these Subsequent Engagement Terms will be notified to the Committee in accordance with paragraph 6.3 and by way of update to paragraph 6.2 of</span> </p>
                                          <p class="p40 ft9">the Engagement Terms.</p>
                                          <p class="p24 ft9"><span class="ft9">2.5.</span><span class="ft12">Save for the terms set out above, all other terms of the Engagement Terms are hereby incorporated into these Subsequent Engagement Terms (with any necessary modifications) including the Terms of Business and Privacy Policy.</span> </p>
                                          <p class="p24 ft9"><span class="ft9">2.6.</span><span class="ft12">In the event of any conflict between these Subsequent Engagement Terms, the terms of the LMA or the terms of the Funding Agreement, the Funding Agreement will take precedence with the exception of any regulatory requirements in respect of which the Subsequent Engagement Terms will apply. Insofar as they are consistent with the Funding Agreement, these Subsequent Engagement Terms will take precedence over the LMA.</span> </p>
                                          <p class="p299 ft8"><span class="ft8">3.</span><span class="ft110">Cancellation and Termination</span> </p>
                                          <p class="p27 ft9"><span class="ft9">3.1.</span><span class="ft34">The cancellation rights set out at parargraph 14.1 – 14.3 of the Engagement Terms apply.</span> </p>
                                          <p class="p27 ft9"><span class="ft9">3.2.</span><span class="ft12">The termination provisions set out at paragraphs 14.4 – 14.7 of the Engagement Terms apply.</span> </p>
                                          <p class="p26 ft8"><span class="ft8">4.</span><span class="ft110">Complaints</span> </p>
                                          <p class="p27 ft9"><span class="ft9">4.1.</span><span class="ft12">The complaints provisions set out at paragraph 15 of the Engagement Terms apply.</span> </p>
                                          <p class="p27 ft8"><span class="ft8">5.</span><span class="ft110">Confidentiality</span> </p>
                                          <p class="p39 ft15"><span class="ft9">5.1.</span><span class="ft13">Unless as expressly set out in the Subsequent Engagement Terms, our advice is provided only to the Claimants and should not be relied on by any third party. It should be treated as confidential and privileged and not shared with any third party without our written consent, save that it may be required to be disclosed in the course of litigation to the Defendants and/or the Court for the purposes of recovering our costs at the conclusion of the Claim.</span> </p>
                                          <p class="p101 ft19">If you have any questions regarding these Subsequent Engagement Terms, please let me know.</p>
                                          <p class="p41 ft9">Yours sincerely</p>
                                          <div class="tet"> <br>
                                            <br>
                                            <br>
                                            <br>
                                            <p class="p2 ft9">Anthony Maton</p>
                                            <p class="p2 ft9">Partner</p>
                                            <p class="p2 ft9">For and on behalf of Hausfeld &amp; Co LLP</p>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <p class="p2 ft9">Nicola Boyle</p>
                                            <p class="p2 ft9">Partner</p>
                                            <p class="p2 ft3">For and on behalf of Hausfeld &amp; Co. LLP</p>
                                            <br>
                                            <br>
                                            <p class="p2 ft9">Encl.</p>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <p class="p2 ft2">&nbsp;</p>
                                            <p class="p4 ft9">I agree to the terms of this retainer</p>
                                            <p class="p301 ft9">……………………………………………………..</p>
                                            <p class="p27 ft9">Claimant</p>
                                            <br>
                                            <br>
                                            <span>Date………………………………………………………</span> <br>
                                            <br>
                                            <p class="p303 ft8" style="text-align:center">Schedule</p>
                                            <br>
                                            <br>
                                            <p class="p304 ft8" style="text-align:center">Amended Costs Provisions – Clauses 6, 8 and 9 of the Engagement Terms</p>
                                            <br>
                                            <br>
                                            <p class="p27 ft11"><span class="ft8">6.</span><span class="ft111">Our Fees, Expenses and Disbursements</span> </p>
                                            <p class="p305 ft51">Our Fees</p>
                                            <br>
                                            <br>
                                            <p class="p24 ft9"><span class="ft9">6.1.</span><span class="ft12">You agree that from the date of these Subseuqent Engagement Terms we will act for you under a Conditional Fee Agreement subject to and in accordance with the terms of section 58 of the Courts and Legal Services Act 1990, whereby:</span> </p>
                                            <p class="p59 ft19"><span class="ft9">a)</span><span class="ft43">Our Base Fees for work carried out under this agreement (together with VAT) will be fully deferred and only payable if the Claim succeeds.</span> </p>
                                            <p class="p41 ft9"><span class="ft3">b)</span><span class="ft27">If your Claim is successful, then you will be liable to pay:</span> </p>
                                            <p class="p306 ft9"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft20">our Base Fees incurred under this agreement (together with VAT); and</span> </p>
                                            <p class="p307 ft19"><span class="ft17" style="font-weight:bold; font-size:38px !important;line-height: 0.5;">∙</span><span class="ft18">a success fee, being 100% of our Base Fees incurred under this agreement (together with VAT) (the “</span><span class="ft44">Success Fee</span>”). The Success Fee is payable in addition to the Base Fees in the event of success.</p>
                                            <p class="p308 ft9"><span class="ft9">c)</span><span class="ft28">If the Claim is not successful, you will not have to pay the Base Fees or the Success Fee save as set out in paragraph 10 relating to the Costs associated with early termination.</span> </p>
                                            <p class="p24 ft9"><span class="ft9">6.2.</span><span class="ft12">Our Base Fees under this agreement will be calculated based on the time we spend on the Claims at our hourly rates set out in paragraph 3.2 above or as otherwise amended and notified to the Committee from time to time, together with VAT, if applicable.</span> </p>
                                            <p class="p46 ft15"><span class="ft9">6.3.</span><span class="ft13">Your Claim will be “successful” for the purposes of these Subsequent Engagement Terms if by final judgment or earlier settlement you recover or obtain the right to recover money or costs (whether Common, Individual or Issue Costs), and/or you in any way derive financial gain as a result of your Claim. If you win on any interim application, hearing or issue (including preliminary issues) and costs are ordered to be paid by the Defendant(s), then we will be entitled to recover from you our Base Fees in full of the relevant application, hearing or issue and, if your Claim goes on to succeed, our Success Fee. Paragraphs 7.1 – 7.3 below will also apply to the time incurred by us in connection with that interim application, hearing or issue.</span> </p>
                                            <p class="p65 ft9"><span class="ft9">6.4.</span><span class="ft12">The level of the Success Fee has been determined taking into account:</span> </p>
                                            <p class="p66 ft19"><span class="ft3">a)</span><span class="ft112">the fact that it could take several years to negotiate a successful settlement of the Group Claims or to obtain a judgment allowing us to recover our fees;</span> </p>
                                            <p class="p309 ft9"><span class="ft3">b)</span><span class="ft45">the resources of the Defendants and the likelihood that they will vigorously defend the Group Claims;</span> </p>
                                            <p class="p310 ft9"><span class="ft9">c)</span><span class="ft47">the relative complexity of the Group Claims, the fact that they involve details of the emissions control and other technology used in Mercedes vehicles, the details of which are not in the public domain and which are subject to ongoing investigations by regulatory authorities and/or their decisions subject to court appeals;</span> </p>
                                            <p class="p71 ft22"><span class="ft3">d)</span><span class="ft113">the likelihood that the Group Claims could involve some novel issues on the causes of action which can be pursued by Claimants which have not yet been determined by the</span> </p>
                                            <p class="p312 ft9">courts;</p>
                                            <p class="p313 ft15"><span class="ft3">e)</span><span class="ft48">the fact that the Group Claims will also revolve around expert analysis on the emissions control technology and the evaluation of the loss to Claimants which has not yet been completed at this stage, will depend on disclosure of information by the Defendants and may remain open to differing interpretations and be heavily disputed by defendants;</span> </p>
                                            <p class="p66 ft9"><span class="ft3">f)</span><span class="ft12">the fact that our fees are fully deferred and the risk that if the Claim is not successful we will not recover our Base Fees; and</span> </p>
                                            <p class="p71 ft36"><span class="ft3">g)</span><span class="ft49">the risk that the costs which we are due under these Subsequent Engagement Terms may exceed the amount that we receive pursuant to our commitment under the Priorities Agreement to cap what we receive at 40% of your share of the proceeds of any overall settlement or judgment award, as determined by reference to any offer from the Defendants or otherwise by the Committee in its discretion (the “</span><span class="ft50">Damages Award</span>”).</p>
                                            <br>
                                            <br>
                                            <p class="p255 ft51">Payment of third-party disbursements and expenses</p>
                                            <br>
                                            <br>
                                            <p class="p24 ft9"><span class="ft9">6.5.</span><span class="ft12">Whether or not the Group Claims are successful, you will also be liable for any expenses which we reasonably incur on your behalf in relation to the Group Claims such as court filing fees, courier charges, travel and hotels, translation costs and taxi fares. We will charge these expenses at cost, together with any applicable VAT. We may also charge for any significant photocopying that we may undertake in relation to the Group Claims. These are Disbursement Costs and will be advanced on your behalf by the Funder under and subject to the terms of the Funding Agreement.</span> </p>
                                            <p class="p25 ft9"><span class="ft9">6.6.</span><span class="ft12">You will also be liable to pay the costs of any third-party service providers required for the purposes of the Group Claims, such as forensic accountants, economists, barristers or data analysts (all such costs being Disbursement Costs). Where possible, if the Committee wishes to do so, we will seek to agree that Disbursement Costs are payable on a contingent or deferred basis (as appropriate) so that they only become due for payment by you at the conclusion of the Group Claim. Where this is not possible (such as in the case of expert witnesses) or third-party providers are not prepared to defer fees, you will be liable to fund Disbursement Costs as they fall due, together with VAT as appropriate.</span> </p>
                                            <p class="p46 ft15"><span class="ft9">6.7.</span><span class="ft13">Although the Funder will advance the Disbursement Costs on your behalf in accordance with the Funding Agreement, you will remain ultimately liable for our expenses and disbursements (including expenses and disbursements which the Funder is not liable for or does not pay). If the Claim fails then, unless you have breached the Funding Agreement, you will not be obliged to reimburse the Funder for any Disbursement Costs it has paid on your behalf.</span> </p>
                                            <p class="p41 ft51">Sharing of common costs</p>
                                            <p class="p39 ft15"><span class="ft9">6.8.</span><span class="ft13">Where our costs are common to you and other Claimants, these will be shared across the Claimants as further set out at section 7 below. We also explain how costs and disbursements will be shared with the HP Claimants when such work is common to the HP Claimants.</span> </p>
                                            <p class="p99 ft51">Billing</p>
                                            <p class="p39 ft15"><span class="ft9">6.9.</span><span class="ft13">Pursuant to the terms of the Funding Agreement, the Funder will advance our Discounted Fees and the Disbursement Costs on your behalf up to the value of the Claim Funding under</span> </p>
                                            <p class="p299 ft8"><span class="ft8">7.</span><span class="ft114">Costs position on successful outcome to your Claim</span> </p>
                                            <p class="p55 ft19"><span class="ft9">7.1.</span><span class="ft33">Pursuant to Clause 6.1 of the LMA, if your Claim is successful, you will receive your Damages Award.</span> </p>
                                            <p class="p315 ft9"><span class="ft9">7.2.</span><span class="ft12">If your Claim is successful, you will be liable for and we will seek to recover from the Defendants on your behalf, to the fullest extent possible:</span> </p>
                                            <p class="p99 ft9"><span class="ft9">a)</span><span class="ft20">our Base Fees;</span> </p>
                                            <p class="p40 ft9"><span class="ft3">b)</span><span class="ft20">any expenses and disbursements that we have incurred in pursuing your Claim; and</span> </p>
                                            <p class="p103 ft9"><span class="ft9">c)</span><span class="ft23">(if applicable) any VAT which you or the Funder have had to pay on our fees or the expenses and disbursements which you are not able to recover.</span> </p>
                                            <p class="p316 ft19">You agree that any costs recovered from the Defendants will be paid in accordance with the terms of the Funding Agreement.</p>
                                            <p class="p45 ft9"><span class="ft9">7.3.</span><span class="ft12">Subject to the provisions of paragraph 8.4 below, you will remain liable to pay the balance of our fees, expenses and disbursements (including your Proportionate Share of the Common Disbursements), comprising:</span> </p>
                                            <p class="p317 ft9"><span class="ft9">a)</span><span class="ft20">any balance of our Base Fees which are not recovered from the Defendants, together with the Success Fee. The Success Fee is not recoverable from the Defendants and will therefore need to be paid in full by you;</span> </p>
                                            <p class="p318 ft9"><span class="ft3">b)</span><span class="ft20">the balance of any expenses or disbursements incurred on your behalf which are not recovered in full from the Defendants; and</span> </p>
                                            <p class="p104 ft9"><span class="ft9">c)</span><span class="ft23">any VAT element or our fees or disbursements which we are required to charge (if appropriate) and which cannot be recovered from the Defendants where you are able to reclaim the VAT;</span> </p>
                                            <p class="p104 ft9"><span class="ft3">d)</span><span class="ft20">for the avoidance of doubt, unless you breach these Engagement Terms and/or the Funding Agreement, your net liability (after recovery of any costs and/or disbursements from the Defendants) to pay us costs and disbursements under these Engagement Terms cannot in any circumstances exceed the Funding Fee as set out under paragraph 8.4(b) below.</span> </p>
                                            <p class="p44 ft19"><span class="ft9">7.4.</span><span class="ft33">Your liability for any unrecovered costs under paragraph 8.3 will be covered by the terms of the Funding Agreement under which you agree that:</span> </p>
                                            <p class="p319 ft9"><span class="ft9">a)</span><span class="ft20">you will receive 60% of the Damages Award (less any unrecovered VAT on our Conditional Fees, as defined in Clause 1 of the Funding Agreement); and</span> </p>
                                            <p class="p320 ft15"><span class="ft3">b)</span><span class="ft24">40% of the Damages Award (plus any unrecovered VAT on our Conditional Fees) and 100% of any recovered costs will be payable to the Funder to reimburse the Funder for its outlay, cover the Funder’s fee and pay any other outstanding sums to the insurer, us (whether under the Engagement Terms or these Subsequent Engagement Terms),</span> </p>
                                            <p class="p322 ft9">counsel and the US Consortium as set out in the Funding Agreement.</p>
                                            <p class="p109 ft9">As per Clause 2.2 of the Funding Agreement and Clause 3.2 of the Priorities Agreement, unless you terminate or breach these Subsequent Engagement Terms and/or the Funding Agreement, your liability for the purposes of paragraph 8.3 and 8.4 above is limited to the cap of the Funding Fee.</p>
                                            <p class="p24 ft9"><span class="ft9">7.5.</span><span class="ft12">In the event that our fees, disbursements and expenses cannot be agreed with the Defendants and it is necessary to undergo a detailed costs assessment in order to recover the costs, the provisions of this paragraph 8 will, subject to the terms of the Funding Agreement, also apply in respect of that detailed costs assessment.</span> </p>
                                            <br>
                                            <br>
                                            <p class="p26 ft11"><span class="ft8">8.</span><span class="ft111">Costs position on unsuccessful outcome to your Claim</span> </p>
                                            <p class="p39 ft9"><span class="ft9">8.1</span><span class="ft60">If your Claim is unsuccessful, you will not be liable to pay our Base Fees or the Success Fee save in the exceptional circumstances where our engagement is terminated prior to the conclusion of the Claim set out in paragraph 10 relating to the Costs associated with early termination. The Funder also agrees under Clause 2.3 of the Funding Agreement that you will not be obliged to pay back any of the disbursements or expenses (including the Common Disbursements) which have been advanced by the Funder if your Claim is not successful save where you terminate or breach the provisions of the Funding Agreement.</span> </p>
                                            <p class="p44 ft19"><span class="ft9">8.2</span><span class="ft66">The provisions of Clauses 9.2 and 9.5 of the Engagement Terms are hereby incorporated into these Subsequent Engagement Terms.</span> </p>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="card-header" id="headingThree">
                                      <h2 class="mb-0"> <i class="fa fa-plus"></i>
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree">Litigation Management Agreement</button>
                                      </h2>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                      <div class="card-body"> <img src="{{ $resourcePath }}img/logo.jpg" alt="">
                                        <p class="p5 ft6">Confidential</p>
                                        <p class="p6 ft6">Subject to common interest privilege</p>
                                        <p class="p2 ft1">M E R C E D E S - B E N Z E M I S S I O N S L I T I G A T I O N</p>
                                        <p class="p3 ft2"><strong style="border-top:1px solid #000;border-bottom:1px solid #000;padding: 20px 0;margin: 0 20px;">Litigation Management Agreement</strong> </p>
                                        <p class="p4 ft3">This is a legally binding contract between you, Hausfeld &amp; Co. LLP, and all the other people who have instructed Hausfeld to bring claims arising out of their purchase of <nobr>Mercedes-Benz</nobr>vehicles as part of a group claim.</p>
                                        <p class="p5 ft1">This document regulates how your claim and the claims of other members of the group shall be managed. To allow the claims to be brought jointly on a group basis it provides for the appointment of a committee who you and other claimants agree to authorise to take decisions in relation to the claim.</p>
                                        <p class="p6 ft3">The structure anticipates the likelihood of there being a number of different legal bases of claim as between the claimants, and claims being pursued against different defendants, but insofar as possible the structure allows for these claims to be pursued as a group. It covers the following areas:</p>
                                        <p class="p7 ft1"><span class="ft1">1.</span><span class="ft4">Date</span> </p>
                                        <p class="p8 ft1"><span class="ft1">2.</span><span class="ft4">Parties</span> </p>
                                        <p class="p8 ft1"><span class="ft1">3.</span><span class="ft4">Background</span> </p>
                                        <p class="p9 ft1"><span class="ft1">4.</span><span class="ft4">General obligations of the Claimants</span> </p>
                                        <p class="p8 ft1"><span class="ft1">5.</span><span class="ft4">Agreement to work with other Claimants</span> </p>
                                        <p class="p8 ft1"><span class="ft1">6.</span><span class="ft4">The Committee</span> </p>
                                        <p class="p8 ft1"><span class="ft1">7.</span><span class="ft4">Sharing of information, confidentiality and legal professional privilege</span> </p>
                                        <p class="p8 ft1"><span class="ft1">8.</span><span class="ft4">The Hausfeld Engagements, the Funding Agreement and the Claimants’ own costs</span> </p>
                                        <p class="p8 ft1"><span class="ft1">9.</span><span class="ft4">Costs sharing between the Claimants</span> </p>
                                        <p class="p8 ft1"><span class="ft1">10.</span><span class="ft5">Costs sharing between the Claimants and the HP Claimants</span> </p>
                                        <p class="p8 ft1"><span class="ft1">11.</span><span class="ft5">The Defendants’ costs and the Adverse Costs Cover</span> </p>
                                        <p class="p8 ft1"><span class="ft1">12.</span><span class="ft5">Sharing costs and risks with other claimant groups</span> </p>
                                        <p class="p8 ft1"><span class="ft1">13.</span><span class="ft5">Settlement and distribution of group damages</span> </p>
                                        <p class="p8 ft1"><span class="ft1">14.</span><span class="ft5">General matters relating to settlement and distribution</span> </p>
                                        <p class="p8 ft1"><span class="ft1">15.</span><span class="ft5">Your right to cancel</span> </p>
                                        <p class="p8 ft1"><span class="ft1">16.</span><span class="ft5">Termination</span> </p>
                                        <p class="p8 ft6"><span class="ft6">17.</span><span class="ft7">General matters</span> </p>
                                        <p class="p8 ft1"><span class="ft1">18.</span><span class="ft5">Commencement</span> </p>
                                        <p class="p8 ft1"><span class="ft1">19.</span><span class="ft5">Severability</span> </p>
                                        <p class="p8 ft1"><span class="ft1">20.</span><span class="ft5">Execution</span> </p>
                                        <p class="p10 ft1">Schedule 1: Constitution and Operation of the Committee</p>
                                        <p class="p11 ft8">Please read this document carefully before agreeing to its terms. It should be read in conjunction with the Hausfeld Engagements and the Funding Agreement/Funding Participation Agreement (as explained below). If you have any questions about this document, please contact <a href="mailto:MercedesEmissionsClaim@hausfeld.com">MercedesEmissionsClaim@hausfeld.com</a>.</p>
                                        <p class="p5 ft1">This document is confidential and contains intellectual property and work product which belongs to Hausfeld and other solicitors with whom it is collaborating. If you have not already instructed Hausfeld in the <nobr>Mercedes-Benz</nobr>Emissions Litigation, or if you do not in good faith intend to instruct Hausfeld in the <nobr>Mercedes-Benz</nobr>Emissions Litigation, then you must not read, share, or use this document.</p>
                                        <br>
                                        <br>
                                        <p class="p15 ft2"><span class="ft11">1</span><span class="ft12">Date</span> </p>
                                        <p class="p16 ft1">The date of this Agreement is the date upon which you click to accept its terms.</p>
                                        <p class="p17 ft2"><span class="ft11">2</span><span class="ft12">Parties</span> </p>
                                        <p class="p16 ft1">This is an Agreement made between:</p>
                                        <p class="p18 ft1"><span class="ft13">(1)</span><span class="ft14">You;</span> </p>
                                        <p class="p18 ft1"><span class="ft13">(2)</span><span class="ft14">Hausfeld &amp; Co. LLP of 12 Gough Square, London, EC4A3DW (“</span><span class="ft2">Hausfeld</span>”); and</p>
                                        <p class="p19 ft1"><span class="ft13">(3)</span><span class="ft14">all of the other persons (together referred to in this document as ‘</span><span class="ft2">Claimants</span>’, and individually each as a ‘<span class="ft2">Claimant</span>’) who instruct Hausfeld in the group claim relating to the purchase of their <nobr>Mercedes-Benz</nobr>vehicle and agree to this contract and whose names, addresses, and the date of signing of this Agreement will be recorded in a register or registers to be kept by Hausfeld.</p>
                                        <p class="p20 ft2"><span class="ft11">3</span><span class="ft12">Background</span> </p>
                                        <p class="p21 ft1"><span class="ft13">(A)</span><span class="ft15">You and the other Claimants are entering into this Agreement in order to bring claims against Daimler AG, </span> <nobr>Mercedes-Benz</nobr>Cars UK Limited, <nobr>Mercedes-Benz</nobr>Financial Services UK Limited and/or any relevant subsidiary or associated entities, authorised agents or dealers (together, <nobr>‘<span class="ft2">Mercedes-Benz</span>’,</nobr>or the ‘<span class="ft2">Defendant</span>’) which arise out of losses suffered by you as a result of purchasing a <nobr>Mercedes-Benz</nobr>branded vehicle fitted with a diesel engine during the relevant period. In this Agreement, your individual claim is referred to as your ‘<span class="ft2">Claim</span>’, and the claims of the Claimants as a whole are referred to as the ‘Group <span class="ft2">Claims</span>’.</p>
                                        <p class="p22 ft1"><span class="ft13">(B)</span><span class="ft15">This Agreement (the ‘</span><span class="ft2">Agreement</span>’) sets out the Agreement between Hausfeld, you and the other Claimants about how the Group Claims will be managed.</p>
                                        <p class="p23 ft1"><span class="ft13">(C)</span><span class="ft15">By this Agreement, you (and the other Claimants) confirm that you understand what your Claim is about, you acknowledge that the Claim may not succeed and may involve some financial risk (as explained at Clause 4.9 below), that you authorise Hausfeld to issue, serve and pursue a Claim on your behalf and that you understand in doing so that you have obligations to the court.</span> </p>
                                        <p class="p24 ft1"><span class="ft13">(D)</span><span class="ft16">You acknowledge that in agreeing to the terms of this Agreement and its associated documents, you instruct Hausfeld to investigate whether a Claim can be brought, give Hausfeld the discretion to decide whether or not any such Claim is viable to bring as part of the Group Claims and agree that if in Hausfeld’s discretion it is not viable, then Hausfeld has no duty or obligation to seek to bring it. In such circumstances Hausfeld will notify you of its decision.</span> </p>
                                        <p class="p23 ft1"><span class="ft13">(E)</span><span class="ft17">To allow the Group Claims to be pursued effectively on a group basis you and the other Claimants agree in this Agreement to appoint a committee of claimants (the ‘</span><span class="ft2">Committee</span>’) to take certain decisions on your behalf and on behalf of other members of the claimant group. These are described below at clause 6 and include how the Group Claims are to be grouped and managed.</p>
                                        <p class="p25 ft20"><span class="ft13">(F)</span><span class="ft18">You and each of the Claimants have entered two Conditional Fee Agreements with Hausfeld in respect of your Claim (the “</span><span class="ft19">Hausfeld Engagements</span>”) and a Litigation Funding Agreement (“<span class="ft19">Funding Agreement</span>”) with CF BH Claim Ltd. a company serviced by Black Hammer Capital Limited (http://www.blackhc.com) (the “<span class="ft19">Funder</span>”). In the event that any term of the Hausfeld Engagements or the Funding Agreement is in conflict with any term in this Agreement, the Funding Agreement will take precedence with the exception of any regulatory requirements in respect of which the Hausfeld Engagements will apply. Insofar as consistent with the Funding Agreement, the terms of the Hausfeld Engagements, will take precedence over this Agreement.</p>
                                        <p class="p25 ft20"><span class="ft13">(G)</span><span class="ft22">Hausfeld has entered into a </span> <nobr>co-operation</nobr>agreement with Harcus Parker Limited (the "<span class="ft19">Cooperation Agreement" </span>and "<span class="ft19">Harcus Parker</span>", respectively). Harcus Parker also acts for owners of affected <nobr>Mercedes-Benz</nobr>vehicles who intend to bring materially similar claims to the Group Claims (the "<span class="ft19">HP Claimants"</span>). The Claimants recognise and agree in signing this Agreement that <nobr>co-operation</nobr>with the HP Claimants will enable the Group Claims and the claims of the HP Claimants to be brought more efficiently and effectively. The Claimants authorise Hausfeld to act in accordance with the terms of Cooperation Agreement, which provides for work that is common to the Group Claims to be carried out jointly on behalf of both the Claimants and the HP Claimants. The Claimants also agree that Hausfeld and Harcus Parker are authorised to consider whether it may be in the best interests of the Claimants and the HP Claimants to <nobr>co-operate</nobr>with any additional claimants who may pursue similar claims to the Group Claims.</p>
                                        <p class="p23 ft1"><span class="ft13">(H)</span><span class="ft16">To facilitate the </span> <nobr>co-operation</nobr>with the HP Claimants, you agree that where we advise the Committee that it would be helpful to do so, the Committee may form a Joint Steering Committee (the “<span class="ft2">Joint Committee</span>”) between its members and members of the committee representing the HP Claimants (the “<span class="ft2">HP Committee</span>”) for the purposes of taking key decisions in relation to the Group Claims which affect both the Hausfeld Claimants and the HP Claimants. You also agree that if we decide it is in the best interests of the Claimants to <nobr>co-operate</nobr>with any additional claimants who may pursue similar claims to the Group Claims or that the Group Claims are ordered to be pursued jointly by the court with other claimants, representatives of those claimants may also be asked to participate in the Joint Committee.</p>
                                        <p class="p30 ft3"><span class="ft13">(I)</span><span class="ft23">You acknowledge that you have either taken independent legal advice in relation to the arrangements set out in this Agreement or that you are content to proceed without such advice.</span> </p>
                                        <p class="p31 ft1"><span class="ft13">(J)</span><span class="ft24">You accept that in joining the Group Claims you are joining a group of claimants who are collectively pursuing a claim that is suitable to be run as a group of claims. In doing so, you gain the advantages of economies of scale and access to funding and adverse costs protection. However, you accept that you are not being advised on whether you may have alternative causes of action other than those being brought collectively through the Group Claims; nor are you being advised on the possibility of being able to bring different claims against other defendants.</span> </p>
                                        <p class="p17 ft2"><span class="ft11">4</span><span class="ft12">General Obligations of the Claimants</span> </p>
                                        <p class="p16 ft1">You agree and acknowledge that:</p>
                                        <p class="p32 ft1">4.1 by executing this Agreement, the Hausfeld Engagements and the Funding Agreement, you are instructing Hausfeld to investigate whether a Claim can be brought on your behalf. You give Hausfeld the discretion to decide whether or not any such Claim is viable to include in the Group Claim and agree that if in Hausfeld’s discretion the Claim is not viable, then Hausfeld has no duty or obligation to seek to bring it. In such circumstances Hausfeld will notify you of its decision;</p>
                                        <p class="p33 ft1">4.2 Hausfeld will only be able to investigate your Claim when you have both:</p>
                                        <p class="p34 ft1"><span class="ft13">a)</span><span class="ft4">completed the registration process and confirmed your agreement to the Hausfeld Engagements, the Funding Agreement and this Agreement; and</span> </p>
                                        <p class="p35 ft1"><span class="ft13">b)</span><span class="ft4">fully completed the information questionnaire (the "</span><span class="ft2">Questionnaire</span>") providing the details required to pursue the Claim</p>
                                        <p class="p36 ft1">and you acknowledge that a partial completion of the registration process will not result in you becoming a Claimant and receiving a confirmatory email.</p>
                                        <p class="p37 ft1">4.3 that the Group Claims will only be issued on your behalf when:</p>
                                        <p class="p38 ft3"><span class="ft13">a)</span><span class="ft25">a sufficient number of Claimants have agreed to pursue the Group Claims to meet the minimum group size in the Funding Agreement of 27,500 Claimants; and</span> </p>
                                        <p class="p39 ft20"><span class="ft13">b)</span><span class="ft26">the Funder has confirmed that it has put in place an insurance policy (the “</span><span class="ft19">Insurance</span>”) to cover its exposure under the Adverse Costs Cover (as defined below) which protects the Claimants and the HP Claimants against adverse cost risk up to a limit of £7.5 million if the Group Claims or any aspect of them were not successful and the Claimants were ordered to pay the Defendant’s costs or some element of them.</p>
                                        <p class="p40 ft1">4.4 you have a duty to the Court to provide information in relation to the Claim which is accurate and true to the best of your knowledge and honest belief and that proceedings for contempt of court may be brought against you if you make, or cause to be made, a false statement in a document verified by a statement of truth without an honest belief in its truth;</p>
                                        <p class="p41 ft1">4.5 you are responsible for the accuracy of the information you supply to Hausfeld and for the consequences of its being inaccurate and that Hausfeld has no duty to you to check the accuracy of the information supplied;</p>
                                        <p class="p40 ft1">4.6 an employee or partner of Hausfeld is authorised to sign a Statement of Truth on your behalf in relation to the information you provide in the Questionnaire confirming that the information is accurate and true to the best of your knowledge and in your honest belief and that you understand that proceedings for contempt of court may be brought against anyone who makes, or causes to be made, a false statement in a document verified by a statement of truth without an honest belief in its truth;</p>
                                        <p class="p41 ft1">4.7 you will act in good faith in applying this Agreement in accordance with the common objective of managing and pursuing the Group Claims to obtain maximum possible damages overall and to share costs liabilities in accordance with the principles set out in this Agreement;</p>
                                        <p class="p32 ft1">4.8 you will respond promptly to communications from the Committee and Hausfeld, and will provide all possible assistance to Hausfeld in connection with the Group Claims, including as to:</p>
                                        <p class="p42 ft1">a) the disclosure of documents and data; and</p>
                                        <p class="p43 ft1">b) the drafting of witness statements,</p>
                                        <p class="p44 ft3">4.9 in doing so you recognise that if you do not, you could damage your Claim and the best interests of your fellow Claimants;</p>
                                        <p class="p45 ft8">you acknowledge that whilst the Funding Agreement mitigates the risks for you and other Claimants by advancing the Costs on your behalf which are recoverable only if the Group</p>
                                        <p class="p46 ft1">Claims are successful and agreeing to cover you, other Claimants and the HP Claimants against any Order to pay the Defendant’s costs up to the level of the Insurance in circumstances where the Insurance pays out, there are certain risks in pursuing the Group Claims:</p>
                                        <p class="p47 ft1"><span class="ft1">a)</span><span class="ft27">that there is a risk that the Group Claims may not succeed;</span> </p>
                                        <p class="p48 ft1"><span class="ft13">b)</span><span class="ft27">as set out in the Funding Agreement, the Funder has agreed to advance for the Claimants the Costs of pursuing the Group Claims on a </span> <nobr>non-recourse</nobr>basis provided that the Claimants comply with their obligations, but may seek your share of the Costs back from you if you do not comply with the Funding Agreement;</p>
                                        <p class="p49 ft20"><span class="ft13">c)</span><span class="ft28">that the Funder has agreed to put in place the Insurance based on a good faith estimate of the Defendants’ potential costs, but that it is possible that this policy limit could be exceeded or the Insurer refuse to pay out under the Insurance if the Claimants do not comply with their obligations in which case the Claimants would be severally liable for their share of the Defendant’ costs that were not covered by the Insurance; and</span> </p>
                                        <p class="p50 ft1"><span class="ft13">d)</span><span class="ft27">that if certain Claimants succeed in the Group Claims and other Claimants do not, any adverse costs may not be covered by the Insurance, in which case any costs payable to the Defendants will, subject to clause 11.4 below, be paid for from the successful Claimants’ 60% share of their recovery, paid pursuant to the terms of the Funding Agreement (as explained at Clause 8.2 below);</span> </p>
                                        <p class="p51 ft1">4.10 you acknowledge that the Funding Agreement contains important obligations and that you have read, understood and will comply with its terms; and</p>
                                        <p class="p32 ft1">4.11 you will keep this Agreement and its terms confidential unless required by the court to disclose it in the Group Claims or for the purpose of determining a dispute pursuant to clause 13.6.</p>
                                        <p class="p17 ft2"><span class="ft11">5</span><span class="ft12">Agreement to work with other Claimants</span> </p>
                                        <p class="p52 ft1">You and the other Claimants acknowledge that there may be differing aspects to the Group Claims, including as to the vehicles to which they relate, the date on which the vehicles were purchased, the types of claim and bases on which they may be brought and the potential value of the Group Claims, but that the Group Claims all share common issues and there is a common interest in bringing your Group Claims together and under common management. By signing up to this Agreement, you warrant that you have no interest which is adverse to the success of the Group Claims, including any position or interest in or any connection with any Daimler or Mercedes entity.</p>
                                        <p class="p32 ft1">5.1 You acknowledge that the Claimants’ common interest lies in obtaining a successful outcome to the Group Claims and securing the largest possible sum from the Defendants. This could be as a result of the court awarding a sum of compensation following a trial of the Group Claims or as a result of the Defendants to your Claim making you an earlier offer of settlement which is accepted on your behalf by the Committee (as to which, see further at clause 13 below). The money recovered by all the Claimants, whether as a result of a settlement or the decision of the court, is referred to collectively in this Agreement as the ‘<span class="ft2">Overall Claim Proceeds</span>’.</p>
                                        <p class="p51 ft1">5.2 You acknowledge in signing this Agreement and agreeing to pursue your Claim on a group basis that if the Group Claims result in a successful judgment at trial, the court may order that some Claimants are compensated in a different way from others because of their individual circumstances or a defendant may offer to settle the Group Claims on different terms to different Claimants.</p>
                                        <p class="p53 ft20">5.3 You also acknowledge and accept that circumstances may arise in which it would be expedient not to take detailed account of the individual issues of each Claimant’s case in the allocation of the Overall Claim Proceeds to Claimants because it would otherwise be very expensive and burdensome to work out a division in line with those detailed issues.</p>
                                        <p class="p17 ft2"><span class="ft11">6</span><span class="ft12">The Committee</span> </p>
                                        <p class="p52 ft1">6.1 To allow the Group Claims to be brought effectively on a group basis, you acknowledge and agree to the appointment of a Committee who will be authorised by you and each of the other Claimants to provide instructions to Hausfeld to pursue the Group Claims and to take decisions as to the strategy, case management, any settlement discussions and, if the Claims succeed in whole or part, the distribution of any Overall Claim Proceeds. The Committee will be constituted and authorised to operate on the terms set out in this Clause 6 and Schedule 1.</p>
                                        <p class="p41 ft1">6.2 Subject to the provisions of this Agreement, each Claimant appoints the Committee to be his or her agents in relation to the Group Claims and confirms that the Committee may execute documents on their behalf and/or give instructions to Hausfeld in relation to the conduct of the Group Claims, including without limitation:</p>
                                        <p class="p54 ft29">a) discontinuance by all Claimants, or any one or more of them where advised to do so by Hausfeld and/or Counsel in accordance with the terms of the Funding Agreement;</p>
                                        <p class="p55 ft1">b) the entry into and conduct of settlement negotiations;</p>
                                        <p class="p56 ft1">c) subject to <nobr>sub-clause</nobr>13.8 below, the acceptance and making of offers to settle in full and final settlement of the Group Claims (including the acceptance and making of offers in accordance with the Settlement and Distribution of Group Damages at Clause 13 below);</p>
                                        <p class="p56 ft1">d) the instruction of Counsel, experts and the incurring of any other <nobr>third-party</nobr>liability that Hausfeld advise is necessary for the conduct of the Group Claims;</p>
                                        <p class="p56 ft1">d) the approval of the terms of any policies of Adverse Costs insurance taken out by the Funder pursuant to the Funding Agreement;</p>
                                        <p class="p57 ft1">f) agreement with the Funder to the terms of the Funding Agreement and the Priorities Agreement (which sets out the way in which Overall Claim Proceeds will be distributed (the “<span class="ft2">Priorities Agreement</span>”)), which will each be signed by the Chairperson and by which each Claimant will be asked to agree via the Funding Participation Agreement;</p>
                                        <p class="p58 ft1">g) the negotiation and agreement with the Funder on behalf of the Claimants to any amendments to the terms of the Funding Agreement and the Priorities Agreement which:</p>
                                        <p class="p59 ft3"><span class="ft30">I.</span><span class="ft31">do not impact on the share of recoveries obtained by the Claimants such that each Claimant will still receive 60% of the damages recovered less any unrecovered VAT payable on Conditional Fees; or</span> </p>
                                        <p class="p60 ft1"><span class="ft30">II.</span><span class="ft32">vary the share of recoveries obtained by the Claimants in order to accommodate the Insurance should this prove necessary and the Committee believe it is in the Claimants’ best interests to do so to allow the Group Claims to proceed, but subject to each Claimant's right within 14 days of notification of the required amendment to discontinue their Claim in accordance with Clause 10.3 of the Funding Agreement;</span> </p>
                                        <p class="p61 ft1">h) liaising with the HP Committee as participants in the Joint Committee and any other representatives of the Claimants with whom the Committee agrees to collaborate and</p>
                                        <p class="p43 ft1">i) strategy generally.</p>
                                        <p class="p62 ft1">6.3 Each Claimant in addition agrees:</p>
                                        <p class="p63 ft8">a) that the Committee may do any ancillary necessary act and execute any ancillary necessary document on his or her behalf insofar as necessary to pursue the Group Claims pursuant to the terms of the Hausfeld Engagements and Funding Agreement and/or to further the prospects of obtaining a successful outcome to the Group Claims and in each case considered to be in the best interests of the Claimants; and</p>
                                        <p class="p64 ft1">b) to ratify and to confirm anything the Committee does or executes on their behalf in relation to the Group Claims in the proper execution of its role.</p>
                                        <p class="p65 ft3">6.4 The membership of the Committee and the rules governing the Committee’s functions are contained in Schedule 1 to this Agreement.</p>
                                        <p class="p66 ft2"><span class="ft11">7</span><span class="ft12">Sharing of information, confidentiality and legal professional privilege</span> </p>
                                        <p class="p52 ft1">7.1 Information which is confidential to the Claimants shall be referred to as <span class="ft2">‘Confidential Information’</span>. This will include any information and documents provided by a Claimant to Hausfeld for the purposes of the Group Claims save as already in the public domain or which requires to be disclosed to the Court and the Defendant or otherwise made public for the purposes of the Group Claims.</p>
                                        <p class="p67 ft1">7.2 You and each other Claimant agrees that unless otherwise ordered by the Court:</p>
                                        <p class="p68 ft1">a) the facts of your individual Claims disclosed to Hausfeld by the Claimant or by any other party in or third party to the Group Claims; and</p>
                                        <p class="p42 ft1">b) any documents produced by you or to you through disclosure,</p>
                                        <p class="p51 ft1">can be (i) disclosed by Hausfeld, on a common interest basis, to their fellow Claimants, the Funder and the Committee; and (ii) used by Hausfeld in the proceedings in so far as Hausfeld considers it necessary or helpful to compare the facts of individual Claims for the purposes of advising on and conducting the common aspects of the Group Claims. The Claimants’ Confidential Information will be shared on terms of mutual confidentiality and without any waiver of privilege.</p>
                                        <p class="p32 ft1">7.3 You and each other Claimant also agrees that the matters outlined at <nobr>sub-clause</nobr>7.2, above, can be disclosed by Hausfeld to Harcus Parker and the HP Claimants, in so far as Hausfeld considers it necessary or helpful in the Claimants’ best interests to share such information for the furtherance of a successful outcome in relation to the Group Claims, and on the condition that any such information is shared on a confidential basis, and remains subject to common interest privilege.</p>
                                        <p class="p51 ft1">7.4 You and each other Claimant agrees to disclose the facts and terms of any offer to settle any of the Group Claims made to you by the Defendants to Hausfeld and to the Committee, and that Hausfeld and the Committee may then disclose that information to other Claimants and to the Funder and to Harcus Parker and the HP Claimants where appropriate unless specifically prevented from doing so under the terms of the offer.</p>
                                        <p class="p69 ft8">7.5 You and each other Claimant further agree that, if Hausfeld considers it to be necessary or helpful for the purposes of furthering the chances of a successful outcome in relation to the Group Claims, it may use information or documents derived from one Claimant’s individual Claim in any other Claimant’s individual Claim or in the Group Claims in general and share such information with Hausfeld provided that information will be used on an anonymised basis unless required to be disclosed to the Court and the Defendant.</p>
                                        <p class="p37 ft1">7.6 You and each other Claimant agrees that:</p>
                                        <p class="p70 ft3"><span class="ft13">a)</span><span class="ft33">any information shared amongst the Claimants and between the Claimants and the Committee pursuant to clauses 7.1 to 7.5 above;</span> </p>
                                        <p class="p71 ft3"><span class="ft13">b)</span><span class="ft34">any advice or communications provided by Hausfeld and any other </span> <nobr>third-party</nobr>advisors in relation to the Group Claims;</p>
                                        <p class="p72 ft3"><span class="ft1">c)</span><span class="ft33">the contents of this Agreement, the Hausfeld Engagements and the Funding Agreement; and</span> </p>
                                        <p class="p73 ft1"><span class="ft13">d)</span><span class="ft35">any communication from the Committee to the Claimants:</span> </p>
                                        <p class="p32 ft1">shall remain fully confidential as against any person who is not either a Claimant or a professional adviser of a Claimant with a duty of confidentiality to that Claimant and that you will keep all such information fully confidential and will not disclose to any person who is not either a Claimant or a professional adviser of a Claimant with a duty of confidentiality to the Claimants for the purposes of obtaining professional advice in relation to the Group Claim.</p>
                                        <p class="p51 ft3">7.7 If a Claimant ceases to be a party to this Agreement as a result of clauses 16.1 – 16.4 below, that Claimant’s duty of confidentiality shall continue with full force and effect.</p>
                                        <p class="p74 ft1">7.8 You and each other Claimant agree that Hausfeld’s duty to report to its clients shall be satisfied by Hausfeld reporting to the Committee and that it may be in the best interests of the Claimants as a whole for communications with them to be limited because of the risk that sensitive, confidential, and privileged information may be passed to the Defendants but that Hausfeld will provide updates in relation to the status of the Group Claims via the website and notifications of such updates on a periodic basis where there has been substantive progress in the Claims and the timetable.</p>
                                        <p class="p51 ft1">7.9 All communications between Hausfeld and the Claimants or any of them shall be subject to legal professional privilege and the Claimants irrevocably agree that <nobr>solicitor-client</nobr>privilege shall not be waived or abrogated from in any way by the passing of Confidential Information amongst the Claimants. You and each other Claimant agrees that Hausfeld shall be authorised to report to the Committee or to the Claimants on an anonymised basis unless such information is in the public domain on the facts underlying each Claimant’s Claim where in the best interests of pursuing the Group Claims, including the facts stated in the evidence disclosed by the Defendant.</p>
                                        <p class="p32 ft1">7.10 You and each other Claimant agrees that Hausfeld may, for reasons of cost efficiency or otherwise, instruct third party advisors or providers to manage some of the administrative burden of the Group Claims and, in particular:</p>
                                        <p class="p75 ft3">to process and collate information from responses to identity checks required for compliance purposes;</p>
                                        <p class="p76 ft1">a) to maintain a secure database to store and organise information about the Group Claims and the Claimants; and</p>
                                        <p class="p42 ft1">b) to administer the distribution of the Overall Claim Proceeds;</p>
                                        <p class="p77 ft1">c) on the basis that any such <nobr>third-party</nobr>advisor or provider will first agree to keep any Confidential Information confidential.</p>
                                        <p class="p15 ft2"><span class="ft11">8</span><span class="ft12">The Hausfeld Engagements, the Funding Agreement and the Claimants’ owncosts</span> </p>
                                        <p class="p78 ft1">8.1 All Claimants will instruct Hausfeld under the Hausfeld Engagements, underwhich:</p>
                                        <p class="p79 ft1"><span class="ft13">a)</span><span class="ft36">Hausfeld will operate under the terms of one engagement letter for the period within which Hausfeld’s fees are </span> <nobr>part-paid</nobr>by the Funder from the litigation budget (the “<span class="ft2">First Engagement</span>”) and under their second engagement letter once the litigation budget has been exhausted and no further funding is agreed (the “<span class="ft2">Subsequent Engagement</span>”).</p>
                                        <p class="p47 ft1"><span class="ft13">b)</span><span class="ft36">Under the First Engagement:</span> </p>
                                        <p class="p80 ft20"><span class="ft13">i)</span><span class="ft37">Hausfeld will charge 55% of their agreed hourly rates (together with VAT) for the time spent on the Group Claims up to conclusion together with the disbursements and expenses (including Common Disbursements, as defined at clause 10 below) which we incur on your behalf, which will be billed to the Committee on a monthly basis or at such other time as agreed with the Committee and the Funder and paid on the Claimants’ behalf by the Funder under the Funding Agreement; and</span> </p>
                                        <p class="p81 ft1"><span class="ft13">ii)</span><span class="ft38">The remaining 45% of Hausfeld’s fees will only be payable in the event that the Group Claims are successful (or in certain circumstances in which a claimant discontinues its Claim or does not </span> <nobr>co-operate</nobr>in pursuing the Group Claims) and subject to a success fee of 45% of the base fees as set out in the First Engagement; and</p>
                                        <p class="p82 ft1"><span class="ft13">c)</span><span class="ft39">Under the Subsequent Engagement: Hausfeld will defer 100% of its fees such that Hausfeld will only be paid these fees to the extent that the Group Claims are successful (or in certain circumstances in which a claimant discontinues its Claim or does not </span> <nobr>co-operate</nobr>in pursuing the Group Claims) and subject to a success fee which is 100% of the base fees, as set out in the Subsequent Engagement.</p>
                                        <p class="p82 ft3"><span class="ft13">d)</span><span class="ft40">Hausfeld will notify the Committee at the point at which Hausfeld begin acting under the terms of the Subsequent Engagement and Hausfeld will also notify the Claimants of this directly.</span> </p>
                                        <p class="p83 ft8">The Hausfeld fees together with associated disbursements, as referred to below, as the “<span class="ft41">Costs</span>” of the Claims. The deferred fees and success fee will be paid from sums recovered by the Claimants from the Defendant and paid out of the Funding Fee (as defined below);</p>
                                        <p class="p84 ft1">8.2 By signing the Funding Participation Agreement (or in the case of the Chair also signing the Funding Agreement and the Priorities Agreement), you agree to the terms of the Funding Agreement and the Priorities Agreement. The Funding Agreement sets out the terms on which the Funder agrees to:</p>
                                        <p class="p79 ft1"><span class="ft13">a)</span><span class="ft36">pay Hausfeld’s </span> <nobr>non-deferred</nobr>fees and any other costs of bringing the Group Claims on your behalf on terms that they will not <nobr>re-payable</nobr>if your Claim is not successful unless you fail properly to pursue the Claim or otherwise breach the Hausfeld Engagements, the Funding Agreement or this Agreement; and</p>
                                        <p class="p85 ft29"><span class="ft13">b)</span><span class="ft42">pay any sums you and the other Claimants have to pay in respect of the defendants' costs ("</span><span class="ft43">Adverse Costs</span>") up to the sums paid out by the provider of the Insurance;</p>
                                        <p class="p86 ft20">in exchange for an agreed fee to be paid by the Claimants from the Overall Claim Proceeds (the ‘<span class="ft19">Funding Fee</span>’). The effect of the Hausfeld Engagements, the Funding Agreement and Priorities Agreement is that Claimants will be entitled to retain 60% of their damages subject to deduction of any unrecovered VAT on Conditional Fees (as defined in clause 1 of the Funding Agreement). The only circumstance in which the Funding Fee would be varied would arise where the Funder was not able to secure Insurance on appropriate terms without amending the Funding Fee, in which case each Claimant would have the right to choose to discontinue its participation as set out in Clause 11.4 below.</p>
                                        <p class="p37 ft1">8.3 In the event that the Group Claims do not succeed, you and each other Claimant:</p>
                                        <p class="p87 ft3">a) will not be liable for to pay any fees or disbursements provided they have complied with the terms of the Hausfeld Engagements, the Funding Agreement and this Agreement; and</p>
                                        <p class="p88 ft3">b) will be indemnified in respect of paying Adverse Costs to the Defendant up to the level of the Insurance.</p>
                                        <p class="p89 ft8">8.4 You and each other Claimant agrees that, insofar as it may be possible to run the common elements of their Claims jointly, the common costs of the Claimants in pursuing the Group Claims (‘<span class="ft41">Common Costs</span>’) will be shared in accordance with this Agreement.</p>
                                        <p class="p52 ft3">8.5 You and each other Claimant acknowledges however that not all of the costs of bringing the Claims will be Common Costs. Costs which are not Common Costs may be either:</p>
                                        <p class="p90 ft3">a) costs which relate to elements of Claimants’ individual claims which are unique to individual Claimants, where those individual Claimants have not been selected as ‘test cases’ or ‘lead cases’ or the like (‘<span class="ft44">Individual Costs</span>’); or</p>
                                        <p class="p91 ft3">b) the costs of dealing with specific issues which apply to some but not all Claimants (<span class="ft44">‘Issue Costs’</span>).</p>
                                        <p class="p92 ft1">8.6 You and each other Claimant acknowledges that as at the date of this Agreement it is not possible to predict how many different Claims there may be, on what themes and against how many Defendants. There may be Common Costs, Individual Costs and Issue Costs within each Claim.</p>
                                        <p class="p51 ft1">8.7 Subject to any order of the court to a different effect, you and each other Claimant agrees that Individual Costs and Issue Costs within the Group Claims or groupings of Group Claims will be treated as Common Costs unless Hausfeld decides, at its discretion and after consultation with the Committee, that it would be fair and proportionate to treat certain costs as being either Individual or Issue Costs. In exercising this discretion, Hausfeld will have regard to the administrative costs of distinguishing between different kinds of costs and the utility of the distinction, bearing in mind its potential impact as well as the amount of costs at issue.</p>
                                        <p class="p32 ft1">8.8 You and each other Claimant agrees to apply for an order or orders that as far as possible their Claims be managed together and agree that the costs of any lead or test case or cases within the Group Claims will be treated as Common Costs.</p>
                                        <p class="p69 ft1">8.9 You and each other Claimant acknowledges and agrees that Hausfeld will need to incur expenses in order to bring the Claims. These are referred to in this Agreement, the Hausfeld Engagements and the Funding Agreement as the ‘<span class="ft2">Disbursements</span>’ and include:</p>
                                        <p class="p43 ft1">a) counsel’s fees;</p>
                                        <p class="p93 ft1">b) fees for experts;</p>
                                        <p class="p42 ft1">c) court fees;</p>
                                        <p class="p42 ft1">d) the costs of data rooms, disclosure platforms and electronic bundling systems;</p>
                                        <p class="p96 ft1">e) photocopying charges;</p>
                                        <p class="p97 ft1">f) the costs of marketing and PR and the costs of establishing and maintaining a case website;</p>
                                        <p class="p43 ft1">g) the costs of distributing to Claimants their damages; and</p>
                                        <p class="p68 ft3">h) any other expense which Hausfeld reasonably believes necessary in order to bring the Claims.</p>
                                        <p class="p98 ft1">Disbursements may be either Common Costs, Issue Costs or Individual Costs.</p>
                                        <p class="p32 ft3">8.10 Disbursements which are required to be paid up front will be advanced by the Funder in accordance with and subject to the Funding Agreement.</p>
                                        <p class="p74 ft20">8.11 By entering into this Agreement you and each other Claimant agrees that your share of the Common Costs or Issue Costs where relevant to you, as further set out in clause 9 below under the title ‘Costs Sharing’, shall be calculated as though Hausfeld had begun to act for each Claimant on the date on which Hausfeld began acting in relation to the Group Claims.</p>
                                        <p class="p18 ft2">Submissions of invoices to the Committee</p>
                                        <p class="p40 ft1">8.12 The Claimants agree that Hausfeld will report on Costs to the Committee, which will be responsible for approving invoices, and will not otherwise be required to reportseparately to the Claimants until the conclusion of the Group Claims. For the avoidance of doubt, Hausfeld will have no duty to produce itemised reports showing each Claimant’s share of the Costs, save for at the conclusion of the Group Claims, and only to the extent that it is necessary for costs recovery or invoicing purposes.</p>
                                        <p class="p33 ft1">8.13 The Claimants agree as follows:</p>
                                        <p class="p33 ft45">Disbursements</p>
                                        <p class="p56 ft1">a) Hausfeld will submit invoices to the Committee for Disbursements on a monthly basis or any other periodic basis agreed with the Committee and the Funder. These invoices will make clear that the primary liability for Disbursements is the Claimants’, even though the Funder will advance these costs on their behalf under the terms of the Funding Agreement.</p>
                                        <p class="p47 ft45">Hausfeld’s fees</p>
                                        <p class="p99 ft20">b) Hausfeld will submit invoices to the Committee for their <nobr>non-deferred</nobr>fees incurred on the Group Claims on a monthly basis or any other periodic basis agreed with the Committee and the Funder and such fees will be calculated in accordance with the Hausfeld Engagements. These invoices will make clear that the primary liability for Hausfeld’s fees is the Claimants’, even though the Funder will advance these costs on their behalf under the terms of the Funding Agreement.</p>
                                        <p class="p100 ft2"><span class="ft11">9</span><span class="ft12">Costs sharing between the Claimants</span> </p>
                                        <p class="p52 ft3">9.1 The following provisions will apply to the allocation of Costs between the Claimants, although as set out at Clause 8 above, the Costs will be met by the Defendant and/or covered by the terms of the Funding Agreement.</p>
                                        <p class="p83 ft8">9.2 For the purposes of allocation, you and each other Claimant agrees that, unless the court orders otherwise, the amount of Costs referable to each Claimant in relation to Common Costs and Issue Costs shall be calculated on a several (not joint) liability basis as follows:</p>
                                        <p class="p101 ft1">a) for the purposes of Common Costs in accordance with the number of vehicles in respect of which you are claiming as a percentage of the number of vehicles in respect of which all the Claimants claim;</p>
                                        <p class="p102 ft3">b) in the case of Issue Costs, in accordance with the number of vehicles in respect of which you are claiming as a percentage of the number of vehicles in respect of which all the Claimants affected by that issue claim; and</p>
                                        <p class="p103 ft20">c) additionally in either a) and/or b) immediately above, each Claimant who obtains an order for any Defendant to pay that Claimant’s Common Costs shall also be liable to indemnify the share of the Common and/or Issue Costs of any other Claimant who does not obtain such an order (the liability for such indemnity being only to the extent that the Common and/or Issue Costs of such unsuccessful Claimant are recovered from a Defendant, and the liability for such indemnity is calculated on a several basis in the same proportions between the successful Claimants alone as in</p>
                                        <p class="p104 ft48"><span class="ft1">a)</span><span class="ft46">or b) respectively, as may be the case, immediately above). in each case (the “</span><span class="ft47">Proportionate Share</span>”).</p>
                                        <p class="p105 ft1">9.3 Each Claimant agrees that:</p>
                                        <p class="p106 ft8">a) Hausfeld is entitled to allocate to them, within each Claim they pursue, a Proportionate Share of all work undertaken in respect of Common Costs and any relevant Issue Costs from the date Hausfeld started to work on the Group Claims; and</p>
                                        <p class="p107 ft1">b) Hausfeld is entitled to exercise a discretion as to whether to allocate costs proportionally to different Group Claims or types of Group Claim.</p>
                                        <p class="p32 ft1">9.4 The Claimants recognise and agree that, within each Claim they pursue, unless the court orders otherwise, the Proportionate Share shall be calculated using the time periods for when the Claimant joined the Group Claims as follows:</p>
                                        <p class="p108 ft3">a) there shall be quarterly accounting periods for the purposes of calculating each Claimant’s Proportionate Share;</p>
                                        <p class="p109 ft1">b) the first accounting period shall be deemed to run from and including 1 January 2020 to and including 31 March 2020. Thereafter, quarterly accounting periods shall run for three months from and including the following dates in each year: 1 January, 1 April, 1 July, and 1 October;</p>
                                        <p class="p110 ft1">c) each Claimant who is a party to this Agreement, or who subsequently becomes a party to this Agreement and who participates in the Group Claims shall be treated as if he or she had been a Claimant from the beginning of the first quarterly accounting period; and</p>
                                        <p class="p111 ft1">d) each Claimant will cease to be liable for a Proportionate Share at the end of the calendar month following the conclusion or termination of its Claim.</p>
                                        <p class="p32 ft1">9.5 The Claimants recognise that the result of the Group Claims may be that the actual relationship between a Claimant’s damages and the overall damages awarded may differ from the Proportionate Share.</p>
                                        <p class="p17 ft2"><span class="ft11">10</span><span class="ft49">Costs sharing between the Claimants and the HP Claimants</span> </p>
                                        <p class="p112 ft8">10.1 Save where the court orders otherwise, where it is agreed that common work will be carried out by Hausfeld on behalf of the Claimants and the HP Claimants jointly, the Claimants agree that the associated fees for such work shall be charged to the (Hausfeld) Claimants in full under the terms of the Hausfeld Engagement letter and allocated in Proportionate Shares between the (Hausfeld) Claimants as set out in this agreement; and where such common work is carried out by Harcus Parker, then the associated fees for such work shall not be charged to the (Hausfeld) Claimants but to the Harcus Parker Claimants.</p>
                                        <p class="p113 ft8">10.2 In the event that by agreement or by court order it is agreed that any common work be carried out on behalf of the Claimants, the HP Claimants and any other claimants pursuing similar Claims, Hausfeld will seek to agree that the costs of such work should be allocated between all claimants by reference, in the same or a similar way to Clause 10.1 above.</p>
                                        <p class="p86 ft20">10.3 The Claimants agree further that where there are common disbursements incurred either by Harcus Parker or Hausfeld but for the benefit of the Harcus Parker and the Hausfeld Claimants jointly (“<span class="ft19">Common Disbursements</span>”), then these shall be shared between the Claimants and the Hausfeld Claimants according to each claimant’s Proportionate Share (as referred to at Clause 9.2 above) but as a Proportionate Share of all the Hausfeld Claimants and Harcus Parker Claimants together as a whole, rather than just of the Hausfeld Claimants (the “<span class="ft19">HP Proprtionate Share</span>”). The Claimants agree that, subject to any order of the court or later agreement of Hausfeld and Harcus Parker, the following shall be a <nobr>non-exhaustive</nobr>list of Common Disbursements in accordance with the Funding Agreement:</p>
                                        <p class="p114 ft3">a) The costs of Leading Counsel, insofar as Leading Counsel’s work is common to and shared across both Claimant groups;</p>
                                        <p class="p115 ft1">b) The costs of Junior Counsel, insofar as Junior Counsel’s work is common to and shared across both Claimant groups;</p>
                                        <p class="p42 ft1">c) The cost of experts instructed on behalf of the Claimants;</p>
                                        <p class="p116 ft1">d) The cost of any <nobr>data-room</nobr>or electronic data storage platform to be used on behalf of all the Claimants; and</p>
                                        <p class="p43 ft1">d) Court fees, insofar as such fees pertain to common applications and filings.</p>
                                        <p class="p117 ft3">Under the Funding Agreement, the Funder will advance the Claimants’ share of the Common Disbursements.</p>
                                        <p class="p66 ft2"><span class="ft11">11</span><span class="ft49">The Defendants’ costs and the Adverse Costs Cover</span> </p>
                                        <p class="p52 ft3">11.1 In the High Court and Court of Appeal, the normal rule in English proceedings is that the unsuccessful party will be ordered to pay the costs of the successful party, such costs being Adverse Costs.</p>
                                        <p class="p83 ft20">11.2 The Funder will meet any order for Adverse Costs made against the Claimants and the HP Claimants insofar as the Insurance meets such an order up to the value of £7.5 million (the “<span class="ft19">Adverse Costs Cover</span>”). The Funding Agreement specifies that Claimants have an obligation to the Funder to comply with any obligations imposed on them by the Insurance.</p>
                                        <p class="p118 ft3">11.3 As the Claimants would ordinarily, as a matter of law, be jointly and severally liable for Adverse Costs:</p>
                                        <p class="p119 ft1">a) to the extent these are common to the Claimants, and;</p>
                                        <p class="p120 ft1">b) in respect of the Adverse Costs common to the Claimants and the HP Claimants, jointly and severally liable with the HP Claimants: in the absence of a Group Litigation order under the Civil Procedure Rules Section III of Rule 19 and/or Rule CPR 46.6, the Claimants agree collectively that their liability for Adverse Costs should be several and not joint. Each Claimant’s several liability for Adverse Costs shall be calculated using the mechanism for calculating the Proportionate Share for liability also for the Adverse Costs, calculated in accordance with Clause 9.2 a) and/or b) (as may be the case) above or the HP Proportionate Share in accordance with Clause 10.3 to the extent common to the Claimants and the HP Claimants.</p>
                                        <p class="p113 ft20">11.4 The Claimants also acknowledge that the Adverse Costs Cover may be based on a cross- subsidy between the Claimants and the HP Claimants, and thereby across Claims which have different bases. The effect of this may be that if the Claims of some Claimants succeed and some fail, there may be a liability to pay the Adverse Costs of those that fail but which will be taken from the successful Claimants’ 60% share of their recovery which is paid pursuant to the terms of the Funding Agreement. This provision may be necessary in order to secure insurance to cover this type of group claim and protect Claimants against the risk of adverse costs. If it does not prove possible in due course for the Funder to secure Insurance for the Adverse Costs Cover which: (i) would be capped within the 60% share of the Claimants’ recovery in the event that some of the Claims did not succeed; and/or (ii) keeps each Claimant’s liability for Adverse Costs several, the Claimants will be notified of any required change to the Funding Agreement and provided with the right (pursuant to Clause 10.3 of the Funding Agreement) within 14 days of notification to terminate its participation in the Claims, the Funding Agreement the Hausfeld Engagements, with no adverse costs consequences for a Claimant who terminates on this basis.</p>
                                        <p class="p53 ft20">11.5 The Claimants agree that Hausfeld should, if it thinks it necessary, apply to the court for an order reflecting the provisions of this Clause 11. In the event that no such order is made, the Claimants each accept that with the exception of any amount paid under the Funding Fee, any Claimant who is burdened with a greater share than their Proportionate Share within each Claim they pursue should be entitled to recover the difference from their fellow Claimants within that Claim: any Claimant who has initially borne a greater burden of such liabilities shall have a right of recovery which the Claimants agree will not be contested against any of his or her fellow Claimants who have not paid their due share.</p>
                                        <p class="p51 ft1">11.6 Nothing in this Agreement shall make the Committee or any member of it liable for Adverse Costs save to the extent that any such member faces a liability in respect of his or her capacity as a Claimant.</p>
                                        <p class="p32 ft1">11.7 Nothing in this Agreement shall impose any liability on Hausfeld to meet any Adverse Costs orders.</p>
                                        <p class="p17 ft2"><span class="ft11">12</span><span class="ft49">Sharing costs and risk with other claimant groups</span> </p>
                                        <p class="p121 ft3">12.1 In addition to the HP Claimants, it is possible that individuals other than those who chose to instruct Hausfeld will seek to pursue similar claims to those of the Claimants.</p>
                                        <p class="p122 ft1">a) You and each other Claimant acknowledges and agrees that the Committee’s authority will extend to agreeing to share costs and risk with other claimant groups where Hausfeld believes this is in the Claimants’ best interests or is ordered by the Court, and</p>
                                        <p class="p87 ft1">b) that this may include an Agreement that Hausfeld will agree to share work with the solicitors acting for other groups. Hausfeld will be instructed to endeavour to ensure that any work- or <nobr>cost-sharing</nobr>Agreements will mirror the Agreements between the Claimants recorded in this Agreement.</p>
                                        <p class="p15 ft2"><span class="ft11">13</span><span class="ft49">Settlement and distribution of group damages</span> </p>
                                        <p class="p52 ft1">13.1 The Claimants recognise that if there are negotiations to settle the Group Claims with the Defendants, it is possible that any offers made will be on a <nobr>costs-inclusive</nobr>group basis. The Claimants specifically authorise the Committee to solicit offers on such a basis where appropriate and to allocate and distribute the Overall Claim Proceeds due to the Claimants in accordance with the terms of the Funding Agreement and Priorities Agreement, subject to obtaining advice from Hausfeld and from Counsel and subject to the terms of clause 13.3 below, by reference to the amounts claimed or by any other method which Counsel advises is an appropriate and proportionate method of determining a global settlement of damages.</p>
                                        <p class="p113 ft8">13.2 Where there is any dispute between the Committee and the Funder regarding the making or acceptance of a settlement offer, the Committee reserves its right to refer the matter to Independent Counsel for determination pursuant to Clause 28 of the FundingAgreement.</p>
                                        <p class="p84 ft1">13.3 The Claimants also recognise and agree that in considering and making any settlement offer, such offer may have to take into account differences between types of claim and their relative strength and the Defendant’s position in respect of those claims. The Claimants further recognise and agree that it may be appropriate for certain categories of Claimants to settle and not others and to consider, in the event of a group offer, how damages should be allocated between different categories of Claimant.</p>
                                        <p class="p51 ft1">13.4 The Claimants agree that the Committee has a discretion to make decisions as to the matters in Clause 13.3 above, but that such determination will be based upon the advice of counsel taking into account all the circumstances, save that the Committee will not accept any offer of settlement from the Defendants, in relation to any Claim which does not include the Defendant paying Hausfeld their costs, unless otherwise agreed in writing by Hausfeld and the Funder.</p>
                                        <p class="p51 ft3">13.5 Similarly, it is accepted by the Claimants that it is not possible at this stage to predict with accuracy how the court may determine how damages should be calculated.</p>
                                        <p class="p83 ft20">13.6 In the event that there is any disagreement between Committee Members as to the making or acceptance of any settlement offer, any Committee Member may require the proposed decision of the Committee under this Clause 13 to be referred for review/approval by an independent Queen’s Counsel using the adjudication procedure in accordance with Clause</p>
                                        <p class="p123 ft1"><span class="ft1">13.5</span><span class="ft5">below. The Committee will then instruct Hausfeld to prepare a submission to an adjudicator (the </span><span class="ft2">‘Settlement Adjudicator’</span>) which sets out the background and the factors influencing the Committee’s proposed decision. The Settlement Adjudicator shall be an independent Queen’s Counsel, to be nominated by the Committee on the advice of Hausfeld and, in the absence of a nomination, to be nominated by the Chairman for the time being of the Chancery Law Bar Association.</p>
                                        <p class="p37 ft1">13.7 The submission to the Settlement Adjudicator will include the following instructions:</p>
                                        <p class="p124 ft1">a) This matter is being referred to adjudication because the Committee appointed by the Claimants in the Claims either disagrees as to what is the correct and fair manner to distribute the Overall Claim Proceeds between the Claimants or because it wishes to be reassured that an offer made is fair as between different categories of Claimants, and / or that the method of distribution of the Overall Claim Proceeds it agrees is appropriate.</p>
                                        <p class="p125 ft8">b) The Claims are conducted subject to agreements between the Claimants which contain an agreement to work together which provides that if there is a settlement before trial, it will not be necessary to take account of the individual issues of each Claimant’s case if it would be expensive and burdensome to do so.</p>
                                        <p class="p126 ft1">c) At the outset of the Claims, it was not clear what factors would be relevant to the distribution of global damages.</p>
                                        <p class="p57 ft1">d) One of the issues to be decided, as to which the adjudicator has complete discretion, is likely to be whether each Claimant who is able to prove his or her entitlement to a share of the Overall Claim Proceeds due to the Claimants pursuant to the terms of the Funding Agreement and the Priorities Agreement should receive the same amount or whether they should receive a payment which reflects other factors, and if so what factors.</p>
                                        <p class="p110 ft1">e) In reaching his or her determination, the adjudicator is asked to bear in mind the principles underlying this Agreement and the additional cost and complexity that may flow from distinguishing between different groups of Claimants.</p>
                                        <p class="p32 ft1">13.8 The Settlement Adjudicator’s decision will be binding on all Claimants, so that no Claimant may subsequently challenge it.</p>
                                        <p class="p32 ft1">13.9 The costs of instructing the Settlement Adjudicator and of the Settlement Adjudicator shall be borne by the Overall Claim Proceeds due to the Claimants pursuant to the terms of the Funding Agreement and the Priorities Agreement.</p>
                                        <p class="p17 ft2"><span class="ft11">14</span><span class="ft49">General Matters Relating to Settlement and Distribution</span> </p>
                                        <p class="p127 ft1">14.1 You and each Claimant acknowledges that the entire or part of the amount of any settlement which they receive may be subject to taxation and that Hausfeld has no duty to advise you in relation to taxation matters and is specifically not retained to do so.</p>
                                        <p class="p32 ft1">14.2 You and each Claimant acknowledges that you have agreed with Hausfeld that it will act for you in the Claims and recognise that Hausfeld will incur considerable expense and undertake a considerable amount of work in the expectation of being paid the deferred fees and the success fees in accordance with the Hausfeld Engagements in the event that your Claim is successful.</p>
                                        <p class="p51 ft1">14.3 You and each other Claimant warrant that you will not seek to settle or accept an offer to settle directly with the Defendants or any associate of the Defendants without the Defendants paying Hausfeld their costs unless otherwise agreed with Hausfeld and the Funder and in accordance with the terms of the Funding Agreement.</p>
                                        <p class="p128 ft1">14.4 You and each other Claimant agree that if you do settle directly with the Defendant in breach of Clause 14.3:</p>
                                        <p class="p129 ft1">a) you will immediately inform the Committee and Hausfeld that you have accepted a direct settlement and of the amount of such settlement;</p>
                                        <p class="p124 ft1">b) you will immediately, or as soon as reasonably practicable, transfer to Hausfeld an amount equal to the Funding Fee calculated in accordance with the Funding Agreement and a Proportionate Share of the Claimants’ costs, such sum to be specified by Hausfeld within five business days; and</p>
                                        <p class="p130 ft1">c) you will hold the proceeds of the settlement on trust for the Funder and Hausfeld and not spend or transfer away the amount you receive in settlement from the Defendant until you have complied with (a) and (b) above.</p>
                                        <p class="p131 ft8">14.5 You and each other Claimant agrees that the distribution of any of the Overall Claim Proceeds due to the Claimants in accordance with the Funding Agreement and the Priorities</p>
                                        <p class="p46 ft1">Agreement may be effected though the instruction of a class action claims administrator, who may be instructed to distribute the Overall Claim Proceeds in accordance with an agreed formula. The costs of distributing the Overall Claim Proceeds will be paid out of the Funding Fee.</p>
                                        <p class="p17 ft2"><span class="ft11">15</span><span class="ft49">Your right to cancel</span> </p>
                                        <p class="p52 ft1">15.1 As set out in the Hausfeld Engagements, each Claimant which enters into the Hausfeld Engagements as an individual consumer rather than as a business is entitled to cancel the Hausfeld Engagements and its associated participation in the Funding Agreement and this Agreement without incurring any liability to Hausfeld or the Funder in respect of it at any time until the expiry of the fourteenth day after the day on which he, she or it agrees to enter into this Agreement. If you wish to cancel the Agreement, then you must notify Hausfeld of your wish to do so in writing. You may inform Hausfeld by email to <a href="mailto:MercedesEmissionsClaim@hausfeld.com">MercedesEmissionsClaim@hausfeld.com</a> or by letter to FAO Nicola Boyle, Hausfeld &amp; Co LLP, 12 Gough Square, London, EC4A 3DW. A template cancellation form is included at Schedule 2 to this Agreement.</p>
                                        <p class="p113 ft20">15.2 You may give us your authority to start work on your Claim after you sign the Hausfeld Engagements and before the expiry of the cancellation period, by notifying us in writing (by email to <a href="mailto:MercedesEmissionsClaim@hausfeld.com">MercedesEmissionsClaim@hausfeld.com</a> or by letter to FAO Nicola Boyle, Hausfeld</p>
                                        <p class="p132 ft1"><span class="ft1">&amp;</span><span class="ft38">Co LLP, 12 Gough Square, London, EC4A 3DW). A template notification is included at Schedule 3 to this Agreement. If you do ask us to start work on your Claim before the expiry of the cancellation period, you will be liable for any costs incurred during that period if you don’t choose to terminate.</span> </p>
                                        <p class="p20 ft2"><span class="ft11">16</span><span class="ft49">Termination</span> </p>
                                        <p class="p133 ft1">16.1 If a Claimant dies during the course of this Agreement the rights and obligations of that Claimant under this Agreement shall pass to his or her personal representatives.</p>
                                        <p class="p134 ft3">16.2 A Claimant who wishes to discontinue his or her claim after the expiry of the fourteenth day cancellation period:</p>
                                        <p class="p135 ft3"><span class="ft13">a)</span><span class="ft33">prior to proceedings being issued on his/her behalf may do so upon notification to the Committee; and</span> </p>
                                        <p class="p136 ft3"><span class="ft13">b)</span><span class="ft33">after proceedings being issued on his/her behalf may do so only with the consent of the Funder and the Insurer, else a Claimant may be in breach of the Funding Agreement and/or the Insurance.</span> </p>
                                        <p class="p84 ft1">16.3 A Claimant who discontinues his or her Claim and/or terminates the Hausfeld Engagements and ceases to be a party to this Agreement, will remain liable under the Hausfeld Engagements and the Funding Agreement for its share of the Costs which have been incurred on his/her behalf up to the end of the calendar month in which the Claimant ceases to be a party to this Agreement and for any liability arising from the discontinuance for its share of the Defendant’s Costs.</p>
                                        <p class="p113 ft20">16.4 Due to the importance to all of the Claimants of <nobr>co-operation,</nobr>if in Hausfeld’s reasonable opinion any Claimant has persistently failed so unreasonably to comply with requests for cooperation that they are obstructing the efficient progress of the Group Claims or jeopardising their successful outcome (a <nobr><span class="ft19">‘Non-Co-operating</span> </nobr><span class="ft19"> Claimant’</span>), Hausfeld may ask the Committee to instruct them to take steps formally to discontinue the claim of any Non- <nobr>Co-operating</nobr>Claimant, and all Claimants accept that if they are deemed a <nobr>Non-Co-</nobr>operating Claimant, the authority they have given to the Committee will extend to the Committee being empowered to require a <nobr>Non-Co-operating</nobr>Claimant’s Claim to be discontinued. A Claimant shall be deemed a <nobr>Non-Co-operating</nobr>Claimant if they revoke their appointment of the Committee as set out at clauses 3(E), 6.2 and 6.3 above. Where a Claimant’s Claim is discontinued for <nobr>non-co-operation</nobr>he/she will remain liable under the Hausfeld Engagements and the Funding Agreement for their share of the Costs which have been incurred on her/her behalf up to the end of the calendar month in which the Claimant ceases to be a party to this and for any liability arising from the discontinuance for its share of the Defendant’s Costs.</p>
                                        <p class="p113 ft1">16.5 If there is a conflict between the terms of this Agreement and the terms of the Hausfeld Engagements and/or the Funding Agreement in relation to termination, the terms of the Funding Agreement will apply with the exception of any regulatory requirements in respect of which the Hausfeld Engagements will apply, and insofar as consistent with the Funding Agreement, the terms of the Hausfeld Engagements, shall take precedence.</p>
                                        <p class="p32 ft1">16.6 In the event of one or more Claimants ceasing to be a party to this Agreement for any reason it is further agreed that the obligations of the remaining Claimants to Hausfeld and to one to another will continue in all respects.</p>
                                        <p class="p17 ft2"><span class="ft11">17</span><span class="ft49">General Matters</span> </p>
                                        <p class="p78 ft1">17.1 This Agreement shall be governed by the laws of England and Wales.</p>
                                        <p class="p32 ft1">17.2 The Claimants agree to submit any dispute other than in relation to the Settlement and Distribution of Group Damages Clause at clause 13.4 in connection with or arising from this Agreement to expert determination by a Queen’s Counsel or retired High Court Judge to be nominated by the Committee and in the absence of such nomination to be nominated by the Chairman for the time being of the Chancery Law Bar Association. In the event that an issue is referred to expert determination, the expert’s decision will be binding on all Claimants, so that no Claimant may subsequently challenge it.</p>
                                        <p class="p113 ft20">17.3 All invoices, notices, documents, consents, approvals, or other communications (a <span class="ft19">‘Notice’</span>) to be given under this Agreement shall be in writing and shall be transmitted by email to Hausfeld at <span class="ft50"><a href="mailto:MercedesEmissionsClaim@hausfeld.com">MercedesEmissionsClaim@hausfeld.com</a></span>, and in the case of a Claimant, to the email provided in the registration process and in a form generating a record copy to the party being served at the place of residence or place of business provided in the registration process. Any Notice shall be deemed to have been duly served at the time of transmission (if transmitted before 4.30pm on a business day and if not so transmitted then at 9am on the next business day after which the transmission as made).</p>
                                        <p class="p32 ft1">17.4 This Agreement takes effect subject to the terms of each individual Claimant’s Hausfeld Engagements and the Funding Agreement, and, if there is any conflict between a term or terms in this Agreement and that in the Hausfeld Engagements or the Funding Agreement, the Funding Agreement will apply with the exception of any regulatory requirements in respect of which the Hausfeld Engagement will apply, and insofar as consistent with the Funding Agreement the terms of the Hausfeld Engagements, shall take precedence. Further, if and to the extent that any provision in this Agreement causes a Claimant’s Hausfeld Engagements or the Funding Agreement to be invalid or unenforceable, that provision of this Agreement will be deemed to be deleted from this Agreement and shall not take effect.</p>
                                        <p class="p17 ft2"><span class="ft11">18</span><span class="ft49">Commencement</span> </p>
                                        <p class="p137 ft1">This Agreement shall commence on the date that the first Claimant accepts its terms and shall be refreshed at the date each additional Claimant becomes a party to it.</p>
                                        <p class="p138 ft2"><span class="ft0">19</span><span class="ft49">Severability</span> </p>
                                        <p class="p139 ft1">If any of the provisions of this Agreement is found by a court or other competent authority to be void or unenforceable, such provision shall be deemed to be deleted from this Agreement and the remaining provisions of this Agreement shall continue in full force and effect. Notwithstanding the foregoing, the parties shall thereupon negotiate in good faith in order to agree the terms of a mutually satisfactory provision to be substituted for the provision so found to be void or unenforceable.</p>
                                        <p class="p140 ft2"><span class="ft0">20</span><span class="ft49">Execution</span> </p>
                                        <p class="p52 ft1">In making this Agreement available for signature, Hausfeld has given its Agreement to its terms. In addition, Hausfeld will execute a single copy of the Agreement and such execution shall be evidence of Hausfeld’s Agreement with every Claimant who agrees to this Agreement.</p>
                                        <p class="p113 ft8">The Claimants each confirm their Agreement to the terms of this Agreement electronically by giving their electronic consent to it. This Agreement is intended to apply as between all of the Claimants who agree to this Agreement, with the intention that any Claimant who agrees to this Agreement will have the obligations set out in this Agreement to all other Claimants, irrespective of the date on which any Claimant agreed to this Agreement.</p>
                                        <br>
                                        <br>
                                        <p class="p141 ft1">Signed: ………………………………</p>
                                        <br>
                                        <br>
                                        <p class="p142 ft1">For and on behalf of Hausfeld</p>
                                        <p class="p143 ft1">Signed: ………………………………</p>
                                        <br>
                                        <br>
                                        <p class="p144 ft1">Claimant</p>
                                        <br>
                                        <br>
                                        <p class="p145 ft2">Schedule 1</p>
                                        <p class="p146 ft2">Constitution and operation of the Committee</p>
                                        <p class="p147 ft1"><span class="ft11">1</span><span class="ft51">The Committee</span> </p>
                                        <p class="p40 ft1">1.1 The initial members of the Committee (the <span class="ft2">‘Initial Committee Members’ </span>where it is appropriate to distinguish between initial and subsequent members; and a member of the Committee shall be referred to as a ‘<span class="ft2">Committee Member</span>’) shall be the following individuals:</p>
                                        <p class="p148 ft1">a) Andrew Maye</p>
                                        <p class="p42 ft1">b) Kevin Potts</p>
                                        <p class="p32 ft3">1.2 Any Claimant appointed as a Committee Member agrees at all times to act in accordance with the terms of this Agreement and use its reasonable endeavours to act in the best interests of the Claimants as a group.</p>
                                        <p class="p149 ft1">1.3 The following rules shall govern Committee meetings:</p>
                                        <p class="p150 ft1">a) Committee meetings must be held in the presence of Hausfeld, may be called by Hausfeld or any Committee Member and may be held in person on three days’ notice or by conference call on 24 hours’ notice unless any such shorter period is agreed by the Committee, such notice to be provided by email;</p>
                                        <p class="p151 ft20">b) Committee meetings held by the Initial Committee Members shall be considered quorate only if two members are in attendance, whether in person, by telephone or via video conferencing facilities. If the number of Committee Members is seven or more, a Committee meeting shall be quorate only if four or more members are in attendance, whether in person, by telephone or via video conferencing facilities;</p>
                                        <p class="p150 ft1">c) no one who is not a Committee Member or a representative of Hausfeld shall be entitled to attend a Committee meeting other than by the invitation of at least two Committee Members or by the invitation of Hausfeld;</p>
                                        <p class="p56 ft1">d) minutes of all Committee meetings must be taken by Hausfeld and approved by the Committee;</p>
                                        <p class="p152 ft29">e) the Committee shall agree by a majority of the votes cast to appoint a Chairperson, and the Chairperson may exercise a casting vote in the event of a tied vote;</p>
                                        <p class="p153 ft1">f) the Committee may dismiss the Chairperson for the time being and appoint a new Chairperson by a majority of the votes cast;</p>
                                        <p class="p154 ft1">g) the Committee may agree by a majority of the votes cast to delegate certain decisions to a <nobr>sub-committee</nobr>of not fewer than three members provided that the Committee is kept fully informed of all decisions that are made and the reasons for them.</p>
                                        <p class="p155 ft3">1.4 The following rules shall govern the appointment, removal, and resignation of Committee Members:</p>
                                        <p class="p119 ft1">a) a Claimant shall cease to be a Committee Member as soon as he or she:</p>
                                        <p class="p156 ft3"><span class="ft13">(i)</span><span class="ft52">identifies a conflict of interest with their continuing as a Committee Member including an interest, position in or other connection with Mercedes Benz or an affiliate thereof;</span> </p>
                                        <p class="p157 ft1"><span class="ft13">(ii)</span><span class="ft53">retires by notifying each member of the Committee and Hausfeld in writing of his/her wish to retire once a replacement Committee Member has been appointed unless enough Committee Members remain in office to form a quorum for meetings to allow immediate retirement;</span> </p>
                                        <p class="p43 ft1"><span class="ft13">(iii)</span><span class="ft54">dies;</span> </p>
                                        <p class="p158 ft3"><span class="ft13">(iv)</span><span class="ft55">applies for a voluntary winding up, becomes insolvent or enters a voluntary arrangement with its creditors;</span> </p>
                                        <p class="p159 ft3"><span class="ft13">(v)</span><span class="ft56">becomes incapable by reason of mental disorder, illness or injury of managing and administering his or her own affairs;</span> </p>
                                        <p class="p119 ft1"><span class="ft13">(vi)</span><span class="ft54">has a bankruptcy order made against him or her; or</span> </p>
                                        <p class="p156 ft1"><span class="ft13">(vii)</span><span class="ft36">is subject to a resolution by a majority of votes cast by Committee Members at a properly convened meeting of the Committee and with prior simultaneous consent of Hausfeld, that he or she should cease to be a member of the Committee.</span> </p>
                                        <p class="p160 ft1">b) No Claimant shall be appointed a member of the Committee until he or she has executed a confidentiality agreement regarding the use of information shared with the Committee on terms stipulated by Hausfeld; and</p>
                                        <p class="p57 ft1">c) a Claimant shall be appointed as a member of the Committee by the resolution of a majority of votes cast by Committee Members at a properly convened meeting of the Committee, providing that the number of Committee Members shall not exceed twelve and providing that Hausfeld has given its consent.</p>
                                        <p class="p161 ft1">1.5 The Committee will give instructions to Hausfeld in relation to the conduct of the Claims, including (without limitation):</p>
                                        <p class="p162 ft8">a) discontinuance in relation to any individual Claimant on advice from Hausfeld and counsel that the claims no longer have sufficient prospects of success or where a Claimant is no longer <nobr>co-operating</nobr>or fulfilling its obligations in relation to the Claim;</p>
                                        <p class="p163 ft1">b) strategy generally, including decisions regarding the timetable and conduct of the proceedings, proposal for the hearing of preliminary issues, the Claims that have reasonable prospects of success and should be pursued, liaison with any other claimants bringing similar claims against Mercedes and other decisions regarding the conduct of the Claims as they arise;</p>
                                        <p class="p42 ft1">c) how the Claims should be grouped;</p>
                                        <p class="p56 ft1">d) the commencement and conduct of settlement negotiations and the approval of any settlement offer;</p>
                                        <p class="p42 ft1">e) the review and monitoring of budgets, cost update and invoices;</p>
                                        <p class="p164 ft1">f) the execution of any policies of Adverse Costs insurance and any required amendments to the funding arrangements or any required budget increase.</p>
                                        <p class="p165 ft3">1.6 In relation to all matters other than the acceptance and making of offers to settle, the business of the Committee will be resolved by a majority of Committee Members voting. In the event of a split vote the Chairperson shall have the casting vote.</p>
                                        <p class="p83 ft20">1.7 In relation to the acceptance and making of offers to settle and the operation of the Settlement and Distribution of Group Damages Clause, the decision of the Committee must be made by a majority of Committee Members voting and no vote in favour of the acceptance or making of an offer shall be passed unless Counsel advises it to be in the best interests of the Claimants as a whole. The detailed operation of the Settlement and Distribution of Group Damages Clause is dealt with clause 13.</p>
                                        <p class="p67 ft1">1.8 In addition, the Committee will:</p>
                                        <p class="p43 ft1">a) act as the Claimants’ representatives to Hausfeld in relation to the Claims;</p>
                                        <p class="p129 ft3">b) ensure that Hausfeld reports to the Claimants from time to time on the progress of the Claims by group communications providing updates on the claim website and notification of updates;</p>
                                        <p class="p167 ft1">c) ensure that Hausfeld reports to insurers in accordance with their requirements;</p>
                                        <p class="p154 ft1">d) approve on behalf of the Claimants any invoices for Costs raised by Hausfeld addressed to the Committee on behalf of the Claimants in pursuing the Claims (including in respect of any Disbursements incurred) for payment by The Funder and/or payments received from the Defendants;</p>
                                        <p class="p160 ft1">e) approve Hausfeld’s fees and any Disbursements; the Committee may appoint an independent costs draftsman to assist them in this respect and is entitled to rely on his or her advice;</p>
                                        <p class="p168 ft1">f) give instructions as to the distribution of the Overall Claim Proceeds due to the Claimants pursuant to the Funding Agreement and the Priorities Agreement to the Claimants;</p>
                                        <p class="p169 ft1">g) acting through the Chairperson, execute any documents on behalf of the Claimants for which authority is granted pursuant to clause 6.2 of the Litigation Management Agreement.</p>
                                        <p class="p32 ft1">1.9 The Claimants agree that the Committee’s discretion to negotiate settlement should not extend to an offer that does not provide for payment of the Claimants’ costs unless otherwise agreed by Hausfeld and the Funder .</p>
                                        <p class="p113 ft8">1.10 The Claimants agree that in the event that the Claimants succeed at trial, the Committee shall instruct Hausfeld to procure that any order giving effect to the judgment shall be on terms that a cash sum sufficient to satisfy all sums due to parties other than the Claimants under the Priorities Agreement, including the Funder’s Fee, be paid to Hausfeld or the Funder before the distribution of any remaining Overall Claim Proceeds to the Claimants.</p>
                                        <p class="p170 ft1">1.11 Subject to clause 1.12 below, and subject to a member of the Committee breaching his or her duties under the separate confidentiality agreement that each must sign pursuant to clause 1.4(b), no member of the Committee shall be liable to the Claimants (or any of them) for his or her own acts, neglects or defaults or for any loss to the Claimants incurred in connection with his or her role as a Committee Member, unless caused through his or her own fraud or dishonesty.</p>
                                        <p class="p32 ft1">1.12 No Committee Member shall be liable for the acts, neglects or defaults of any other Committee Member.</p>
                                        <p class="p51 ft3">1.13 The Committee Members shall be indemnified by the Claimants against any costs, losses or expenses to which they may become liable as a result of the proper exercise of their duties as Committee Members.</p>
                                        <p class="p84 ft1">1.14 The Claimants agree that the Committee Members shall be entitled only to reimbursement of their reasonable expenses.</p>
                                        <p class="p171 ft57">Schedule Two - Notice of the Right to Cancel</p>
                                        <p class="p172 ft58">If you are an individual, you have the right to cancel our engagement within 14 days of agreeing to our engagement terms without giving any reason for doing so.</p>
                                        <p class="p173 ft1">If you wish to exercise your right to cancel, please notify us <span class="ft2">in writing </span>and delivering it personally or sending it by post or by <nobr>e-mail</nobr>to the contact and address below. The notice must be sent within 14 days of your agreement to our engagement terms and is deemed served as soon as it is posted or sent to us. You may use the form below but are not required to do so.</p>
                                        <p class="p174 ft1">Nicola Boyle (Mercedes Emissions Claim)</p>
                                        <p class="p175 ft1">Hausfeld &amp; Co. LLP, 12 Gough Square, London, EC4A3DW</p>
                                        <p class="p175 ft1">Email: <a href="mailto:MercedesEmissionsClaim@hausfeld.com">MercedesEmissionsClaim@hausfeld.com</a> </p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">Signed on behalf of Hausfeld &amp; Co. LLP:</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">…………..….………………………………………………</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">Name/Position:</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">…………..………………………………………………….</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">Date:</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft30">…………..………………………………....................</p>
                                        <br>
                                        <br>
                                        <p class="p17 ft2">……………………………………………………………………….………………………………………………………………………………</p>
                                        <br>
                                        <br>
                                        <p class="p177 ft3">Complete, detach and return this form within 14 days of receipt ONLY IF YOU WISH TO CANCEL THE CONTRACT</p>
                                        <p class="p17 ft1">To: Nicola Boyle of Hausfeld &amp; Co. LLP, 12 Gough Square, London, EC4A 3DW</p>
                                        <p class="p175 ft1">Email: <a href="mailto:MercedesEmissionsClaim@hausfeld.com">MercedesEmissionsClaim@hausfeld.com</a> </p>
                                        <p class="p178 ft1">Case Reference No: Mercedes Emissions Claim</p>
                                        <p class="p174 ft1">I hereby give notice that I wish to cancel the Engagement Terms with your firm.</p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">Signed:</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">…………..….………………………………………………</p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">Name (please print):</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">…………..….………………………………………………</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">Address:</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">…………..….………………………………………………</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">…………..….………………………………………………</p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">Date:</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">…………..….………………………………………………</p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p class="p179 ft2">Schedule Three</p>
                                        <p class="p180 ft2">Authority to Commence Work</p>
                                        <p class="p20 ft1">To: Nicola Boyle of Hausfeld &amp; Co. LLP, 12 Gough Square, London, EC4A 3DW</p>
                                        <p class="p178 ft1">Email: <a href="mailto:MercedesEmissionsClaim@hausfeld.com">MercedesEmissionsClaim@hausfeld.com</a> </p>
                                        <p class="p178 ft1">Case Reference No: Mercedes Emissions Claim</p>
                                        <p class="p181 ft3">I understand that I have a right to cancel the Engagement Terms within 14 days of the date of receipt of a notice of the right to cancel.</p>
                                        <p class="p182 ft1">I wish you to commence work under the Engagement Terms before the expiration of the cancellation period.</p>
                                        <p class="p183 ft1">I understand that if I subsequently cancel these Engagement Terms within the cancellation period I will be under a duty to pay in accordance with the reasonable requirements of the cancelled contract for work undertaken prior to the cancellation.</p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">Signed:</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">…………..….………………………………………………</p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">Name (please print):</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">…………..….………………………………………………</p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">Address:</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">…………..….………………………………………………</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">…………..….………………………………………………</p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">Date:</p>
                                        <br>
                                        <br>
                                        <p class="p176 ft1">…………..….………………………………………………</p>
                                        <br>
                                        <br>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="card-header" id="headingFour">
                                      <h2 class="mb-0"> <i class="fa fa-plus"></i>
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour">Funding Participation Agreement</button>
                                      </h2>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                      <div class="card-body">
                                        <p class="p0 ft0">APPENDIX 3</p>
                                        <p class="p1 ft0">FUNDING PARTICIPATION AGREEMENT</p>
                                        <br>
                                        <p class="p2 ft3"><span class="ft1">THIS AGREEMENT </span>is made between each Claimant and CF BH Ltd (the “<span class="ft1">Funder</span>”) in which the Claimant confirms their agreement to participate in the <a href="/wp-content/themes/dejf/lang/en-gb/LitigationFundingAgreement.pdf" target="_blank"><span class="ft2">Litigation Funding Agreement</span></a> (the "<span class="ft1">Litigation Funding Agreement</span>") with the Funder and associated Priorities Agreement (the “<span class="ft1">Priorities Agreement</span>”) relating to the proposed group claim against Mercedes and related entities (“<span class="ft1">Mercedes</span>”) in relation to emissions control technology in Mercedes diesel vehicles (the Litigation Funding Agreement and the Priorities Agreement together are known as the “<span class="ft1">Funding Agreements</span>”).</p>
                                        <p class="p3 ft0">Background</p>
                                        <p class="p4 ft6"><span class="ft4">(A)</span><span class="ft5">In the Litigation Funding Agreement, the Funder has agreed to provide funding to claimants who instruct Hausfeld to pursue claims in relation to the emissions control technology in Mercedes diesel vehicles (the “</span><span class="ft0">Group Claims</span>” and the “<span class="ft0">Claimants</span>”);</p>
                                        <p class="p5 ft3"><span class="ft4">(B)</span><span class="ft7">The Litigation Funding Agreement sets out the terms on which the Funder will provide funding to the Claimants, including: the costs which the Funder agrees to advance for the Claimants; the obligations on the Claimants in relation to the provision of information and </span> <nobr>co-operation</nobr>in pursuing the Group Claims; the terms on which the</p>
                                        <p class="p6 ft6">Funder will indemnify the Claimants against the risks of having to pay Mercedes’ costs if the Group Claims fail based on the insurance which the Funder will put in place (the “<span class="ft0">Insurance</span>”); the share of a Claimants’ damages which it will pay to the Funder and others parties in the event that a Claimants’ claim is successful; the circumstances in which the Litigation Funding Agreement may be terminated by the Claimant and the Funder; and the consequences which apply in the event of termination;</p>
                                        <p class="p4 ft6"><span class="ft6">(C)</span><span class="ft5">The Priorities Agreement sets out the terms on which it is agreed that any proceeds from successful Group Claims will be allocated between the Claimants, the Funder, the insurer, Hausfeld and counsel (to cover any conditional fees) and the US Consortium (as defined in the Litigation Funding Agreement), who provide the Claimant platform and associated services;</span> </p>
                                        <p class="p7 ft6"><span class="ft4">(D)</span><span class="ft8">The Claimant wishes to participate in the Funding Agreements and confirms his/her agreement to the terms of the same.</span> </p>
                                        <p class="p8 ft0"><span class="ft0">1.</span><span class="ft9">Agreement to participate in the Funding Agreements</span> </p>
                                        <p class="p9 ft4"><span class="ft6">1.1</span><span class="ft10">I have been provided with copies of the Litigation Funding Agreement and Priorities Agreement which have been agreed with the Funder by the Chair of the Claimant Committee and I confirm that in entering into this Funding Participation Agreement, I agree with each of the other Parties to the Funding Agreements from time to time that:</span> </p>
                                        <p class="p10 ft6"><span class="ft4">a)</span><span class="ft11">I will observe, perform and be bound by all the terms of the Funding Agreements which are capable of applying to me as a Claimant and which have not yet been performed; and</span> </p>
                                        <p class="p11 ft6"><span class="ft4">b)</span><span class="ft12">all such rights and obligations of the Claimants in the Funding Agreements shall be construed as rights and obligations to which I am party and to which I agree to be bound.</span> </p>
                                        <p class="p8 ft0"><span class="ft0">2.</span><span class="ft9">Right of Cancellation</span> </p>
                                        <p class="p12 ft6"><span class="ft6">2.1</span><span class="ft13">I understand that where I participate in the Group Claims as a consumer in my individual capacity rather than as a business, I have a right to cancel this Funding Participation Agreement within 14 days of the date of agreement by providing notice in the form set out in Schedule 1.</span> </p>
                                        <p class="p13 ft6"><span class="ft6">2.2</span><span class="ft13">I understand that if I cancel my participation in this Funding Participation Agreement then Hausfeld will be unable to act for me under the Hausfeld Engagements and my participation in the Litigation Management Agreement will also be terminated.</span> </p>
                                        <p class="p14 ft0"><span class="ft0">3.</span><span class="ft9">Notice</span> </p>
                                        <p class="p15 ft6"><span class="ft6">3.1</span><span class="ft13">I agree that for the purpose of service of Notice or other documents under the Funding Agreements, service on Hausfeld shall be valid and adequate service on the Claimants.</span> </p>
                                        <p class="p8 ft0"><span class="ft0">4.</span><span class="ft9">Disputes</span> </p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                         
                              <div class="col-lg-12 p-0 form-group text-center"> 
                                <!-- <a href="#">
                                <input type="button" class="btn regNextBtn mrg-10" id="" value="Click To Submit Details">
                                </a>  -->
                                <input type="button" class="btn regNextBtn mrg-10" id="Submitbutton" name="submit1"  value="Click To Submit Details">
                              </div>
                            </div>
                          <!-- </div> -->
                        </fieldset>

                        <div class="clearfix"></div>
                      </div>

                      <div class="progress" style="height:25px;">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70" style="width:90%"> <span class="sr-only">70% Complete</span> </div>
                      </div>
                      <div class="container-fluid  banner-bottom p-0">
                        <div class="col-12 text-center p-0">
                          <h6 style="font-size: 14px; margin-top: 17px;">PERSONAL INFORMATION GUARANTEE</h6>
                        </div>
                        <div class="col-md-12 col-12 text-center p-0"> 
                          <!-- <p><strong>Please note</strong> - you do not need to upload any  documents at this stage </p> -->
                          <p style="text-align: center;">We do not cold call, spam or pass on your data for marketing</p>
                          <img src="{{ $resourcePath }}img/secure-signs.png" alt="" class="d-lg-none d-md-none d-sm-block d-block"> </div>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- ========= FormSection  Area End ========= -->

  <section class="iconssec">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center">
          <div class="round">
                <img src="{{ $resourcePath }}img/Money.png" alt="">
          </div>
          <h6>No Win, No Cost to You</h6>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center">
          <div class="round">
                <img src="{{ $resourcePath }}img/ico2.png" alt="">
          </div>
          <h6>Compensation could be several thousands of pounds</h6>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center">
          <div class="round">
                <img src="{{ $resourcePath }}img/ico3.png" alt="">
          </div>
          <h6>Experienced Legal Team</h6>
        </div>
        <div class="col-lg-12">
          <p>
            Mercedes owners may be due compensation after the carmaker was found by the German Transport Authority to have installed devices in certain diesel vehicles that cheat emissions tests. Mercedes’ parent company, Daimler, was fined €870 million by German prosecutors in 2019 relating to the emissions scandal and Mercedes vehicles have been subject to recalls, including in the UK.
          </p>
          <p class="botmp">
            <img src="{{ $resourcePath }}img/fut_logo.png" alt="">
            Hausfeld is a leading international law firm with significant experience of collective redress and group claims. <a href="https://www.hausfeld.com/" target="_blank">Click here</a> for further information.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="testimonial">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-6 col-sm-12 col-12 text-left leftside1">
          <p>
            <i>
              "Hundreds of thousands of Mercedes-Benz owners in the UK could have been unknowingly releasing illegal levels of emissions into the air due to Mercedes' alleged installation of devices in diesel vehicles that cheat emissions tests. If Mercedes-Benz misled its own customers then consumers and businesses who bought the vehicles in good faith should be eligible for compensation"
            </i>
          </p>
          <span>-Vicki Butler-Henderson</span>
        </div>
        <div class="col-lg-4 col-md-6 d-md-block d-none text-center">
          <img src="{{ $resourcePath }}img/vicky.png" alt="">
        </div>
      </div>
    </div>
  </section>


  <section class="polussion">
    <div class="container">
      <div class="row">
        <div class="offset-lg-6 col-lg-6 col-md-6 col-sm-12 col-12 text-center">
          <h3>HARMFUL EMISSIONS DAMAGE HEALTH</h3>
          <p>
            Vehicle emissions are responsible for hundreds of thousands of premature deaths each year, exacerbating numerous health problems with children and the elderly particularly susceptible to the harmful effects of NOx. Join the claim and stand up against unlawful vehicle emissions.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="enviroment">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>PROTECT THE ENVIRONMENT</h3>
          <p>
            NOx is a dangerous nitrogen-based pollutant that is responsible for acid rain, global warming, smog and deterioration of the ozone layer. Taking legal action will encourage Mercedes-Benz and others to have proper regard to the impact which its alleged behaviour has on the environment.
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- ========= defeat Section  Area End ========= -->

  <!-- Footer Area Start -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
          <img src="{{ $resourcePath }}img/logo.jpg" alt="" style="max-width: 90%;">
          <!-- <img src="{{ $resourcePath }}img/Mercedes_Emissions_Claim_Logo_White.png" alt=""> -->
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12 col-12 text-center">
          <p>
            <b>CONTACT INFO</b><br>
            Mercedes Emissions Claim<br>
            Hausfeld & Co LLP
            12 Gough Square<br>
            London, 
            EC4A 3DW<br>
            +44 (0)207 936 0950<br>
            mercedesemissionsclaim@hausfeld.com
          </p>            
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
          <img src="{{ $resourcePath }}img/solictor.png" alt="">
        </div>
        <div class="col-lg-12 col-12 text-center">
          <p> <i>Hausfeld is a leading international law firm with significant experience of collective redress and group claims.</i></p>
        </div>
      </div>
    </div>
    <div class="ftrbtm">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <p>© 2021 Hausfeld – HAUSFELD® is a registered trademark</p>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12 col-12">
            <ul>
              <li><a href="#" data-toggle="modal" data-target="#terms">Legal Notices</a> </li>
              <li><a href="#" data-toggle="modal" data-target="#privacy">Privacy Policy</a> </li>
              <li><a href="#" data-toggle="modal" data-target="#Cookie">Cookie Notice</a> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer Area End -->

  
  @include('includes.popup')

  <!-- ========= Car Registration Number Analyzing Pop up Start ========= -->
  <div class="modal load_mode fade" id="loade" tabindex="-1" role="dialog" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content custm_cont">
        <div class="modal-body custm_bdy">
          <h6>Validating Your Car Registration Number</h6>
          <div class="col-lg-12 text-center p-0">
            <img src="{{ $resourcePath }}img/lod.gif" alt="" class="lo_gif">
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="CLAIMSModal" tabindex="-1" role="dialog" aria-labelledby="CLAIMSModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="CLAIMSModalLabel">Read the Claims Summary, Conditional Fee Agreement and Subsequent Conditional Fee Agreement, Litigation Management Agreement, Funding Participation Agreement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6>MERCEDES EMISSIONS CLAIMS –  SUMMARY OF FUNDING AND ENGAGEMENT DOCUMENT</h6>
          <p><b>
            This note sets out a summary for claimants who wish to participate in the group claim against Mercedes represented by Hausfeld and using litigation funding provided by CF BH Ltd, an entity serviced by Black Hammer Capital.
          </b></p>
          <p>Your claim against Mercedes will be run as part of a group, alongside other claimants’ claims. The claimants have formed a committee to make key decisions in relation to the claims on behalf of the claimant group, including giving instructions to us, Hausfeld, as your lawyers, regarding the running of the claims and any decision on settlement.</p>
          <p>The costs of bringing the claims will be paid on your behalf by the   litigation funder, who will also take out adverse costs insurance to cover the risks of having to pay the defendant’s costs if the claim does not succeed. In return, the litigation funder is entitled to 40% of your compensation at the end of the case (which will include your liability for our fees and other costs), plus any unrecovered VAT payable on Hausfeld’s conditional fees, whic   h we refer to below as the “Funding Fee”. If you win your claim, you will keep 60% of your compensation less any unrecovered VAT payable on Hausfeld’s conditional fees.</p>
          <p>To become a claimant, you must read and sign four legally binding agreements: (i) two engagements with your lawyers, Hausfeld; (ii) a litigation management agreement, which sets out how your claim and other claimants’ claims will be run together; and (iii) a funding participation agreement which says that you understand and agree to adhere to the terms of the funding agreement and the Priorities Agreement. <u> This    summary is not a substitute  for    reading  the    agreements  in  detail  but  it  is  intended to  help you    understand what     theseagreements say.</u></p>
          <p> <b>l. YOUR LAWYERS -  THE HAUSFELD ENGAGEMENTS</b></p>
          <p>In conjunction with your agreement to the funding agreement, Hausfeld will work for you on the basis that if you don’t win your claim, no fee is required from you. The terms on which Hausfeld are engaged are contained in Hausfeld’s two engagement letters: the first engagement applies when Hausfeld’s fees are being paid in part by the funder; the second engagement will apply when the budget for Hausfeld’s fees under the Funding Agreement has been used up and Hausfeld’s fees are no longer being part- paid by the funde</p>
          <p>Under the first engagement, 55% of Hausfeld’s fees and other litigation costs will be paid by the funder on your behalf, as the litigation progresses. The remaining 45% of Hausfeld’s fees are deferred and will only be due if you win your case, together with a success fee which is the equivalent of 45% of Hausfeld’s fees. Under the second engagement, Hausfeld will work for you with no payment at all unless the claim is successful. On success, the full fees will be payable together with a success fee which is equivalent of 100% of Hausfeld’s fees. You will be notified by the committee at the point at which the budget has been used up and Hausfeld’s second engagement starts to apply.</p>
          <p>If you win your case, Hausfeld will recover all or part of your legal fees, including the deferred fees to the extent possible, from Mercedes and these will be paid to Hausfeld, alongside their success fee, from the Funding Fee, which you agree to pay to the funder. Your liability in respect of Hausfeld’s fees and disbursements in the event that your claim is successful is as set out in the Hausfeld engagements. It is capped within the Funding Fee, so that you will receive 60% of the Damages Award (less any unrecovered VAT on Hausfeld’s conditional fees). If you lose your case, you will not have to pay any legal fees provided you have complied with your obligations under the agreements.</p>
          <p>The committee will instruct Hausfeld, on your behalf. Invoices for Hausfeld’s non-deferred fees and other litigation costs will be sent to the committee and the committee will be able to approve these on your behalf. In instructing Hausfeld, you agree that you will provide your lawyers with accurate and complete information about your claim, in a timely manner. Hausfeld will advise you as part of the group of claimants and will only be  able  to  progress  your  claim  once  you  have  completed  the  registration  process  and  information questionnaire in full. Hausfeld does not have to proceed with your claim if it isn’t appropriate to do so, for example because it does not have sufficient prospects of success, or if it is not suitable to be pursued as part of the group claim (for example due to needing to be issued before the rest of the group or where it might involve different parties which are not common to other claimants) – if this is the case, Hausfeld will inform you as soon as possible. As part of the agreement with the litigation funder, your claim will not be filed until the minimum group size of 27,500 claimants has been met and the funder has put in place the insurance policy to cover adverse costs.</p>
          <p>You can cancel your retainer with Hausfeld any time within 14 days of agreeing to the engagement terms. Outside of that 14 day period, you can cancel your retainer at any time but if you do so without Hausfeld’s written permission then you may be charged Hausfeld’s costs, as set out in the engagement letter and any costs incurred on your behalf by the funder as set out below. Hausfeld has the right to cancel their engagement with you if they have a good reason to do so, such as because you have failed to provide all the information required about your claim, and in this scenario you may be charged Hausfeld’s costs insofar as they relate to your claim.</p>
          <p><b>ll. RUNNING THE CLAIMS AS A GROUP –  THE LITIGATON MANAGEMENT AGREEMENT</b></p>
          <p>It would only be viable to bring your claim against Mercedes as part of a group of other claims, given the costs involved in litigation and the efficiencies created by grouping the claims together. It is in your best interests to cooperate with the other claimants represented by Hausfeld. It is also, in Hausfeld’s view, in your best interests to cooperate with a further group of claimants, whose claims are materially similar to the Hausfeld group’s claims and are being run by another law firm, Harcus Parker. Cooperation with the Harcus Parker claimants maximises the efficiencies and other benefits of bringing the claims as a group.</p>
          <p>In order for multiple claimants’ claims to be brought as a group, an agreement is needed between claimants as to how to run the claim –  this document in the litigation management agreement. This agreement also, sets out how the committee will run your claim on your behalf, how the costs of running the litigation will be shared, governs the co-operation with the Harcus Parker claimants, how decisions on settlement of the claim will be made by the Committee and how the compensation will be divided between claimants in the event of a successful judgment or settlement.</p>
          <p>The costs of running the litigation will be met by the litigation funder and recovered from Mercedes if the claims are successful. A high proportion of those costs are expected to be common to all of the claims, including the Harcus Parker claimants. However, some costs may be specific to an issue which affects certain claimants or individual to certain claimants. Your allocation of the costs of bringing the claim will be calculated based on the number of vehicles which you have in the claim, as set out in more detail in the litigation management agreement. These costs will be paid on your behalf and recovered from the defendant and you will only have to pay the Funding Fee provided you do not breach any terms of the agreements.</p>
          <p>If damages are obtained via a successful judgment or settlement, the Committee will decide, following the advice of counsel how best to divide up those damages between the claimants. The claimants agree not to accept any settlement offer from Mercedes that does not account for the costs of running the litigation and if any such offer is made and accepted then you will be liable to Hausfeld and to the litigation funder for your costs.</p>
          <p>As with Hausfeld’s engagement, you can terminate your participation in the litigation management agreement within 14 days agreeing to its terms. Outside of this 14 day period, you may only terminate your involvement with the permission of the litigation funder and the insurer and if you do so then you may be liable for your share of the litigation costs. If you do not cooperate with reasonable requests from Hausfeld or the litigation funder during the claim, the committee may discontinue your claim and terminate your participation in the litigation management agreement. Hausfeld will no longer be able to represent you in relation to your claim and  the  Hausfeld  engagement  will  also  be  terminated.  If  your  participation  in  the  litigation  management agreement ends, your engagement with Hausfeld will be terminated and vice versa.</p>
          <p><b>lll. THE COSTS OF THE CLAIMS –  THE FUNDING PARTICIPATION AGREEMEN</b></p>
          <p>The Funding Agreement has been agreed with the Funder by the Chair of the Claimant Committee and in entering into the Funding Participation Agreement, you confirm your agreement to the terms of the Funding Agreement and to the Priorities Agreement.</p>
          <ul>
            <li>
              The Funding Agreement sets out the terms on which the Funder will advance the costs of the litigation on your behalf in accordance with the agreed budget and your agreement to pay the Funding Fee (being 40% of your damages and any unrecovered VAT on our Conditional Fees) if the claims are successful.
            </li>
            <li>The Priorities Agreement explains how the claim proceeds will be allocated which sets out the payment to you of the agreed 60% of your damages aware less any unrecovered VAT on our conditional fees.</li>
          </ul>
          <p>The Funding Agreement provides that the projected costs of running the claims up to a certain limitwill   be paid on  your  behalf  by  the  litigation  funder.  This  includes  any  non-  deferred  fees  paid  under  the  Hausfeld Engagements together with any anticipated disbursement costs and    the   costs of the insurance, which will cover the Hausfeld and the Harcus Parker claimants against the risk of having to pay Mercedes’ costs. The level of funding available under the funding agreement can be increased during the course of the proceedings by agreement between the committee and the funder if we believe it is reasonably necessary to conclude the claims.</p>
          <p>The funding agreement also provides protection to the claimants in the event that their claims are lost. Usually in litigation, the losing party is ordered to pay the winning side’s legal costs – h owever, in this case, the litigation funder has indemnified you against paying Mercedes’ costs up to £7.5 million on the terms of an insurance policy which it will take out. If you do not agree with the terms of the insurance which the funder obtains, including as to the level of indemnity provided under the insurance, then you will have 14 days from the terms of the insurance being made available to you to cancel your participation in the claims.</p>
          <p>There may be some circumstances in   which adverse costs will   not be covered by the insurance policy,  for example where the funder believes it is not viable to continue running the claim and the insurer does not to agree to the claims being discontinued. I t is   also   possible that the insurance may be inadequate in some respect, including due to the level of cover, insurer insolvency or the risk of avoidance, which may    result in exposure to adverse costs.  However, we  believe the  risk of these eventualities is low and in this case any liability for adverse costs would    be split between all   claimants by reference to the number of vehicles for which they claim  such that each claimant is only liable for a share. </p>
          <p>If the   claim is successful, in return for the Funder’s commitment to the claims, you agree to pay the funder the Funding Fee. The Funding Fee comprises 40% of your damages, plus any unrecovered VAT on the portion of legal fees which are contingent upon success, and 100% of all costs which are recovered from the defendants. You will retain 60% of the damages received less any unrecovered VAT on the portion of legal fees which are contingent  upon  success.  The  Funding  Fee  will  be  used  to  pay  the  funder,  Hausfeld  and  counsel  their 
                4 conditional fees, the insurer and the US Consortium (the provider of the claimant platform and associated services).</p>
          <p>As part of the agreement with the litigation funder, your claim will not be filed until the minimum group size of 27,500 claimants has been met and the funder has put in place the insurance.</p>
          <p><u><i>Obligations and warranties:</i></u>As part of   signing up   to   the action, you agree, via    the Funding ParticipationAgreement, that you will   adhere to   the terms of   the funding agreement. The claimants have obligationsunder the funding agreement, in particular:</p>
          <ul>
            <li>that the information provided to Hausfeld about your claim must be true and accurate and that there is nothing of relevance of which you    are aware about your claim which you have failed to disclose to Hausfeld. If any further information about your claim comes to light then you will disclose this to Hausfeld. You also agree that all information which you provide can be shared with the Funder;</li>
            <li>that you have had the opportunity to take independent legal advice in relation to your participation in the claims;</li>
            <li>that you will comply with the terms of the funder’s insurance once this is put in place, a copy of the terms of which will be made available to you. You will also comply with any steps required by the funder to procure, maintain or claim under the insurance and you will not take any steps which may jeopardise the insurance;</li>
            <li>that you   will follow the legal advice of Hausfeld and counsel and cooperate with them throughout the proceedings so as to maximise the chances of a successful outcome and minimise any exposure to having to pay the defendants’ costs;</li>
            <li>that you   agree that if you do not comply with your obligations under the Funding Agreement or if any of the warranties that you have provided are untrue, you may be in breach of the Funding Agreement and liable to pay the Funder your share of the costs the Funder has invested in the claims. You may also share liability for any breach by the claimant committee; and</li>
            <li>to follow legal advice and to abide by the terms of the funder’s insurance, and it is important that you follow these obligations and comply with any requests from Hausfeld or the Committee or else you may be in breach of the funding agreement.</li>
          </ul>
          <p><u><i>Termination:</i></u>The funder can    terminate your participation in the funding agreement if  you breach its  terms or   fail    to   co-  operate with    any    request from Hausfeld or   the Committee to   progress the claims where requested to   do   so. In   this    scenario you will   be liable to   pay t he Funder your share of   the costs the Funderhas    invested in the claims. The funder may    also  terminate its  funding of   the claims if  the size  of   the claimant group does not    reach the target of   43,200 claimants, if  the claims become commercially unviable or   the prospects of   success drop below a   certain level and/or the Funder cannot obtain the insurance on terms which align with    the Priorities Agreement. If  the claims have been filed    and    the funder stops funding the claims because the claimant targets are not    met,    the funder will   cover any    exposure you have to Mercedes for    paying Mercedes’ costs. However, if  the funder stops funding the claims for    any    otherreason and    the insurer does not    approve of the discontinuance of   the claims, you may    be exposed to paying to   Mercedes your share of   their costs. If  you wish    to   withdraw from the claim, you can    only do   so with    the agreement of   the Funder and    you will   be liable to   pay the Funder your share of   the costs the Funder has    invested in the claim.</p>
          <p>Funding Agreement and the Priorities Agreement including any increase to the budget, but it may only agree to change the amount of the Funding Fee in circumstances in which it is not otherwise be possible to put in place the insurance and is considered by the Claimant Committee in the claimants’ best interests in order to 
                5 progress the claims. You understand that if the Committee proposes to change the amount of the Funding Fee, you will have the right within 14 days of notice to elect to cancel your participation in the Funding Agreement, the Priorities Agreement and the claims.</p>
          <p><b><u>THIS IS ONLY A SUMMARY</u></b> it is not a substitute for    reading the agreements in full.    You    must now read each agreement and    sign to   say that you agree with    its  terms. You    may    wish    to   take    independent legal advice on   the agreements before entering into   them. As set    out    in the agreements, if  you are signing up as a    consumer rather than a  business then you have a right to   cancel your participation in the agreementswithin 14   days by sending written notice to   MercedesEmissionsClaim@hausfeld.com.</p>
          <h2>ENGAGEMENTTERMS</h2>
          <p><b>INDEX</b></p>
          <ol>
            <li>Page1 -Conditional Fee Agreement</li>
            <li>Page36 -Subsequent Conditional Fee Agreement</li>
          </ol>
          <h2>CONDITIONALFEEAGREEMENT</h2>
          <table width="100%">
            <tbody>
              <tr>
                <td width="50%"><img src="{{ $resourcePath }}img/logo.jpg" alt="" style="max-width: 30%;"></td>
                <td width="50%">
                  12GoughSquare <br>
                  London <br>
                  EC4A3DW <br>
                  <br>
                  Direct <br>
                  44(0)2076655000Main <br>
                  44(0)2076655001fax
                </td>
              </tr>
            </tbody>
          </table>
          <p><b>CONFIDENTIAL</b></p>
          <p>DearClaimant</p>
          <p><b>Engagementletter: Proposed group claim in relation to Mercedes‐Benz emissions</b></p>
          <p><b>1. Introduction</b></p>
          <p>1.1. Thisletter,to get her with theen closedTermsofBusiness(togetherthe“EngagementTerms”),setoutthetermsuponwhichHausfeld&CoLLPwillprovidelegalservicestoyouandotherclaimantsinconnectionwiththeproposedgroupclaimagainstMercedes‐Benzandrelatedentitiesrelatingtotheuseof'defeatdevices'inemissionscontroltechnologyinMercedesvehicles.IntheeventofanyconflictbetweenthisletterandtheenclosedTermsofBusiness,thisletterwillprevail.</p>
          <p>1.2. WewillprovidelegalservicestoyouaspartofagroupofpurchasersandlesseesofMercedes‐Benzdieselvehicles(together,the“HausfeldClaimants”andeachindividuallya“Claimant”)inrelationtoaclaimarisingfromthefailurebyDaimlerAG,Mercedes‐BenzCarsUKLimited,Mercedes‐BenzFinancialServicesUKLimitedand/oranyrelevantsubsidiaryorassociatedcompanies,authorisedagentsorapproveddealerships(together,the“Defendants”)tocomplywithobligationsinrelationtoemissionsinresp  ectofdieselvehiclessuppliedtotheUKmarket(the“GroupClaims”andeachClaimant’sindividualclaim,a“Claim”).</p>
          <p><b>LitigationManagementAgreementandFundingAgreement</b></p>
          <p>1.3. ToallowtheGroupClaimstobepursuedonagroupbasisandforustorepresentyouaspartoftheGroupClaims,eachClaimantalsoagreestoparticipatein:</p>
          <p>a) the <b>Litigation Management Agreement (the “LMA”) </b> ‐ this sets out the terms on which:</p>
          <ul>
            <li>youagreethattheGroupClaimswillbemanagedonbehalfoftheClaimantstoallowtheClaimstobepursuedonagroupbasis;</li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade show padders" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-modal="true" style="display: none;">
    <div class="modal-dialog modal-lg smallmod" role="document">
      <div class="modal-content" style="border-radius:15px !important;border:1px solid #ccc !important; text-align: center !important;">
        <div class="modal-body">
          <p>Thank you for visiting Hausfeld. Unfortunately we are unable to help you.</p>
        </div>
        <div class="modal-footer" style="background: none !important; justify-content: center !important;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
        </div>
      </div>
    </div>
  </div>
      
  
<style type="text/css">
 .custom-control-input{
       opacity: 1 !important;
       top: 2px !important;
}
</style>

@endsection
@section('script')
  <!-- jQuery -->
  <script src="{{$resourcePath}}js/app.js"></script>
@endsection