<div class="weui-cells weui-cells_top0 user-info">
    <a class="weui-cell padding-t bg-base_light text-white weui-cell_access" href="{{route('user.settings')}}">
        <div class="weui-cell__bd">
            <p><h2>{{ !empty($user->lname)||!empty($user->mname)||!empty($user->fname)?$user->lname.' '.$user->mname.' '.$user->fname:'Dear user'}}</h2></p>
            <p>enjoy your shopping</p>
        </div>
        <div class="weui-cell__ft text-white"></div>
    </a>
</div>
<div class="weui-grids bg-white">
    <a href="{{route('wallet.index')}}" class="weui-grid">
        <div class="weui-grid__icon text-center text-danger">
            {{$wallet}}
        </div>
        <p class="weui-grid__label">Wallet</p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center text-primary">
            1
        </div>
        <p class="weui-grid__label">Coupon</p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center text-warn">
            500
        </div>
        <p class="weui-grid__label">Coin</p>
    </a>
</div>
@include('user.about')
<div class="page__bd page__bd_spacing">
    <div class="weui-cells weui-cells_none">
        <button class="weui-btn weui-btn_base btn-logout">LOG OUT</button>
    </div>
</div>