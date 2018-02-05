@extends('layout.main')

@section('main_title','Cart')

@section('main_head')
@endsection

@section('main_body')
    <div class="weui-cells weui-cells_top0 bg-base_light text-white">
        <div class="weui-cell">
            <div class="weui-cell__hd goto-previous">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="weui-cell__bd text-center">
                <p>Shopping cart</p>
            </div>
        </div>
    </div>

    <div class="page__bd_spacing list-combo">
        <div class="weui-cells list-item">
            @forelse($carts as $item)
                @if($loop->first)
                    <input type="hidden" name="mcht_id" value="{{$item->mcht_id}}">
                @endif
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
                    Your shopping cart is empty !
                </div>
            @endforelse
        </div>
        @if(!empty($carts))
            <div class="weui-cells subtotal">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        Subtotal
                    </div>
                    <div class="weui-cell__ft text-right">&dollar;0.00</div>
                </div>
            </div>
            <div class="dine-take">
                <div class="weui-flex">
                    <div class="weui-flex__item">
                        <a id="dine-in"  class="weui-btn weui-btn_base">Dine In</a>
                    </div>
                    <div class="weui-flex__item">
                        <a  id="take-out" class="weui-btn weui-btn_plain-base">Take Out</a>
                    </div>
                    <input type="hidden" id="order-type" value="1">
                </div>
            </div>
            <div class="weui-cells list-item" id="choose-table">
                <a class="weui-cell weui-cell_access" id="choosetable">
                    <div class="weui-cell__bd">
                        My Table
                    </div>
                    <div class="weui-cell__ft" >
                        # <span id="tableno"></span>
                    </div>
                </a>
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
        {{--var package_id = "{{$package_id}}";--}}
        $().ready(function(){
            $('.weui-tabbar_home').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
            subtotal();
            $('.goto-previous').on('click',function(){
                {{--var mcht = $.trim($('input[name="mcht_id"]').val());--}}
                {{--var url = "{{url('merchant')}}"+"/"+mcht;--}}
                    window.location.href = document.referrer;
            })
            //删除
            $('.dels').on('click',function(){
                var item_id = $.trim($(this).parent().parent().find("input[name='item_id']").val());
                var data = {type:'delete',item_id:item_id};
                var item = $(this).parent().parent();
                item.slideUp(function () {
                    $.post("{{route('user.cart')}}",data,function(res) {
                        if (res.code === 100) {
                            item.remove();
                        }else{
                            item.slideDown();
                            weui.topTips(res.msg);
                        }
                        subtotal();
                    })
                });
            })
            //添加说明
            $('.note_order').on('click',function(){
                $(this).addClass('hide');
                $('.order_note').removeClass('hide').addClass('show');
                $('#order_note').focus();
            })
            //dine or take
            $('#dine-in').on('click',function(){
                if(!$(this).hasClass('weui-btn_base')){
                    $(this).removeClass('weui-btn_plain-base').addClass('weui-btn_base');
                    $('#take-out').removeClass('weui-btn_base').addClass('weui-btn_plain-base');
                    $('#order-type').val(1);
                    $('#choose-table').removeClass('hide').addClass('show');
                }
            })
            $('#take-out').on('click',function(){
                if(!$(this).hasClass('weui-btn_base')){
                    $(this).removeClass('weui-btn_plain-base').addClass('weui-btn_base');
                    $('#dine-in').removeClass('weui-btn_base').addClass('weui-btn_plain-base');
                    $('#order-type').val(2);
                    $('#choose-table').removeClass('show').addClass('hide');
                }
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
                    var order_type = parseInt($.trim($('#order-type').val()));
                    if(order_type===2){
                        var seat_mcht_id = '';
                    }else if(order_type===1){
                        var seat_mcht_id = $.trim($('#tableno').text());
                        if(seat_mcht_id==''){
                            weui.topTips('Please choose table');
                            order_flag = true;
                            return false;
                        }
                    }
                    var items = arr;
                    var order_note = $.trim($('#order_note').val());
                    var mcht_id = $.trim($('input[name="mcht_id"]').val());
                    var data = {mcht_id:mcht_id,type:order_type,items:items,order_note:order_note,order_type:order_type,seat_mcht_id:seat_mcht_id};
                    // order_flag = true;
                    // console.log(data);return false;
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
                                    type: 'base',
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
        });
        //选择桌号
        $('#choosetable').on('click',function(){
            weui.picker([
                 {
                     label: 'Choose Table',
                     value: 0
                 },{
                     label: '1',
                     value: 1
                 },{
                     label: '2',
                     value: 2
                     },
                 {
                     label: '3',
                     value: 3
                     },
                 {
                     label: '4',
                     value: 4,
                 }
                 ], {
                        className: 'weui-cells',
                        container: 'body',
                        defaultValue: [0],
                        onChange: function (result) {
                            // console.log(result)
                            },
                        onConfirm: function (result) {
                            // console.log(result)
                            var no = result[0].value;
                            if(no==0){
                                $('#tableno').text('');
                            }else{
                                $('#tableno').text(no);
                            }
                        },
                    id: 'singleLinePicker'
                });
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
                $('.subtotal .weui-cell__bd').html('Your shopping cart is empty !');
                $('.package_order').addClass('hide');
                $('.note_order').addClass('hide');
                $('#choose-table').addClass('hide');
                $('#take-out').addClass('hide');
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