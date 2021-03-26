@extends('layouts.splits')
@section('body-class','')
@section('title')
	{{ $data['title'] }}
@endsection
@section('head')
	<link href="{{ $resourcePath }}css/main.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" href="{{ $resourcePath }}img/favicon.ico">
@endsection
@section('content')
<!-- ========= Header Area Start ========= -->
<header class="d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="logo-part col-lg-4 col-md-4 col-12 ">
                <img src="{{ $resourcePath }}img/logo.png" alt="">
            </div>
            <div class="col-lg-6 offset-lg-2 col-md-8 col-12 text-center d-none d-md-block ">
                <h1>Millions of Couples are Missing out on the Marriage Tax Allowance!</h1>
            </div>
        </div>
    </div>
</header>
<!-- ========= Header Area End ========= -->
<!--  ========= signature section  Start  ========= -->
<section class="signature-section">
    <div class="container ">
        <div class="row ">
            <div class="offset-lg-2 col-lg-8 col-12 sign-question">
                @if(@$data['split_name'] == "MTAA_A2.php")
                <h2>In order to submit your Marriage Allowance Benefit with HMRC, we need your electronic signature which will be included on all the forms</h2>
                @else
                <h2>Finally, we need your electronic signature below to proceed</h2>
                @endif
                <div class="offset-lg-2 col-lg-8 col-12">
                    <ul>
                        <li> Sign using your finger, mouse or stylus</li>
                        <li> Keep it fully contained within the box</li>
                        <li> Ensure it is a true likeness of your signature</li>
                    </ul>
                </div>
                <div class="sign-div">
                    <form  action="{{ route('signature.store') }}?user_id={{ $data['intUserId']}}&visitor_id={{ $data['intVisitorId'] }}" id="cust_info" method="POST">
                        @csrf
                        <input type="hidden" name="ajax-path" id="ajax-path" value="{{ $data['APP_URL'] }}">
                        <input type="hidden" name="visitor_id" id="visitor_id" value="{{ $data['intVisitorId'] }}">
                        <input type="hidden" name="user_id" id="user_id" value="{{ $data['intUserId'] }}">
                        <input type="hidden" name="txtTitle" id="txtTitle" value="{{ $data['txtTitle'] }}">
                        <input type="hidden" name="qualifies" id="qualifies" value="Yes">
                        <div class="form-group">
                            
                            @if($data['device'] =='Web')
                                <div id="sign-text-img" class="sign-text text-center">
                                    <img src="{{ $resourcePath }}img/sign-bg.png" class="" alt="">
                                </div>
                                <canvas id="signature-pad" class="signature-pad anim_bt d-none d-lg-block" width="600" height="250" style="touch-action: none;"></canvas>
                            @else
                              <canvas id="signature-pad" class="signature-pad anim_bt d-block d-lg-none" width="350" height="200"  style="touch-action: none;margin: 10px;"></canvas>
                            @endif
                            <input type="hidden" name="signature_data" id="signature_data">
                        </div>
                        <div class="custom-control custom-checkbox text-center anim_red" id="terms_chkbox">
                            <input type="checkbox" class="custom-control-input" id="acceptterms" name="example1">
                            <label class="custom-control-label" for="acceptterms">I agree to the <a style="cursor: pointer; color:#00aab1 !important;" target="_blank" href="signature/terms"> Terms of Business</a></label>
                        </div>
                        <span id ="acceptval"  style="text-align: center"></span>
                        <span id ="checkbox_required" class="error_msg" style="text-align: center; display: none;"></span>
                        <input type="button" id="clear" name="" class="btn-clear" value="Clear">
                        <input type="button" id="save" name="" class="btn-submit" value="Submit" style="padding: 9px 60px;">
                        <span id="signatures_required" class="error_msg"  style="text-align: center;display: none;"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========= signature section  End ========= -->
<!-- Footer Area Start -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>Tax Allowance Awareness and Marriage Tax Allowance Awareness are trading names or styles of Carwood Accountancy Limited. </p>
                <p> Carwood Accountancy Limited is a limited company registered in England &amp; Wales, Company No. 10782318. </p>
                <p> Registered office: Express Networks 3, 6 Oldham Road, Manchester, M4 5DB. </p>
                <p>© 2020 Tax Allowance Awareness &nbsp; | &nbsp; All Rights Reserved.</p>
                <ul>
                    <li><a class="popupLink" data-toggle="modal" data-target="#Privacy"> Privacy Policy</a></li>
                    <li><a class="popupLink" data-toggle="modal" data-target="#Terms"> Terms and Conditions</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->
 @include('includes.popup')
<script src="{{ $resourcePath }}js/app.js"></script>
@endsection