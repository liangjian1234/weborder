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
    <div class="weui-tabbar bg-white bottom-main">
        <a href="{{ route('home') }}" class="weui-tabbar__item  weui-tabbar_home">
            <i class="fa fa-list-ul weui-tabbar__icon"></i>
            <p class="weui-tabbar__label">Restaurants</p>
        </a>
        <a href="{{ route('order') }}" class="weui-tabbar__item weui-tabbar_order">
            <i class="fa fa-list-alt weui-tabbar__icon"></i>
            <p class="weui-tabbar__label">Orders</p>
        </a>
        <a href="{{ route('user') }}" class="weui-tabbar__item weui-tabbar_user">
            <i class="fa fa-user weui-tabbar__icon"></i>
            <p class="weui-tabbar__label">Profile</p>
        </a>
    </div>
@endsection

@section('base_js')
    @yield('main_js')
@endsection