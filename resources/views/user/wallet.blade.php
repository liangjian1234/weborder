@extends('layout.main')

@section('main_title','Wallet')

@section('main_body')
    <div class="bg-white user-wallet">
        <div class="weui-cells weui-cells_top0">
            <div class="weui-cell">
                <div class="weui-cell__hd" onclick="location.href='{{route('user')}}'">
                    <i class="fa fa-angle-left"></i>
                </div>
                <div class="weui-cell__bd text-center">
                    My Wallet
                </div>
            </div>
        </div>

        <div class="weui-cells">
            <div class="weui-cell">
                <div class="user-card" style="background-color:#1FACF3">
                    <div class="weui-flex text-center text-white">
                        <div class="weui-flex__item">
                            111
                        </div>
                        <div class="weui-flex__item">
                            111
                        </div>
                        <div class="weui-flex__item">
                            111
                        </div>
                        <div class="weui-flex__item">
                            111
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="user-card" style="background-color:#5A54E8">
                    <div class="weui-flex text-center text-white">
                        <div class="weui-flex__item">
                            111
                        </div>
                        <div class="weui-flex__item">
                            111
                        </div>
                        <div class="weui-flex__item">
                            111
                        </div>
                        <div class="weui-flex__item">
                            111
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="user-card" style="background-color:#F9A23A">
                    <div class="weui-flex text-center text-white">
                        <div class="weui-flex__item">
                            111
                        </div>
                        <div class="weui-flex__item">
                            111
                        </div>
                        <div class="weui-flex__item">
                            111
                        </div>
                        <div class="weui-flex__item">
                            111
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="card-add" onclick="location.href='{{route('user.wallet.add')}}'">
                    <div class="text-center text-base_mid">
                        <i class="fa fa-plus-circle"></i>
                        Add a Credit/Debit Card
                    </div>
                </div>
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