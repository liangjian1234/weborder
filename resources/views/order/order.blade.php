@extends('layout.base')

@section('base_title','Order Detail')

@section('base_body')
    <div class="weui-cells weui-cells_top0 bg-base_light text-white">
        <div class="weui-cell">
            <div class="weui-cell__hd" onclick="location.href='{{route('order')}}'">
                <i class="fa fa-angle-left"></i> Back
            </div>
            <div class="weui-cell__bd text-center">
                Order Details
            </div>
        </div>
    </div>
    <div class="page__bd page__bd_spacing order-details-container">
        @isset($order)
        <div class="weui-cells order-details">
            @foreach($order->order_item as $item)
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    {{$item->item_name}}
                </div>
                <div class="weui-cell__ft  @if($loop->last) item_last @endif">
                    <span class="text-center">&times;{{$item->item_num}}</span>
                    <span>&dollar;{{$item->item_price}}</span>
                </div>
            </div>
            @endforeach
            {{--subtotal--}}
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Subtotal
                </div>
                <div class="weui-cell__ft">
                    &dollar;{{$order->order_amount}}
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Tax
                </div>
                <div class="weui-cell__ft">
                    &dollar;{{$order->total_tax}}
                </div>
            </div>
            <div class="weui-cell item_total">
                <div class="weui-cell__bd">
                    Total
                </div>
                <div class="weui-cell__ft">
                    &dollar;{{$order->total_amount}}
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Order Number:
                </div>
                <div class="weui-cell__ft">
                    {{$order->order_id}}
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Order Status:
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
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Pay Status:
                </div>
                <div class="weui-cell__ft">
                    @switch($order->pay_status)
                        @case('N')
                            Unpaid
                            @break
                        @case('S')
                            Success
                            @break
                        @case('F')
                            Faliure
                            @break
                        @case('C')
                            Cancel
                            @break
                    @endswitch
                </div>
            </div>
             @if($order->pay_status=='S'||$order->pay_status=='F')
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Pay Method:
                </div>
                <div class="weui-cell__ft">
                    {{$order->pay_method}}
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Pay Date:
                </div>
                <div class="weui-cell__ft">
                    {{$order->pay_date}}
                </div>
            </div>
             @endif
            <div class="weui-cell note-order">
                <div class="weui-cell__bd">
                    <div class="weui-flex">
                        <div class="weui-flex__item">
                            Order Note:
                        </div>
                    </div>
                    <div class="weui-flex">
                        <div class="weui-flex__item order-note">
                            {{$order->order_note}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="weui-cell item_qrcode">
                <div class="weui-cell__bd">
                    {!! QrCode::size(200)->color(236,79,2)->encoding('UTF-8')->generate(route('order.order',['order_id'=>$order->order_id])); !!}
                </div>
            </div>
        </div>
        @endisset
    </div>
    {{--<div class="page__bd_spacing">--}}
        {{--<div class="weui-cells order-details">--}}
            {{--<div class="order-details-cell">--}}
                {{--<div class="weui-flex">--}}
                    {{--<div class="weui-flex__item">--}}
                        {{--<div class="weui-flex">--}}
                            {{--<div class="weui-flex__item">--}}
                                {{--1--}}
                            {{--</div>--}}
                            {{--<div class="placeholder">--}}
                                {{--2--}}
                            {{--</div>--}}
                            {{--<div class="placeholder">--}}
                                {{--3--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div> <div class="weui-flex">--}}
                    {{--<div class="weui-flex__item">--}}
                        {{--<div class="weui-flex">--}}
                            {{--<div class="weui-flex__item">--}}
                                {{--1--}}
                            {{--</div>--}}
                            {{--<div class="placeholder">--}}
                                {{--2--}}
                            {{--</div>--}}
                            {{--<div class="placeholder">--}}
                                {{--3--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div> <div class="weui-flex">--}}
                    {{--<div class="weui-flex__item">--}}
                        {{--<div class="weui-flex">--}}
                            {{--<div class="weui-flex__item">--}}
                                {{--1--}}
                            {{--</div>--}}
                            {{--<div class="placeholder">--}}
                                {{--2--}}
                            {{--</div>--}}
                            {{--<div class="placeholder">--}}
                                {{--3--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('base_js')

@endsection