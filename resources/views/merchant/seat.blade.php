@extends('merchant._main')

@section('main_title','Seating')

@section('main_head')
@endsection

@section('main_body')
    seat
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_seat').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
        })
    </script>
@endsection