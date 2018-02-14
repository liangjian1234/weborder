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
                        <div class="weui-flex">
                            <div class="weui-flex__item" id="img_box" >
                            @if(!empty($item_list->images))
                                <img class="" src="{{$item_list->default_image_prefix.'/'.$item_list->images[0]}}" alt="" width="100%">
                            @endif
                            </div>
                        </div>
                        @if(!empty($item_list->images))
                            <div class="img-dot">
                                @foreach($item_list->images as $img)
                                    <i class="fa
                                    @if($loop->first)
                                            fa-circle
                                    @else
                                            fa-circle-o
                                    @endif
                                            text-base_light"></i>
                                @endforeach
                            </div>
                        @endif

                    </div>

                    @isset($item_prev)
                    <div class="item_prev" onclick="href_detail({{$item_prev->item_id}})">
                        <i class="fa fa-angle-double-left"></i>
                    </div>
                    @endisset
                    @isset($item_next)
                    <div class="item_next" onclick="href_detail({{$item_next->item_id}})">
                        <i class="fa fa-angle-double-right"></i>
                    </div>
                    @endisset
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
        //到详情页面
        function href_detail(id){
            $.post("{{url('details')}}",{item_id:id,merchant_id:mcht_id,merchant_name:mcht_name},function(res){
                // console.log(res);return;
                location.href = "{{url('details')}}"+"/"+id;
            });
        }
    </script>

    {{--以下图片相关--}}
    <script type="text/javascript" src="{{asset('js/previewImage.min.js')}}"></script>
    <script type="text/javascript">
        var $$ = {};
        /**
         * get multiple elements
         * @public
         */
        $$.all = function(selector, contextElement) {
            var nodeList,
                list = [];
            if (contextElement) {
                nodeList = contextElement.querySelectorAll(selector);
            } else {
                nodeList = document.querySelectorAll(selector);
            }
            if (nodeList && nodeList.length > 0) {
                list = Array.prototype.slice.call(nodeList);
            }
            return list;
        }

        /**
         * delegate an event to a parent element
         * @public
         * @param  array     $el        parent element
         * @param  string    eventType  name of the event
         * @param  string    selector   target's selector
         * @param  function  fn
         */
        $$.delegate = function($el, eventType, selector, fn) {
            if (!$el) { return; }
            $el.addEventListener(eventType, function(e) {
                var targets = $$.all(selector, $el);
                if (!targets) {
                    return;
                }
                // findTarget:
                for (var i=0; i<targets.length; i++) {
                    var $node = e.target;
                    while ($node) {
                        if ($node == targets[i]) {
                            fn.call($node, e);
                            break; //findTarget;
                        }
                        $node = $node.parentNode;
                        if ($node == $el) {
                            break;
                        }
                    }
                }
            }, false);
        };

        var urls = [];
        @if(!empty($item_list->images))
        @foreach($item_list->images as $image)
            urls.push("{{$item_list->default_image_prefix.'/'.$image}}")
        @endforeach
        @endif
        // var imgs = $$.all('img',$$.all('#img_box')[0]);
        // imgs.forEach(function(v,i){
        //     urls.push(v.src);
        // })

        $$.delegate(document.querySelector('#img_box'), 'click','img',function(){
            var current = this.src;
            var obj = {
                urls : urls,
                current : current
            };
            previewImage.start(obj);
        });
    </script>
@endsection