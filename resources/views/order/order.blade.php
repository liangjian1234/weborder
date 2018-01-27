@extends('layout.base')

@section('base_title','Order Detail')

@section('base_body')
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
    <div class="weui-cells">
            <p>order_id:{{$order->order_id}}</p>
            <p>order_amount:{{$order->order_amount}}</p>
            <p>total_tax:{{$order->total_tax}}</p>
            <p>total_amount:{{$order->total_amount}}</p>
            <p>order_note:{{$order->order_note}}</p>
    </div>
@endsection

@section('base_js')

@endsection