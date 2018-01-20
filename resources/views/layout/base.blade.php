<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('base_title')</title>
    <!-- 引入 WeUI -->
    <link rel="stylesheet" href="{{ asset('css/weui.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/weui2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/weui3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
</head>
<body ontouchstart>
    <div class="container">
        @section('base_body')
        @show
    </div>

    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/weui.min.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function loadingOn(t){
            $(t).addClass('weui-btn_loading').prepend('<i class="weui-loading"></i>')
        }
        function loadingOff(t){
            $(t).removeClass('weui-btn_loading').find('i').remove();
        }
    </script>
    @section('base_js')
    @show
</body>
</html>