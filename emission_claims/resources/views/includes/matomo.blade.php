@php
    if(@$_REQUEST['user_id']){
       @$userIdMatomo =  $_REQUEST['user_id'];
    }else if(@$_REQUEST['userId']){
       @$userIdMatomo =  $_REQUEST['userId'];
    }else if(@$data['intUserId']){
        @$userIdMatomo =  $data['intUserId'];
    }else if(@$data['user_id']){
        @$userIdMatomo =  $data['user_id'];
    }else{
       @$userIdMatomo  = '';
    }
    if(@$data['intVisitorId']){
       @$visitorIdMatomo =  @$data['intVisitorId'];
    }else if(@$_REQUEST['visitor_id']){
       @$visitorIdMatomo =  $_REQUEST['visitor_id'];
    }else if(@$_REQUEST['visitorId']){
       @$visitorIdMatomo =  $_REQUEST['visitorId'];
    }else if(@$data['intVisitorId']){
       @$visitorIdMatomo =  $data['intVisitorId'];
    }else if(@$data['visitor_id']){
       @$visitorIdMatomo =  $data['visitor_id'];
    }else{
       @$visitorIdMatomo  = '';
    }
    if(@$data['matomoPageName']){
       @$matomoPageName =  $data['matomoPageName'];
    }else{
       @$matomoPageName =  '';
    }
	// if(env('APP_ENV')=='local' || env('APP_ENV')=='dev'){  
  if(env('APP_ENV')=='pre' || env('APP_ENV')=='live') {
	@endphp
	
<!-- Matomo -->
<script type="text/javascript">
 var _paq = window._paq = window._paq || [];
 /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
 _paq.push(["setCookieDomain", "*.mbemissionsclaim.co.uk"]);
 _paq.push(['setUserId', '<?php echo @$userIdMatomo ?>']);
 _paq.push(['setCustomVariable','1','VisitorId','<?php echo @$visitorIdMatomo ?>']);
 _paq.push(['trackPageView']);
 _paq.push(['enableLinkTracking']);
 (function() {
   var u="https://matomo.spicy-tees.in/";
   _paq.push(['setTrackerUrl', u+'matomo.php']);
   _paq.push(['setSiteId', '16']);
   var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
   g.type='text/javascript'; g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
 })();
</script>
<noscript><p><img src="https://matomo.spicy-tees.in/matomo.php?idsite=16&amp;rec=1" style="border:0;" alt="" /></p></noscript>
<!-- End Matomo Code -->
	@php
	}
@endphp


