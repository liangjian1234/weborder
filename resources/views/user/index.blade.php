@extends('layout.main')

@section('main_title')
    Profile
@endsection

@section('main_body')
    @includeWhen(!isset($user),'user.unlogin')
    @includeWhen(isset($user),'user.info',['user'=>$user])
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
                        id: 'multiPickerBtn'
                    });
                })
            })
        </script>
    @endisset
@endsection
