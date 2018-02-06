@extends('layout.main')

@section('main_title','My Orders')

@section('main_body')
    <div class="weui-cells weui-cells_top0 order-list-top">
        <div class="weui-flex">
            <div class="weui-flex__item text-left">
                <div class="item-top-date" id="order-by">
                    <span>Order date</span> <i class="fa fa-caret-down"></i>
                </div>
            </div>
            <div class="weui-flex__item text-right">
                <div class="item-top-status" id="order-status">
                    <span>Order status</span> <i class="fa fa-caret-down"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="weui-cells weui-cells_top0 order-lists">
        @forelse($orders as $order)
            <div class="weui-cell" onclick="order_detail('{{url("/order/{$order->order_id}")}}')">
                <div class="weui-cell__bd">
                    <p><h4>{{$order->mcht_name}}</h4></p>
                    <p>{{date('Y-m-d h:i A',strtotime($order->order_on->date))}}</p>
                </div>
                <div class="weui-cell__ft">
                    <p>&dollar;{{$order->total_amount}}</p>
                    <p class="text-{{strtolower(config('advancina.order_status.'.$order->order_status))}}">{{config('advancina.order_status.'.$order->order_status)}}</p>
                </div>
            </div>
        @empty
            <div>
                Empty Data !
            </div>
        @endforelse
    </div>
    {{--<div class="weui-cells weui-cells_top0 order-lists">--}}
        {{--<div class="weui-cell">--}}
            {{--<div class="weui-cell__hd">--}}
                {{--M Icon--}}
            {{--</div>--}}
            {{--<div class="weui-cell__bd">--}}
                {{--M Name--}}
            {{--</div>--}}
            {{--<div class="weui-cell__ft">--}}
                {{--{{config('advancina.order_status.'.$order->order_status)}}--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="weui-cell" onclick="order_detail('{{url("/order/{$order->order_id}")}}')" >--}}
            {{--<div class="weui-cell__hd">--}}

            {{--</div>--}}
            {{--<div class="weui-cell__bd">--}}
                {{--{{$order->order_item[0]->item_name}} ... with {{count($order->order_item)}} items--}}
            {{--</div>--}}
            {{--<div class="weui-cell__ft">--}}
                {{--&dollar;{{$order->total_amount}}--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="weui-cell">--}}
            {{--<div class="weui-cell__bd text-right">--}}
                {{--<a href="" class="list-btn">Reorder</a>--}}
                {{--<a href="" class="list-btn">Go Pay</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            //状态
            var order_status = new Array();
            @foreach($order_status as $key=>$status)
                order_status.push({
                    label:'{{$status}}',
                    value:'{{$key}}',
                })
            @endforeach

            $('.weui-tabbar_order').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
            //切换排序方式
            $('#order-by').on('click',function() {
                weui.picker([
                    {
                        label:'Date',
                        value:'date',
                    }
                ],{
                    className: 'weui-cells',
                    container: 'body',
                    defaultValue: [0],
                    onChange: function (result) {
                        // console.log(result)
                    },
                    onConfirm: function (result) {
                        console.log(result)
                        var s_value = result[0].value;
                        var s_label = result[0].label;
                        if(s_value==0){
                            $('#order-by span').text('Order Date');
                        }else{
                            $('#order-by span').text(s_label);
                        }
                    },id:'picker-order'
                })
            })
            //切换订单状态
            $('#order-status').on('click',function(){
                weui.picker(
                    order_status,{
                        className: 'weui-cells',
                        container: 'body',
                        defaultValue: [0],
                        onChange: function (result) {
                            // console.log(result)
                        },
                        onConfirm: function (result) {
                            console.log(result)
                            var s_value = result[0].value;
                            var s_label = result[0].label;
                            if(s_value==0){
                                $('#order-status span').text('Order status');
                            }else{
                                $('#order-status span').text(s_label);
                            }
                        },
                        id: 'picker-status'
                    }
                )
            })
        })
    </script>

    <script type="text/javascript">
        function order_detail(url){
            location.href = url;
        }
    </script>
@endsection