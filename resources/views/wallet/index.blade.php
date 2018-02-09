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
        @forelse($cards as $card)
        <div class="weui-cells">
            <div class="weui-cell card-list">
                <div class="user-card">
                    <img src="{{asset('images/'.config('advancina.pay_method_img.'.$card->pay_method))}}" alt="">
                    <span class="card_num">{{$card->card_num}}</span>
                </div>
            </div>
        </div>
        @empty
        @endforelse

        <div class="weui-cells">
            <div class="weui-cell card-list">
                <div class="card-add" onclick="location.href='{{route('wallet.create')}}'">
                    <div class="text-center text-base_mid">
                        <i class="fa fa-plus-circle"></i>
                        Add a Credit/Debit Card
                    </div>
                </div>
            </div>
        </div>

        @if(empty($cards))
            <div class="weui-cells">
                <div class="text-center text-base_light">
                    You have no payment method yet.
                </div>
            </div>
        @endif
    </div>
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_user').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
        })
    </script>
@endsection