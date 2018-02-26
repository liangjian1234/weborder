@extends('layout.base')

@section('base_title')
    @yield('main_title')
@endsection

@section('base_head')
    @yield('main_head')
@endsection
@section('base_body')
    <div class="page__bd" style="height: 100%;">
        <div class="weui-tab">
            <div class="weui-tab__panel mescroll" id="mescroll">
                @yield('main_body')
            </div>
        </div>
    </div>
    <div class="weui-tabbar bg-white bottom-main bottom-merchant-main bg-base_light">
        <a href="{{route('merchant.merchant',['mchtid'=>$mchtid,'mchtname'=>$mchtname])}}" class="weui-tabbar__item  weui-tabbar_menu">
            <i class="fa fa-list-ul weui-tabbar__icon"></i>
            <p class="weui-tabbar__label">Menu</p>
        </a>
        <a href="{{route('merchant.seat',['mchtid'=>$mchtid,'mchtname'=>$mchtname])}}" class="weui-tabbar__item weui-tabbar_seat">
            <i class="fa fa-list-alt weui-tabbar__icon"></i>
            <p class="weui-tabbar__label">Seating</p>
        </a>
        <a href="{{route('merchant.about',['mchtid'=>$mchtid,'mchtname'=>$mchtname])}}" class="weui-tabbar__item weui-tabbar_about">
            <i class="fa fa-user weui-tabbar__icon"></i>
            <p class="weui-tabbar__label">About</p>
        </a>
    </div>
@endsection

@section('base_js')
    @yield('main_js')
@endsection