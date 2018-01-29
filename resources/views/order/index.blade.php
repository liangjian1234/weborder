@extends('layout.main')

@section('title','My Orders')

@section('main_body')
    @forelse($orders as $order)
    <div class="weui-cells weui-cells_top0 order-lists">
        <div class="weui-cell">
            <div class="weui-cell__hd">
                M Icon
            </div>
            <div class="weui-cell__bd">
                M Name
            </div>
            <div class="weui-cell__ft">
                @switch($order->order_status)
                    @case('N')
                    New
                    @break
                    @case('U')
                    Unpaid
                    @break
                    @case('P')
                    Processing
                    @break
                    @case('S')
                    Success
                    @break
                    @case('C')
                    Cancel
                    @break
                    @case('D')
                    Delete
                    @break
                @endswitch
            </div>
        </div>
        <div class="weui-cell" onclick="order_detail('{{url("/order/{$order->order_id}")}}')" >
            <div class="weui-cell__hd">

            </div>
            <div class="weui-cell__bd">
                {{$order->order_item[0]->item_name}} ... with {{count($order->order_item)}} items
            </div>
            <div class="weui-cell__ft">
                &dollar;{{$order->total_amount}}
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd text-right">
                <a href="" class="list-btn">Reorder</a>
                <a href="" class="list-btn">Go Pay</a>
            </div>
        </div>
    </div>
    @empty
        <div>
            Empty Data !
        </div>
    @endforelse
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_order').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
        })
    </script>

    <script type="text/javascript">
        function order_detail(url){
            location.href = url;
        }
    </script>
@endsection