@extends('layout.base')

@section('base_title','Gallery')

@section('base_body')
    <div class="weui-cells weui-cells_top0 text-white bg-base_mid">
        <div class="weui-cell">
            <div class="weui-cell__hd go-merchant">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="weui-cell__bd text-center">
                {{$merchant_name}}
            </div>
        </div>
    </div>
    <div class="item-details">
    <div class="page__bd_spacing">
        <div class="weui-cells weui-cells_top0 item-details-mid">
            <div class="weui-flex item-img">
                <div class="weui-flex__item">
                    <img src="{{$item_list->default_image_prefix.'/'.$item_list->default_image}}" alt="" width="100%">
                </div>
            </div>
            <div class="weui-flex item-name">
                <div class="weui-flex__item">
                    {{$item_list->item_name}}
                </div>
            </div>
            <div class="weui-flex item-desc">
                <div class="weui-flex__item text-mute">
                    {{$item_list->item_desc}}
                </div>
            </div>
            <div class="weui-flex item-price">
                <div class="weui-flex__item">
                    &dollar;{{$item_list->price}}
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="item-details-bot">
        <div class="weui-cells weui-cells_top0">
            <div class="weui-flex">
                <div class="item-favourite">
                    <div class="weui-cell">
                            {{--<i class="fa fa-heart"></i>--}}
                        <div>
                            @if(empty($item_list->added_to_favorite) || !$item_list->added_to_favorite)
                                <i class="fa fa-heart-o"></i>
                            @else
                                <i class="fa fa-heart"></i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="weui-flex__item item-cart">
                    <div class="weui-cell">
                        @if(empty($item_list->added_to_cart) || !$item_list->added_to_cart)
                            <a href="javascript:;" class="weui-btn weui-btn_base">ADD TO CART</a>
                        @else
                            <a href="javascript:;" class="weui-btn weui-btn_plain-base">IN CART</a>
                        @endif
                    </div>
                </div>
                <div class="item-share">
                    <div class="weui-cell">
                        {{--<i class="fa fa-share"></i>--}}
                        <div>
                            <i class="fa fa-external-link"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('base_js')
    <script type="text/javascript">
        var mcht_id = "{{$merchant_id}}";
        var mcht_name = "{{$merchant_name}}";
        var item_id = "{{$item_list->item_id}}";
        var fav_flag = {{empty($item_list->added_to_favorite)?0:$item_list->added_to_favorite}};
        var car_flag = {{empty($item_list->added_to_cart)?0:$item_list->added_to_cart}};
        $().ready(function(){
            //返回
            $('.go-merchant').on('click',function(){
                location.href  = "{{url('merchant')}}"+"/"+mcht_id+"/"+mcht_name;
            })
            // 收藏
            var favorite_flag = true;
            $('.item-favourite').on('click',function(){
                if(favorite_flag){
                    favorite_flag = false;
                }else{
                    return false;
                }
                if(fav_flag){
                    var data = {type:'delete',item_id:item_id};
                    $(".item-favourite i").removeClass('fa-heart').addClass('fa-heart-o');
                    $.post("{{route('user.favorite')}}",data,function(res){
                        if(res.code===100) {
                            fav_flag = 0;
                        }else{
                            $(".item-favourite i").removeClass('fa-heart-o').addClass('fa-heart');
                            weui.topTips(res.msg,{
                                duration: 3000,
                            });
                        }
                        favorite_flag = true;
                    })
                }else{
                    var data = {type:'post',item_id:item_id};
                    $(".item-favourite i").removeClass('fa-heart-o').addClass('fa-heart');
                    $.post("{{route('user.favorite')}}",data,function(res){
                        if(res.code===100){
                            fav_flag = 1;
                        }else if(res.code===200){
                            $(".item-favourite i").removeClass('fa-heart').addClass('fa-heart-o');
                            weui.confirm('Ready to login in?', {
                                buttons: [{
                                    label: 'NO',
                                    type: 'default',
                                    onClick: function(){  }
                                }, {
                                    label: 'GO !',
                                    type: 'primary',
                                    onClick: function(){ location.href = "{{route('login')}}" }
                                }]
                            });
                        }else{
                            $(".item-favourite i").removeClass('fa-heart').addClass('fa-heart-o');
                            weui.topTips(res.msg);
                        }
                        favorite_flag = true;
                    })
                }
            })
        })
        //操作购物车
        var cart_flag = true;
        $('.item-cart a').on('click',function(){
            if (cart_flag) {
                cart_flag = false;
            } else {
                return false;
            }
            var tt = this;
            if(car_flag){
                var data = {type:'delete',item_id:item_id};
                $(this).removeClass('weui-btn_plain-base').addClass('weui-btn_base');
                $(this).text('ADD TO CART');
                $.post("{{route('user.cart')}}",data,function(res){
                    if(res.code===100){
                        car_flag = 0;
                    }else{
                        $(tt).removeClass('weui-btn_base').addClass('weui-btn_plain-base');
                        $(tt).text('ADD TO CART');
                        weui.topTips(res.msg,{
                            duration: 3000,
                        });
                    }
                    cart_flag = true;
                })
            }else{
                var data = {type:'post',item_id:item_id,mcht_id:mcht_id,item_num:1};
                $(this).removeClass('weui-btn_base').addClass('weui-btn_plain-base');
                $(this).text('IN CART');
                $.post("{{route('user.cart')}}",data,function(res){
                    if(res.code===100){
                        car_flag = 1;
                    }else if(res.code===200){
                        $(tt).removeClass('weui-btn_plain-base').addClass('weui-btn_base');
                        weui.confirm('Ready to login in?', {
                            buttons: [{
                                label: 'NO',
                                type: 'default',
                                onClick: function(){  }
                            }, {
                                label: 'GO !',
                                type: 'primary',
                                onClick: function(){ location.href = "{{route('login')}}" }
                            }]
                        });
                        $(tt).text('ADD TO CART');
                    }else{
                        $(tt).removeClass('weui-btn_plain-base').addClass('weui-btn_base');
                        $(this).text('ADD TO CART');
                        weui.topTips(res.msg);
                    }
                    cart_flag = true;
                })
            }
        })

    </script>
@endsection