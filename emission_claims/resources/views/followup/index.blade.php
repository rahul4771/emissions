@extends('layouts.splits')
@section('body-class','d-block s-sm-block')
@section('title') 
    {{ $pageData['title'] }}
@endsection
@section('head')
    <link href="{{ $pageData['resource_path'] }}css/main.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="{{ $pageData['resource_path'] }}img/favicon.png">
@endsection
@section('content')

<!-- ========= Header Area Start ========= -->
<header>
  <div class="container-fluid">
    <div class="row">
      <div class="logo-part offset-lg-3 offset-md-3 offset-2 col-lg-6 col-md-6 col-8 text-center animated bounceInDown">
        <img src="{{ $pageData['resource_path'] }}img/logo.jpg" alt="">
        <!-- <img src="{{ $pageData['resource_path'] }}img/meclogo.png" alt="" class="mcelogo"> -->
      </div>    
    </div>
  </div>
</header>
 <!-- ========= Header Area End ========= -->

<section class="bnr_part">
    <div class="container">
       <div class="row">
          <div class="offset-lg-3 col-lg-6 col-md-12 col-sm-12 col-md-12 d-md-block">
             <div class="col-lg-12 col-md-12 col-12 p-0 logo text-center">
                <!-- <img src="{{ $pageData['resource_path'] }}img/logo.jpg" alt="">
                <img src="{{ $pageData['resource_path'] }}img/meclogo.png" alt="" class="mcelogo"> -->
             </div>
             <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-lg-block p-0">
                <div class="bnr_top">
                   <h1>Hi {{ $pageData['visitor']->first_name }} {{ $pageData['visitor']->last_name }}</h1>
                   <p>Please enter your <span> Car Registration Number </span> below to proceed with your claim
                  </p>
                </div>
             </div>
          </div>
         
       </div>
    </div>
 </section>

 <!--  ========= FormSection  Area Start  ========= -->
<section class="form-section">
    <div class="container">
       <div class="offset-lg-3 col-lg-6 col-md-12 col-12 brdr">
         <div class="form">
    <form class="pad-lef" name="cust_info" id="cust_info" action="{{ $pageData['action_page'] }}" method="post">
                @csrf
                <input type="hidden" name="ajax-path" id="ajax-path" value="{{ $pageData['APP_URL'] }}"/> 
                      <input type = "hidden" name = "visitor_id" id="visitor_id" value="{{ $pageData['visitor_id'] }}"/> 
                      <input type = "hidden" name = "user_id" id="user_id" value="{{ $pageData['user_id'] }}"/>
                      <input type = "hidden" name = "fl_visitid" id="fl_visitid" value="{{ $pageData['flp_visit_id'] }}"/>
                      <input type = "hidden" name = "user_answers" id="user_answers" value="{{ $pageData['user_answers'] }}"/>
                     
                      <input type="hidden" name="idntRemember" id="idntRemember" value="0" />
                      <input type="hidden" name="carAcquiredDate" id="carAcuquiredDate"/>
                      <input type="hidden" name="keeperDate" id="keeperDate"/>
                      
                 <div class="row" id="" style="">
                   <div class="col-lg-12 p-0">
                     <h3>Enter Your Car Registration Number</h3>
                     <div class="row m-0 mb-2 carRegNo_wrap">
                       <div class="col-2 gb">
                         <img src="{{ $pageData['resource_path'] }}img/gb.png" alt=""><br>
                         GB
                       </div>
                       <div class="col-10 p-0">
                         <input type="text" class="form-control crg_num anim_ylw" placeholder="e.g.ME12DAR" aria-label="Username" aria-describedby="basic-addon1" name="carRegNo" id="carRegNo" value="" autocomplete="off">
                       </div>
                       <i class="validate" aria-hidden="true" style="display:none;"></i>
                       <i class="validate validate_success" aria-hidden="true" style="display:none;"></i>
                       <i class="validate validate_error" aria-hidden="true" style="display:none;"></i>
                       <span id="car_reg_err" class="error_msg"></span>
                     </div>
                     @if($pageData['user_answers'] == 0)
                    <div class="custom-control custom-checkbox  text-left" style="margin: 10px;">
                      <input type="checkbox" class="custom-control-input" id="purchase_finance_lease" name="purchase_finance_lease" value="yes">
                      <label class="custom-control-label" for="purchase_finance_lease" style="font-size:16px;">I have purchased, financed, or leased this vehicle from England/Wales
                        <span id="purchase_err" class="error_msg" style="display: none;"></span>
                      </label>
                    </div>
                    <div class="custom-control custom-checkbox  text-left" style="margin: 10px;">
                      <input type="checkbox" class="custom-control-input" id="joinanother" name="joinanother" value="no">
                      <label class="custom-control-label" for="joinanother" style="font-size:16px;">I have <strong><u>not</u></strong> joined another Mercedes Emissions Claim
                        <span id="join_err" class="error_msg" style="display: none;"></span>
                      </label>
                    </div>
                    @endif
                     <div class="col-lg-12 text-center" style="margin-bottom: 10px; padding: 0px;">
<button type="button" name="submit1" class="btn btn-next" id="regNextBtn">Submit</button>
                     </div> 
                 </div>
             </div>
         <div class="clearfix"></div>
         </form>
       </div>
     </div>
   </div>
    <div class="clearfix"></div>
 
       <!-- <div class="container details-below">
          <div class="row">
 
             <div class="offset-lg-3 col-lg-6 col-md-12 col-sm-12 col-12 text-center">
             <h3>We already have your below details</h3>
             <div class="col-12 det_box">
                <table class="tab_100" border="0">
                   <tr>
                     <td class="title-det">Name</td>
                     <td  rowspan="2"><img src="dist/img/tick.png"> </td>
                   </tr>
                   <tr>
                     <td class="title-info">Matthew Partain</td>
                   </tr>
               </table>
             </div>
 
 
             <div class="col-12 det_box">
                <table class="tab_100" border="0">
                   <tr>
                     <td class="title-det">Address</td>
                     <td  rowspan="2"><img src="dist/img/tick.png"> </td>
                   </tr>
                   <tr>
                     <td class="title-info">Lorem ipsum dolor, sit ame, ipsum dolor </td>
                   </tr>
               </table>
             </div>
 
 
             <div class="col-12 det_box">
                <table class="tab_100" border="0">
                   <tr>
                     <td class="title-det">Contact Details</td>
                     <td  rowspan="2"><img src="dist/img/tick.png"> </td>
                   </tr>
                   <tr>
                     <td class="title-info">ipsum dolor, sit ame,</td>
                   </tr>
               </table>
             </div>
 
 
             <div class="col-12 det_box">
                <table class="tab_100" border="0">
                   <tr>
                     <td class="title-det">Car Details</td>
                     <td  rowspan="2"><img src="dist/img/tick.png"> </td>
                   </tr>
                   <tr>
                     <td class="title-info">ipsum dolor, sit ame,</td>
                   </tr>
               </table>
             </div>
 
          </div>
       </div>
    </div> -->
 </section>
 <!-- ========= FormSection  Area End ========= -->

<!-- Footer Area Start -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-12">
        <img src="{{ $pageData['resource_path'] }}img/fut_logo.png" alt="">
        <img src="{{ $pageData['resource_path'] }}img/Mercedes_Emissions_Claim_Logo_White.png" alt="">
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
        <img src="{{ $pageData['resource_path'] }}img/solictor.png" alt="">
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
            <li><a href="#" data-toggle="modal" data-target="#Cookie">Cookie Notice. </a> </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Footer Area End -->

 
<!-- Footer Area Start -->
<!-- <footer>
    <div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-left">
            
            <ul>
                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#terms">Terms of Use </a> </li>
                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#privacy">Privacy Policy</a> </li>
                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#Cookie">Cookie Notice. </a> </li>
            </ul>
            <p>©KELLER LENKNER UK LTD 2020 </p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center">
           <a href="#"> <img src="{{ $pageData['resource_path'] }}img/logo.png"> </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
          <p>Our legal team believes in making it easier for employees to receive compensation they are 
                legally due.</p>
            <p>Keller Lenkner is a company registered in England and Wales with registration number 11937792 and registered office at 81 Chancery Lane, London, WC2A 1DD. We are authorised and regulated by the Solicitors Regulation Authority with registration number 661050.</p>
            
        </div>
    </div>
    </div>
  </footer> -->
  <!-- Footer Area End -->
  @include('includes.popup')
  <!-- ========= Car Registration Number Analyzing Pop up Start ========= -->
  <div class="modal load_mode fade" id="loade" tabindex="-1" role="dialog" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content custm_cont">
        <div class="modal-body custm_bdy">
          <h6>Validating Your Car Registration Number</h6>
          <div class="col-lg-12 text-center p-0">
            <img src="{{ $pageData['resource_path'] }}img/lod.gif" alt="" class="lo_gif">
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- Modal -->
@endsection
@section('script')
<!-- jQuery -->
<script src="{{ $pageData['resource_path'] }}js/app.js"></script>
@endsection