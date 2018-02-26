<div class="weui-cells weui-cells_top0">
    <a class="weui-cell padding-t weui-cell_access bg-base_light text-white" href="{{route('login')}}">
        <div class="weui-cell__bd">
            <p><h2>LOG IN / SIGN UP</h2></p>
            <p>login to enjoy it !</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
</div>
<div class="weui-grids bg-white">
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center f_15">
            <i class="fa fa-credit-card-alt text-danger"></i>
        </div>
        <p class="weui-grid__label">Wallet</p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center f_15">
            <i class="fa fa-shopping-cart text-primary"></i>
        </div>
        <p class="weui-grid__label">Cart</p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center f_15">
            <i class="fa fa-heart text-warn"></i>
        </div>
        <p class="weui-grid__label">Favorites</p>
    </a>
</div>
@include('user.about')