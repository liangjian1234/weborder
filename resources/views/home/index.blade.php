@extends('layout.main')

@section('main_title','Home')

@section('main_head')
    <style rel="stylesheet" type="text/css" href="{{asset('css/mescroll.min.css')}}"></style>
@endsection

@section('main_body')
    <div class="weui-cells weui-cells_top0 bg-base_light text-white">
        <div class="weui-cell">
            <div class="weui-cell__bd text-center">
                <p>home</p>
            </div>
        </div>
    </div>
@endsection

@section('main_js')

@endsection