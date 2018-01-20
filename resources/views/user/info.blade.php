<div class="weui-cells weui-cells_top0">
    <div class="weui-cell">
        {{--<div class="weui-cell__hd"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAuCAMAAABgZ9sFAAAAVFBMVEXx8fHMzMzr6+vn5+fv7+/t7e3d3d2+vr7W1tbHx8eysrKdnZ3p6enk5OTR0dG7u7u3t7ejo6PY2Njh4eHf39/T09PExMSvr6+goKCqqqqnp6e4uLgcLY/OAAAAnklEQVRIx+3RSRLDIAxE0QYhAbGZPNu5/z0zrXHiqiz5W72FqhqtVuuXAl3iOV7iPV/iSsAqZa9BS7YOmMXnNNX4TWGxRMn3R6SxRNgy0bzXOW8EBO8SAClsPdB3psqlvG+Lw7ONXg/pTld52BjgSSkA3PV2OOemjIDcZQWgVvONw60q7sIpR38EnHPSMDQ4MjDjLPozhAkGrVbr/z0ANjAF4AcbXmYAAAAASUVORK5CYII=" alt="" style="width:40px;margin-right:5px;display:block"></div>--}}
        <div class="weui-cell__bd">
            <p><h2>{{ !empty($user->lname)||!empty($user->mname)||!empty($user->fname)?$user->lname.' '.$user->mname.' '.$user->fname:'Dear user'}}</h2></p>
            <p>enjoy your shopping</p>
        </div>
    </div>
</div>
<div class="weui-grids bg-white">
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            0.00
        </div>
        <p class="weui-grid__label">Wallet</p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            1
        </div>
        <p class="weui-grid__label">Coupon</p>
    </a>
    <a href="javascript:;" class="weui-grid">
        <div class="weui-grid__icon text-center">
            500
        </div>
        <p class="weui-grid__label">Coin</p>
    </a>
</div>
<div class="weui-cells">
    <a class="weui-cell weui-cell_access" href="{{route('user.edit',['type'=>'name'])}}">
        <div class="weui-cell__hd">
            <i class="fa fa-user"></i>
        </div>
        <div class="weui-cell__bd">
            <p class="{{ !empty($user->lname)||!empty($user->mname)||!empty($user->fname)?:'text-mute'}}">{{ !empty($user->lname)||!empty($user->mname)||!empty($user->fname)?$user->lname.' '.$user->mname.' '.$user->fname:'unset name'}}</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
    <a class="weui-cell weui-cell_access" href="{{route('user.edit',['type'=>'email'])}}">
        <div class="weui-cell__hd">
            <i class="fa fa-envelope"></i>
        </div>
        <div class="weui-cell__bd">
            <p class="{{!empty($user->email)?:'text-mute'}}">{{!empty($user->email)?$user->email:'unset email'}}</p>
        </div>
        <div class="weui-cell__ft {{$user->email_verified=='N'?'text-danger':'text-primary'}}">{{!empty($user->email)?$user->email_verified=='N'?'unverified':'verified':''}}</div>
    </a>
    <a class="weui-cell weui-cell_access" href="{{route('user.edit',['type'=>'mobile'])}}">
        <div class="weui-cell__hd">
            <i class="fa fa-phone"></i>
        </div>
        <div class="weui-cell__bd">
            <p class="{{!empty($user->phone)?:'text-mute'}}">{{!empty($user->phone)?'+'.$user->country_code.' '.$user->phone:'unset phone'}}</p>
        </div>
        <div class="weui-cell__ft {{$user->phone_verified=='N'?'text-danger':'text-primary'}}">{{!empty($user->phone)?$user->phone_verified=='N'?'unverified':'verified':''}}</div>
    </a>
</div>
<div class="weui-cells">
    <a id="changeStateCity" class="weui-cell weui-cell_access" href="javascript:;">
        <div class="weui-cell__hd">
            <i class="fa fa-send"></i>
        </div>
        <div class="weui-cell__bd">
            <p class="{{!empty($user->state)?:'text-mute'}}">{{!empty($user->state)?$user->city.' , '.$user->state:'unset state & city'}}</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
    <a class="weui-cell weui-cell_access" href="{{route('user.edit',['type'=>'address'])}}">
        <div class="weui-cell__hd">
            <i class="fa fa-address-book"></i>
        </div>
        <div class="weui-cell__bd">
            <p class="{{!empty($user->address)?:'text-mute'}}">{{!empty($user->address)?$user->address:'unset address'}}</p>
        </div>
        <div class="weui-cell__ft"></div>
    </a>
</div>
@include('user.about')
<div class="page__bd page__bd_spacing">
    <div class="weui-cells">
        <button class="weui-btn weui-btn_warn btn-logout">LOG OUT</button>
    </div>
</div>