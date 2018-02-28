@extends('merchant._main')

@section('main_title','Seating')

@section('main_head')
@endsection

@section('main_body')
    <div class="weui-cells weui-cells_top0">
        <div class="weui-cell">
            <div class="weui-cell__hd" onclick="location.href='{{route('home')}}'">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="weui-cell__bd text-center">
                <p>{{$mchtname}}</p>
            </div>
        </div>
    </div>
    <div class="weui-cells weui-cells_top0 merchant-seat">
        <div class="weui-flex seat-time">
            <div class="weui-flex__item">
                <div class="weui-cell">
                    Approx Waiting Time &nbsp; <span><i class="text-base_mid f_15">5</i> mins</span>
                </div>
            </div>
        </div>
        <div class="weui-flex seat-show">
            <div class="weui-flex__item">
                <div class="weui-cell">
                    <img src="{{asset('images/seat.png')}}" width="100%" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="page__bd page__bd_spacing">
        <div class="weui-cells weui-cells_none">
            <a href="" class="weui-btn weui-btn_base">Get in line</a>
        </div>
    </div>
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_seat').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
        })
    </script>
@endsection