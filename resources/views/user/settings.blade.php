@extends('layout.base')

@section('title','Settings')

@section('base_body')
    <div class="weui-cells weui-cells_top0 bg-base_light text-white">
        <div class="weui-cell">
            <div class="weui-cell__hd" onclick="location.href='{{route('user')}}'">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="weui-cell__bd text-center">
                Settings
            </div>
        </div>
    </div>
    <div class="weui-cells">
        <a class="weui-cell weui-cell_access" href="{{route('user.edit',['type'=>'name'])}}">
            <div class="weui-cell__hd">
                <i class="fa fa-user text-blue"></i>
            </div>
            <div class="weui-cell__bd">
                <p class="{{ !empty($user->lname)||!empty($user->mname)||!empty($user->fname)?:'text-mute'}}">{{ !empty($user->lname)||!empty($user->mname)||!empty($user->fname)?$user->lname.' '.$user->mname.' '.$user->fname:'unset name'}}</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
        <a class="weui-cell weui-cell_access" href="{{route('user.edit',['type'=>'email'])}}">
            <div class="weui-cell__hd">
                <i class="fa fa-envelope text-primary"></i>
            </div>
            <div class="weui-cell__bd">
                <p class="{{!empty($user->email)?:'text-mute'}}">{{!empty($user->email)?$user->email:'unset email'}}</p>
            </div>
            <div class="weui-cell__ft {{$user->email_verified=='N'?'text-base_dark':'text-primary'}}">{{!empty($user->email)?$user->email_verified=='N'?'unverified':'verified':''}}</div>
        </a>
        <a class="weui-cell weui-cell_access" href="{{route('user.edit',['type'=>'mobile'])}}">
            <div class="weui-cell__hd">
                <i class="fa fa-phone text-danger"></i>
            </div>
            <div class="weui-cell__bd">
                <p class="{{!empty($user->phone)?:'text-mute'}}">{{!empty($user->phone)?'+'.$user->country_code.' '.$user->phone:'unset phone'}}</p>
            </div>
            <div class="weui-cell__ft {{$user->phone_verified=='N'?'text-base_dark':'text-primary'}}">{{!empty($user->phone)?$user->phone_verified=='N'?'unverified':'verified':''}}</div>
        </a>
    </div>
    <div class="weui-cells">
        <a id="changeStateCity" class="weui-cell weui-cell_access" href="javascript:;">
            <div class="weui-cell__hd">
                <i class="fa fa-send text-base_light"></i>
            </div>
            <div class="weui-cell__bd">
                <p class="{{!empty($user->state)?:'text-mute'}}">{{!empty($user->state)?$user->city.' , '.$user->state:'unset state & city'}}</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
        <a class="weui-cell weui-cell_access" href="{{route('user.edit',['type'=>'address'])}}">
            <div class="weui-cell__hd">
                <i class="fa fa-address-book text-warn"></i>
            </div>
            <div class="weui-cell__bd">
                <p class="{{!empty($user->address)?:'text-mute'}}">{{!empty($user->address)?$user->address:'unset address'}}</p>
            </div>
            <div class="weui-cell__ft"></div>
        </a>
    </div>
@endsection

@section('base_js')
    <script type="text/javascript">
        $().ready(function(){
            $('#changeStateCity').on('click',function(){
                weui.picker([
                    {
                        label: '1',
                        value: '1'
                    }, {
                        label: '2',
                        value: '2'
                    }, {
                        label: '3',
                        value: '3'
                    }
                ], [
                    {
                        label: 'A',
                        value: 'A'
                    }, {
                        label: 'B',
                        value: 'B'
                    }, {
                        label: 'C',
                        value: 'C'
                    }
                ], {
                    defaultValue: ['1', 'A'],
                    onChange: function (result) {
                        console.log(result);
                    },
                    onConfirm: function (result) {
                        console.log(result);
                    },
                    id: 'changeStateCity'
                });
            })
        })
    </script>
@endsection