@extends('layout.main')

@section('main_title','Add Wallet')

@section('main_body')
    <div class="bg-white user-wallet-add">
        <div class="weui-cells weui-cells_top0">
            <div class="weui-cell">
                <div class="weui-cell__hd" onclick="location.href='{{route('user.wallet')}}'">
                    <i class="fa fa-angle-left"></i>
                </div>
                <div class="weui-cell__bd text-center">
                    Add Credit Card
                </div>
            </div>
        </div>
        <div class="page__bd_spacing user-wallet-add-inputs">
            <div class="weui-cells__title">CARD NUMBER</div>
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="number" pattern="[0-9]*" placeholder="number">
                    </div>
                </div>
            </div>
            <div class="weui-cells__title">EXPIRATION DATE</div>
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="date" >
                    </div>
                </div>
            </div>
            <div class="weui-cells__title">CARD HOLDER NAME</div>
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text" placeholder="name">
                    </div>
                </div>
            </div>

            <div class="add-card">
                <a href="javascript:;" class="weui-btn weui-btn_base">ADD MY CARD</a>
            </div>
        </div>
    </div>
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_user').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
        })
    </script>
@endsection