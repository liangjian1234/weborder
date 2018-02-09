@extends('layout.main')

@section('main_title','Add Wallet')

@section('main_body')
    <div class="bg-white user-wallet-add">
        <div class="weui-cells weui-cells_top0">
            <div class="weui-cell">
                <div class="weui-cell__hd" onclick="location.href='{{route('wallet.index')}}'">
                    <i class="fa fa-angle-left"></i>
                </div>
                <div class="weui-cell__bd text-center">
                    Add Credit Card
                </div>
            </div>
        </div>
        <div class="page__bd_spacing user-wallet-add-inputs">
            <div class="weui-cells__title">CARD NUMBER</div>
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input class="weui-input" name="card_num" type="number" pattern="[0-9]*" placeholder="number">
                    </div>
                </div>
            </div>
            <div class="weui-cells__title">EXPIRATION DATE</div>
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input name="expire_date" class="weui-input" type="date" >
                    </div>
                </div>
            </div>
            <div class="weui-cells__title">CARD HOLDER NAME</div>
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input name="holder_name" class="weui-input" type="text" placeholder="name">
                    </div>
                </div>
            </div>

            <div class="add-card">
                <a href="javascript:;" class="weui-btn weui-btn_base add-to-card">ADD MY CARD</a>
            </div>
        </div>
    </div>
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_user').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');

            $("input[name='card_num']").on('input',function () {
                var val = $(this).val();
                var len = val.length;
                if(len>16){
                    $(this).val(val.substr(0,16));
                }
            })

            var click_flag = true;
            $('.add-to-card').on('click',function(){
                if(click_flag){
                    click_flag = false;
                }else{
                    return false;
                }
                var date = $("input[name='expire_date']").val();
                var name = $("input[name='holder_name']").val();
                var num = $("input[name='card_num']").val();
                if(date==''){
                    weui.topTips('Please pick EXPIRATION DATE');
                    click_flag = true;
                    return false;
                }
                if(name==''){
                    weui.topTips('Please enter HOLDER NAME');
                    click_flag = true;
                    return false;
                }
                if(num.length>16){
                    weui.topTips('CARD NUMBER error');
                    click_flag = true;
                    return false;
                }
                loadingOn(this);
                var tt = this;
                $.post("{{route('wallet.store')}}",{num:num,date:date,name:name},function(res){
                    if(res.code===10000){
                        location.href = "{{route('wallet.index')}}";
                    }else{
                        weui.topTips(res.msg);
                        click_flag = true;
                        loadingOff(tt);
                        click_flag = true;
                    }
                })
            })
        })
    </script>
@endsection