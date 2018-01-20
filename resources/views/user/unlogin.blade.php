<div class="weui-cells weui-cells_top0">
    <a class="weui-cell weui-cell_access" href="{{route('login')}}">
        <div class="weui-cell__bd">
            <p><h2>LOG IN / SIGN UP</h2></p>
            <p>login to enjoy it !</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
</div>
<div class="weui-grids bg-white">
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="fa fa-credit-card-alt"></i>
        </div>
        <p class="weui-grid__label">Wallet</p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="fa fa-ticket"></i>
        </div>
        <p class="weui-grid__label">Coupon</p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            <i class="fa fa-bandcamp"></i>
        </div>
        <p class="weui-grid__label">Coin</p>
    </a>
</div>
@include('user.about')