@extends('layout.base')

@section('base_title')
    {{!empty($title)?$title:'Advancina'}}
@endsection

@section('base_body')
    <div class="weui-cells weui-cells_top0 bg-base_light text-white">
        <div class="weui-cell">
            <div class="weui-cell__hd" onclick="location.href='{{route('user.settings')}}'">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="weui-cell__bd text-center">
                @switch($type)
                    @case('email')
                        Email
                    @break
                    @case('mobile')
                        Mobile
                    @break
                    @case('name')
                        Name
                    @break
                    @case('address')
                        Address
                    @break
                @endswitch
            </div>
        </div>
    </div>
    @switch($type)
        @case('email')
            <div id="email-change" class="{{!empty($user->email)&&$user->email_verified=='N'?'hide':'show'}}">
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell_hd text-muted">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="email" type="text" placeholder="Enter your new email" value="{{$user->email}}">
                        </div>
                    </div>
                </div>
                <div class=" text-center page__bd page__bd_spacing margin-t-b-40 {{!empty($user->email)&&$user->email_verified=='N'?'show':'hide'}}">
                    <p class="text-base_dark" id="verifyEmail">Verify email</p>
                </div>
                <div class="page__bd page__bd_spacing">
                    <div class="weui-cells weui-cells_none">
                        <a href="javascript:;" class="weui-btn weui-btn_base">CHANGE EMAIL</a>
                    </div>
                </div>
            </div>
            <div id="email-verify" class="{{!empty($user->email)&&$user->email_verified=='N'?'show':'hide'}}">
                <div class="weui-cells weui-cells_form">
                    {{--<div class="weui-cell weui-cell_vcode">--}}
                    <div class="weui-cell">
                        <div class="weui-cell_hd text-muted">
                            <i class="fa fa-unlock-alt"></i>
                        </div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="code" type="text" placeholder="Enter your code to verify">
                        </div>
                        {{--<div class="weui-cell__ft">--}}
                            {{--<button class="weui-vcode-btn">Send code</button>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="page__bd page__bd_spacing margin-t-b-40 text-center">
                    <p class="text-base_dark" id="changeEmail">Change email</p>
                </div>
                <div class="page__bd page__bd_spacing">
                    <div class="weui-cells weui-cells_none">
                        <a href="javascript:;" class="weui-btn weui-btn_base">VERIFY EMAIL</a>
                    </div>
                </div>
            </div>
            @break
        @case('mobile')
            <div id="mobile-change" class="{{!empty($user->phone)&&$user->phone_verified=='N'?'hide':'show'}}">
                <div class="weui-cells">
                    <div class="weui-cell weui-cell_select weui-cell_select-before">
                        <div class="weui-cell__hd">
                            <select class="weui-select" name="country_code">
                                <option value="1">US+1</option>
                            </select>
                        </div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="phone" type="number" pattern="[0-9]*" placeholder="Enter your mobile" value="{{$user->phone}}">
                        </div>
                    </div>
                </div>
                <div class="page__bd page__bd_spacing margin-t-b-40 {{!empty($user->phone)&&$user->phone_verified=='N'?'show':'hide'}}">
                    <p class="text-base_dark" id="verifyMobile">Verify mobile</p>
                </div>
                <div class="page__bd page__bd_spacing">
                    <div class="weui-cells weui-cells_none">
                        <a href="javascript:;" class="weui-btn weui-btn_base">CHANGE MOBILE</a>
                    </div>
                </div>
            </div>
            <div id="mobile-verify" class="{{!empty($user->phone)&&$user->phone_verified=='N'?'show':'hide'}}">
                <div class="weui-cells weui-cells_form">
                    {{--<div class="weui-cell weui-cell_vcode">--}}
                    <div class="weui-cell">
                        <div class="weui-cell_hd text-muted">
                            <i class="fa fa-unlock-alt"></i>
                        </div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="code" type="text" placeholder="Enter your code to verify">
                        </div>
                        {{--<div class="weui-cell__ft">--}}
                            {{--<button class="weui-vcode-btn">Send code</button>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="page__bd page__bd_spacing margin-t-b-40">
                    <p class="text-base_dark" id="changeMobile">Change mobile</p>
                </div>
                <div class="page__bd page__bd_spacing">
                    <div class="weui-cells weui-cells_none">
                        <a href="javascript:;" class="weui-btn weui-btn_base">VERIFY MOBILE</a>
                    </div>
                </div>
            </div>
            @break
        @case('name')
            <div class="weui-cells weui-cells_form">
                <div class="weui-cells__title">First Name</div>
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input class="weui-input" name="fname" type="text" value="{{$user->fname}}" placeholder="Enter your first name">
                    </div>
                </div>
            </div>
            <div class="weui-cells weui-cells_form">
                <div class="weui-cells__title">Middle Name</div>
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input class="weui-input" name="mname" type="text" value="{{$user->mname}}" placeholder="Enter your middle name">
                    </div>
                </div>
            </div>
            <div class="weui-cells weui-cells_form">
                <div class="weui-cells__title">Last Name</div>
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input class="weui-input" name="lname" type="text" value="{{$user->lname}}" placeholder="Enter your last name">
                    </div>
                </div>
            </div>
            <div class="page__bd page__bd_spacing">
                <div class="weui-cells weui-cells_none">
                    <a href="javascript:;" class="weui-btn weui-btn_base">OK</a>
                </div>
            </div>
            @break
        @case('address')
            <div class="weui-cells weui-cells_form">
                <div class="weui-cells__title">Address</div>
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input class="weui-input" name="address" type="text" value="{{$user->address}}" placeholder="Enter your address">
                    </div>
                </div>
            </div>
            <div class="page__bd page__bd_spacing">
                <div class="weui-cells weui-cells_none">
                    <a href="javascript:;" class="weui-btn weui-btn_base">OK</a>
                </div>
            </div>
            @break
    @endswitch
@endsection

@section('base_js')
    @switch($type)
        @case('email')
            @include('user.js.email')
         @break
        @case('mobile')
            @include('user.js.phone')
        @break
        @case('name')
            @include('user.js.name')
        @break
        @case('address')
            @include('user.js.address')
        @break
    @endswitch
@endsection