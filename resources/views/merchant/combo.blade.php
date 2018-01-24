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
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <div class="weui-flex">
                        <div class="weui-flex__item">
                            {{$item->item_name}}
                        </div>
                        <div class="weui-flex__item text-center">
                            {{$item->item_num}}
                        </div>
                    </div>
                </div>
                <div class="weui-cell__ft text-right">&dollar;{{$item->item_price}}</div>
            </div>
            @empty
                <div class="weui-cell">
                    empty data !
                </div>
            @endforelse
        </div>
        @isset($package)
            <div class="weui-cells subtotal">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        Subtotal
                    </div>
                    <div class="weui-cell__ft text-right">&dollar;38.50</div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        Tax
                    </div>
                    <div class="weui-cell__ft text-right">8.5%</div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        Total
                    </div>
                    <div class="weui-cell__ft text-right">&dollar;41.00</div>
                </div>
            </div>
            <div class="weui-cells list-item">
                <div class="weui-cell">
                    <div class="weui-cell__bd text-center">
                        <i class="fa fa-plus-circle text-mute"></i> Note your order
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_home').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
        })
    </script>
@endsection