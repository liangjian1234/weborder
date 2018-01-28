@extends('layout.base')

@section('base_title','Order Detail')

@section('base_body')
    <div class="page__bd page__bd_spacing order-details-container">
        <div class="weui-cells order-details">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    111
                </div>
                <div class="weui-cell__ft">
                    <span>span</span>
                    <span>2222</span>
                </div>
            </div><div class="weui-cell">
                <div class="weui-cell__bd">
                    111
                </div>
                <div class="weui-cell__ft">
                    <span>span</span>
                    <span>2222</span>
                </div>
            </div><div class="weui-cell item_last">
                <div class="weui-cell__bd">
                    111
                </div>
                <div class="weui-cell__ft">
                    <span>span</span>
                    <span>2222</span>
                </div>
            </div>
            {{--subtotal--}}
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Subtotal
                </div>
                <div class="weui-cell__ft">
                    &dollar;25.6
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Tax
                </div>
                <div class="weui-cell__ft">
                    5%
                </div>
            </div>
            <div class="weui-cell item_total">
                <div class="weui-cell__bd">
                    Total
                </div>
                <div class="weui-cell__ft">
                    &dollar;25.6
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Tax
                </div>
                <div class="weui-cell__ft">
                    5%
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Tax
                </div>
                <div class="weui-cell__ft">
                    5%
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Order Number:
                </div>
                <div class="weui-cell__ft">
                    11111
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Order Status:
                </div>
                <div class="weui-cell__ft">
                    11111
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Pay Status:
                </div>
                <div class="weui-cell__ft">
                    11111
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Pay Method:
                </div>
                <div class="weui-cell__ft">
                    11111
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    Pay Date:
                </div>
                <div class="weui-cell__ft">
                    11111
                </div>
            </div>
            <div class="weui-cell item_total">
                <div class="weui-cell__bd">
                    <div class="weui-flex">
                        <div class="weui-flex__item">
                            Order Note:
                        </div>
                    </div>
                    <div class="weui-flex">
                        <div class="weui-flex__item order-note">
                            asdaskdajlskdjalskddasdasdasdajaslkdjaslkjdalksjdkasdaksdjaksdk
                        </div>
                    </div>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    qrcode
                </div>
            </div>
        </div>
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