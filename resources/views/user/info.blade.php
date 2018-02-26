<div class="weui-cells weui-cells_top0 user-info">
    <a class="weui-cell padding-t bg-base_light text-white weui-cell_access" href="{{route('user.settings')}}">
        <div class="weui-cell__bd">
            <p><h2>{{ !empty($user->lname)||!empty($user->mname)||!empty($user->fname)?$user->fname.' '.$user->mname.' '.$user->lname:'Dear user'}}</h2></p>
            <p>Welcome back</p>
        </div>
        <div class="weui-cell__ft text-white"></div>
    </a>
</div>
<div class="weui-grids bg-white">
    <a href="{{route('wallet.index')}}" class="weui-grid">
        <div class="weui-grid__icon text-center text-danger">
            {{$user->count_wallets}}
        </div>
        <p class="weui-grid__label">Wallet</p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center text-primary">
            {{$user->count_carts}}
        </div>
        <p class="weui-grid__label">Cart</p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center text-warn">
            {{$user->count_favorites}}
        </div>
        <p class="weui-grid__label">Favorites</p>
    </a>
</div>
@include('user.about')
<div class="page__bd page__bd_spacing">
    <div class="weui-cells weui-cells_none text-center text-base_light">
        <a class="btn-logout">LOG OUT</a>
    </div>
</div>