@extends('layout.main')

@section('main_title')
    Profile
@endsection

@section('main_body')
    @includeWhen(empty($user),'user.unlogin')
    @includeWhen(!empty($user),'user.info',['user'=>$user])
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_user').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
        })
    </script>
    {{-- 登陆后 用户操作 --}}
    @isset($user)
        <script type="text/javascript">
            $().ready(function(){
                $('.btn-logout').on('click',function(){
                    loadingOn(this)
                    $.get("{{route('logout')}}",{},function(){
                        history.go(0);
                    },'json')
                })
            })
        </script>
    @endisset
@endsection
