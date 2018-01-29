@extends('layout.main')

@section('main_title','Home')

@section('main_head')
@endsection

@section('main_body')
    <div class="weui-cells weui-cells_top0 bg-base_light text-white">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>{{$package->package_name}} --- {{$package->mcht_name}}</p>
                <p>{{$package->package_desc}}</p>
            </div>
        </div>
    </div>

    <div class="page__bd_spacing list-combo">
        <div class="weui-cells list-item">
            @forelse($package->package_item as $item)
            <div class="weui-cell slidelefts">
                <div class="weui-cell__bd">
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <div class="weui-cell weui-cell-name-price">
                                <div class="weui-cell__bd list-item-name">
                                    {{$item->item_name}}
                                    <input type="hidden" name="item_id" value="{{$item->item_id}}">
                                </div>
                                <div class="weui-cell__ft text-center list-item-price">
                                    <span>
                                        &dollar;<span>{{$item->item_price}}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="weui-cell__ft text-right list-item-num"><i class="fa fa-minus-circle" onclick="item_num('desc',this)"></i><span>{{$item->item_num}}</span><i class="fa fa-plus-circle" onclick="item_num('asc',this)"></i></div>
                    </div>
                </div>
                <div class="slideleft">
                    <span class="bg-base_dark text-white dels">Delete</span>
                </div>
            </div>

            @empty
                <div class="weui-cell">
                    empty data !
                </div>
            @endforelse
        </div>
        @if(!empty($package->package_item))
            <div class="weui-cells subtotal">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        Subtotal
                    </div>
                    <div class="weui-cell__ft text-right">&dollar;0.00</div>
                </div>
            </div>
            <div class="weui-cells list-item note_order">
                <div class="weui-cell">
                    <div class="weui-cell__bd text-center">
                        <i class="fa fa-plus-circle text-mute"></i> Note your order
                    </div>
                </div>
            </div>
            <div class="weui-cells list-item order_note hide">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <textarea name="order_note" class="weui-textarea" id="order_note"rows="4"></textarea>
                    </div>
                </div>
            </div>
            <div class="combo_hide_height"></div>
            <div class="package_order">
                <a href="javascript:;" class="weui-btn weui-btn_base order-now">Order Now</a>
            </div>
        @endif
    </div>
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_home').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
            subtotal();
            //删除
            $('.dels').on('click',function(){
                $(this).parent().parent().slideUp(function () {
                    $(this).remove();
                    subtotal();
                });
            })
            //添加说明
            $('.note_order').on('click',function(){
                $(this).addClass('hide');
                $('.order_note').removeClass('hide').addClass('show');
                $('#order_note').focus();
            })
            //下订单
            var order_flag = true;
            $('.order-now').on('click',function(){
                if(order_flag){
                    order_flag = false;
                }else{
                    return false;
                }
                var arr = new Array();
                $('.slidelefts').each(function(){
                    var item_id = parseInt($.trim($(this).find('input[name="item_id"]').val()));
                    var num = parseInt($.trim($(this).find('.list-item-num span').text()));
                    arr.push({
                        item_id:item_id,
                        item_num:num
                    })
                })
                if(arr.length==0){
                    weui.topTips('You have no item!');
                    order_flag = true;
                }else{
                    var items = arr;
                    var order_note = $.trim($('#order_note').val())
                    var data = {items:items,order_note:order_note};
                    loadingOn(this);
                    var tt = this;
                    $.post("{{route('order.store')}}",data,function(res){
                        if(res.code===200){
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
                            loadingOff(tt);
                            order_flag = true;
                        }else if(res.code===10000){
                            location.href = "/order/"+res.data.order_id;
                        }else{
                            weui.topTips(res.msg);
                            loadingOff(tt);
                            order_flag = true;
                        }
                    },'json')
                }
            })
        })
        //num 加减
        function item_num(type,tt){
            var num = parseInt($.trim($(tt).parent().find('span').text()));
            if(type=='asc'){
                $(tt).parent().find('span').text(num+1);
            }else if(type=='desc'){
                if(num>1){
                    $(tt).parent().find('span').text(num-1);
                }else{

                }
            }
            subtotal();
        }
        //计算subtotal
        function subtotal(){
            var subtotal = 0;
            $('.slidelefts').each(function(){
                var price = parseFloat($.trim($(this).find('.list-item-price>span span').text()));
                var num = parseInt($.trim($(this).find('.list-item-num span').text()));
                var t = accMul(price, num);
                subtotal = accAdd(subtotal,t) ;
            })
            if(subtotal == 0){
                $('.subtotal .weui-cell__ft').html('');
                $('.subtotal .weui-cell__bd').html('Scan for your package !');
                $('.package_order').addClass('hide');
                $('.note_order').addClass('hide');
            }else{
                $('.subtotal .weui-cell__ft').html('&dollar;'+subtotal);
            }
        }
        /**
         * 乘法
         * @param arg1
         * @param arg2
         * @returns {Number}
         */
        function accMul(arg1, arg2) {
            var m = 0, s1 = arg1.toString(), s2 = arg2.toString();
            try { m += s1.split(".")[1].length } catch (e) { }
            try { m += s2.split(".")[1].length } catch (e) { }
            return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m)
        }
        /**
         * 加法
         * @param arg1
         * @param arg2
         * @returns {Number}
         */
        function accAdd(arg1, arg2) {
            var r1, r2, m, c;
            try { r1 = arg1.toString().split(".")[1].length } catch (e) { r1 = 0 }
            try { r2 = arg2.toString().split(".")[1].length } catch (e) { r2 = 0 }
            c = Math.abs(r1 - r2);
            m = Math.pow(10, Math.max(r1, r2))
            if (c > 0) {
                var cm = Math.pow(10, c);
                if (r1 > r2) {
                    arg1 = Number(arg1.toString().replace(".", ""));
                    arg2 = Number(arg2.toString().replace(".", "")) * cm;
                }
                else {
                    arg1 = Number(arg1.toString().replace(".", "")) * cm;
                    arg2 = Number(arg2.toString().replace(".", ""));
                }
            }
            else {
                arg1 = Number(arg1.toString().replace(".", ""));
                arg2 = Number(arg2.toString().replace(".", ""));
            }
            return (arg1 + arg2) / m
        }
    </script>
    <script type="text/javascript" src="{{asset('js/zepto.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/slideleft.js')}}"></script>
@endsection