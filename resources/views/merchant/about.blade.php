@extends('merchant._main')

@section('main_title','About')

@section('main_head')
@endsection

@section('main_body')
    <div class="weui-cells weui-cells_top0">
        <div class="weui-cell">
            <div class="weui-cell__hd" onclick="location.href='{{route('home')}}'">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="weui-cell__bd text-center">
                <p>{{$mchtname}}</p>
            </div>
        </div>
    </div>
    <div class="weui-cells weui-cells_top0 merchant-about">
        <div class="merchant-about-img">
            <div class="about-img">
                @forelse($mcht->banner_images as $img)
                    <img class="@if($loop->first) show @else hide @endif" src="{{$img}}" alt="" width="100%">
                    @empty
                    <img  alt="merchant banner" height="250px">
                @endforelse
            </div>
            <div class="arror-left hide">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="arror-right">
                <i class="fa fa-angle-right"></i>
            </div>
        </div>
        <div>
            <div class="weui-flex">
                <div class="weui-flex__item">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><i class="fa fa-home"></i></div>
                        <div class="weui-cell__bd">{{$mcht->address1}}, {{$mcht->city}}, {{$mcht->state}} {{$mcht->zip}}</div>
                    </div>
                </div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><i class="fa fa-phone-square"></i></div>
                        <div class="weui-cell__bd">(650) 129-1293</div>
                    </div>
                </div>
            </div>
            <div class="weui-flex">
                <div class="weui-flex__item">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><i class="fa fa-clock-o"></i></div>
                        <div class="weui-cell__bd">TODAY 11:30 - 13:30 17:00 - 21:00</div>
                        <div class="weui-cell__ft text-primary">OPEN</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="merchant-about-favorite">
        <div class="weui-flex text-center">
            <div class="weui-flex__item"></div>
            <div class="weui-flex__item"><i  class="fa fa-heart-o"></i></div>
            <div class="weui-flex__item"><i  class="fa fa-thumbs-o-up"></i></div>
            <div class="weui-flex__item"></div>
        </div>
    </div>
    <div class="weui-cells weui-cells_top0">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <img src="{{asset('images/map.png')}}" alt="" width="100%">
            </div>
        </div>
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="weui-cell">
                    {{$mcht->mcht_desc}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_about').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');

            var img_index = 0;
            var imgs = $('.merchant-about-img img');
            var imgs_len = $('.merchant-about-img img').length;
            $('.arror-right').on('click',function(){
                if(img_index+1<imgs_len){
                    $.each(imgs,function (k,v) {
                        if(img_index===k){
                            $(v).removeClass('show').addClass('hide');
                        }
                        if(img_index+1===k){
                            $(v).removeClass('hide').addClass('show');
                        }
                    })
                    $('.arror-left').removeClass('hide').addClass('show');
                    if(img_index+1===imgs_len-1){
                        $('.arror-right').removeClass('show').addClass('hide');
                    }
                    img_index++
                }
            })
            $('.arror-left').on('click',function(){
                if(img_index-1>=0){
                    $.each(imgs,function (k,v) {
                        if(img_index===k){
                            $(v).removeClass('show').addClass('hide');
                        }
                        if(img_index-1===k){
                            $(v).removeClass('hide').addClass('show');
                        }
                    })
                    $('.arror-right').removeClass('hide').addClass('show');
                    if(img_index-1===0){
                        $('.arror-left').removeClass('show').addClass('hide');
                    }
                    img_index--
                }
            })
        })
    </script>

@endsection