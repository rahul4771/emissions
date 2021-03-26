@php

$strRedirectUrl        	= trim($_REQUEST['redirect_url']);
$isFBPixelFired 		= 0;
$pid 					= '';
$strCampaign 			= '';

if(isset($_REQUEST['adv_vis_id']) && $_REQUEST['adv_vis_id'] != ''){
    $intUserId              =   trim($_REQUEST['userId']);
    $intVisitorId           =   trim($_REQUEST['visitorId']);
    $intAdvVisId            =   trim($_REQUEST['adv_vis_id']);
    $strRedirectUrl         =   htmlspecialchars_decode(trim($_REQUEST['redirect_url']));

   	if(!empty($_REQUEST['pid'])){
    	$isFBPixelFired = 1;
	    $pid = $_REQUEST['pid'];    
	}
}

@endphp
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>FB Pixel</title>
		@php
		
		if($pid != ""){
			$isFBPixelFired = 1;
			@endphp
			<!-- Facebook Pixel Code -->
			<script>
			    !function(f,b,e,v,n,t,s)
			    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
			    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
			    n.queue=[];t=b.createElement(e);t.async=!0;
			    t.src=v;s=b.getElementsByTagName(e)[0];
			    s.parentNode.insertBefore(t,s)}(window, document,'script',
			    'https://connect.facebook.net/en_US/fbevents.js');
			    fbq('init', '{{ $pid }}');
			    fbq('track', 'PageView');
			    fbq('track', 'Lead');
			</script>
			<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ $pid }}&ev=PageView&noscript=1"/></noscript>
			<!-- End Facebook Pixel Code -->@php
		}
	@endphp
	</head>
	<body onLoad="gotonext();">
		@php
		$strRedirectUrl .= "&fbPixelFired=" . $isFBPixelFired;
		@endphp
		<script type="text/javascript">
		    function gotonext(){
				window.location.href = '{!! $strRedirectUrl !!}';
		    }
		</script>
	</body>
</html>