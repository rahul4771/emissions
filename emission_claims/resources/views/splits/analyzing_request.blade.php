@extends('layouts.splits')
@section('body-class','d-lg-block d-md-block')
@section('title')
  {{ $data['title'] }}
@endsection
@section('head')
  <link href="{{ $resourcePath }}css/main.css" rel="stylesheet" type="text/css">
  <link rel="icon" type="image/png" href="{{ $resourcePath }}img/favicon.png">
  <?php /* ?> 
  @include('includes.matomo')
  <?php */?>
@endsection
@section('content')
  <!-- ===== Header Start  ===== -->
  <header>
    <div class="container-fluid">
      <div class="row">
         <div class="logo-part offset-lg-3 offset-md-3 offset-2 col-lg-6 col-md-6 col-8 text-center animated bounceInDown">
          <img src="{{ $resourcePath }}/img/logo.jpg" alt="">
          <!-- <img src="{{ $resourcePath }}img/meclogo.png" alt="" class="mcelogo"> -->
         </div>
      </div>
    </div>
  </header>
  <!-- ===== Header End  ===== -->

  <!-- ===== Section Start  ===== -->
  <section class="content-section">
    <div class="container ">
      <div class="row ">
        <div class="col-lg-10 offset-lg-1 col-12 mp0  text-center animated bounceInDown">
          <img src="{{ $resourcePath }}img/anal.gif" alt="">
            <h3>Analyzing Your Request...!</h3>
        </div>
      </div>
    </div>
  </section>
  <!-- =====  Section End  ===== -->

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
@endsection
@section('script')
<script src="{{$resourcePath}}js/app.js"></script>
<script type="text/javascript">
  function gotonext() {
    window.location.href = '{!! $anaylzeEndPage !!}';
  }
  function timedMsg() {
    let t = setTimeout("gotonext()",3000);//There are 1000 milliseconds in one second.  
  }
</script>
@endsection