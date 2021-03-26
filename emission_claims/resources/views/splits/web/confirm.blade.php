@extends('layouts.splits')
@section('body-class','d-lg-block d-md-block')
@section('title')
    {{ $data['title'] }}
@endsection
@section('head')
    <link href="{{ $resourcePath }}css/main.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="{{ $resourcePath }}img/favicon.ico">
    @include('includes.matomo')
@endsection
@section('content')

 <body onLoad="timedMsg();">
	<section class="header">
		<div class="container">
			<div class="row ">
				<div class="col-lg-12 col-md-12">
					<img src="{{ $resourcePath }}img/favicon.ico" style="" class="d-block mx-auto logo animated  bounceInDown logo-load">
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 loader" >
					<img src="{{ $resourcePath }}img/ajax-loader.gif" class="d-block mx-auto ">
					<p class="text-center">Loading</p>
				</div>
			</div>
		</div>
	</section>
	
@endsection
@section('script')
	<script src="{{ $resourcePath }}js/app.js"></script>
	<script type="text/javascript">
	function gotonext() {
		window.location.href = '{!! $strThankyouPage !!}';
	}
	function timedMsg() {
		var t = setTimeout("gotonext()",3000);//There are 1000 milliseconds in one second.  
    }
	</script>
@endsection
</body>
</html>