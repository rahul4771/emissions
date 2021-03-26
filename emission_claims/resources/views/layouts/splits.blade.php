<!-- Stored in resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.splits.headopen',[])
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        @yield('head')
        @include('includes.splits.headclose',[])
        @if(isset($data['source'])) 
            @if(@$data['source'] == App\Repositories\CommonFunctionsRepository::fnGetConfigValue('INSPECTLET_SOURCE') && env('APP_ENV')!="local")
                @include('includes.inspectlet',[])
            @elseif(@$data['source'] == App\Repositories\CommonFunctionsRepository::fnGetConfigValue('INSPECTLET_SOURCE') && env('APP_ENV')=="local")
                <script type="text/javascript">
                    console.log("recording");
                </script>

            @endif
        @endif
        @include('includes.matomo')
    </head>
    <body class="@yield('body-class')">
        @include('includes.splits.bodyopen',[])
        @yield('content')
        @include('includes.splits.bodyclose',[])
        @yield('script')
    </body>
</html>