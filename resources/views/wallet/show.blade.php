@extends('layout.main')

@section('main_title','Edit Wallet')

@section('main_body')
    <div class="bg-white user-wallet-add">
        <div class="weui-cells weui-cells_top0">
            <div class="weui-cell">
                <div class="weui-cell__hd" onclick="location.href='{{route('wallet.index')}}'">
                    <i class="fa fa-angle-left"></i>
                </div>
                <div class="weui-cell__bd text-center">
                    Edit Credit Card
                </div>
            </div>
        </div>
        @isset($card)
        <div class="page__bd_spacing user-wallet-add-inputs">
            <div class="weui-cells__title">CARD NUMBER</div>
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input class="weui-input" name="card_num" type="number" pattern="[0-9]*" value="{{$card->card_num_full}}" placeholder="number">
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
            @if(!$card->default_pay)
            <div class="weui-cells__title">SET AS DEFAULT PAYMENT </div>
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell weui-cell_switch">
                    <div class="weui-cell__bd"></div>
                    <div class="weui-cell__ft">
                        <label for="default_pay" class="weui-switch-cp">
                            <input id="default_pay" name="default-pay" class="weui-switch-cp__input" type="checkbox" value="1">
                            <div class="weui-switch-cp__box"></div>
                        </label>
                    </div>
                </div>
            </div>
            @endif

            <div class="add-card">
                <div class="weui-flex">
                    <div class="weui-flex__item">
                        <a href="javascript:;" class="weui-btn weui-btn_plain-base card-update">UPDATE</a>
                    </div>
                    <div class="weui-flex__item"></div>
                    <div class="weui-flex__item">
                        <a href="javascript:;" class="weui-btn weui-btn_base card-delete">DELETE</a>
                    </div>
                </div>
            </div>
        </div>
        @endisset
    </div>
@endsection

@section('main_js')
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_user').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
        })
    </script>
    @isset($card)
    <script type="text/javascript">
        $().ready(function() {
            var card_id = {{$card->id}};
            $("input[name='card_num']").on('input', function () {
                var val = $(this).val();
                var len = val.length;
                if (len > 16) {
                    $(this).val(val.substr(0, 16));
                }
            })

            var click_flag = true;
            $('.card-update').on('click', function () {
                if (click_flag) {
                    click_flag = false;
                } else {
                    return false;
                }
                var date = $("input[name='expire_date']").val();
                var name = $("input[name='holder_name']").val();
                var num = $("input[name='card_num']").val();
                var pay = $('input[name="default-pay"]').prop('checked');
                if (date == '') {
                    weui.topTips('Please pick EXPIRATION DATE');
                    click_flag = true;
                    return false;
                }
                if (name == '') {
                    weui.topTips('Please enter HOLDER NAME');
                    click_flag = true;
                    return false;
                }
                if (num.length > 16) {
                    weui.topTips('CARD NUMBER error');
                    click_flag = true;
                    return false;
                }
                loadingOn(this);
                var tt = this;
                $.ajax({
                    type: 'PUT',
                    data: {default_pay: pay, card_num: num, date: date, name: name},
                    url: "{{route('wallet.update',['id'=>$card->id])}}",
                    success: function (res) {
                        if (res.code === 100) {
                            location.href = "{{route('wallet.index')}}";
                        } else {
                            weui.topTips(res.msg);
                            loadingOff(tt);
                            click_flag = true;
                        }
                    },
                    error: function (data, json, errorThrown) {
                        console.log(data);
                    }
                });
            })

            $('.card-delete').on('click',function () {
                weui.confirm('Sure to delete?', {
                    buttons: [{
                        label: 'NO',
                        type: 'default',
                        onClick: function(){  }
                    }, {
                        label: 'Delete !',
                        type: 'primary',
                        onClick: function(){
                            loadingOn(this);
                            var tt = this;
                            $.ajax({
                                type: 'DELETE',
                                url: "{{route('wallet.destroy',['id'=>$card->id])}}",
                                success: function (res) {
                                    if (res.code === 100) {
                                        weui.toast('Deleted', {
                                            duration: 2000,
                                            className: 'custom-classname',
                                            callback: function(){ location.href = "{{route('wallet.index')}}"; }
                                        });
                                    } else {
                                        weui.topTips(res.msg);
                                        loadingOff(tt);
                                        click_flag = true;
                                    }
                                },
                                error: function (data, json, errorThrown) {
                                    console.log(data);
                                }
                            });
                        }
                    }]
                });
            })
        })
    </script>
    @endisset
@endsection