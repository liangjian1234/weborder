@extends('merchant._main')

@section('main_title','About')

@section('main_head')
@endsection

@section('main_body')
    About
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_about').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
        })
    </script>
@endsection