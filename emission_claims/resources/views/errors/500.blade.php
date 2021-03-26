<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Server Error</title>

        <link href="{{ asset('assets/error_500/css/main.css') }}" rel="stylesheet" type="text/css">
        <link rel="icon" type="image/png" href="{{ asset('assets/0602BRN_PD1/img/favicon.ico') }}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="code">
                500</div>
            <div class="message" style="padding: 10px;">Server Error</div>
        </div>
    
        <!-- Modal Contact -->
        <div class="modal fade" id="contact" role="dialog">
            <div class="modal-dialog ">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="modal-title">It looks like we're having some internal issues</h5>
                            </div>
                            <div class="col-md-12">
                                <p> Our team has been notified. If you'd like to help, tell us what happened below.</p>
                            </div>
                        </div>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form name="cust_info" id="cust_info" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="ajax-path" id="ajax-path" value="{{env('APP_URL')}}">
                            <div class="form-group has-feedback">
                                <label>NAME</label>
                                <input type="text" id="name" name="name" class="form-control h45" placeholder="Name">
                            </div>
                          
                            <div class="form-group ">
                                <label>WHAT HAPPENED</label>
                                <textarea class="form-control" rows="5" id="message" name="message" placeholder=""></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" id="contactbutton" class="btn btn-success send_btn center-block">SUBMIT</button>
                            </div>
                            <div class="api_success" id="success_message" style="color: green"></div>
                            <div class="api_error" id="error_message" style="color: red;"></div>
                            
                            @if(app()->bound('sentry') && app('sentry')->getLastEventId())
                                <input type="hidden" id="sentryLastID" name="sentryLastID" value="{{ app('sentry')->getLastEventId() }}">
                            @else
                                <input type="hidden" id="sentryLastID" name="sentryLastID" value="">
                            @endif
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/error_500/js/app.js') }}"></script>
    </body>
</html>
