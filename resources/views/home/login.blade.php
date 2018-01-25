@extends('layout.base')

@section('base_title')
    Login
@endsection

@section('base_body')
    <div id="email-pannel" class="show">
        <div class="weui-cells weui-cells_form">
            <div class="weui-cells__title"><i class="fa fa-envelope"></i></div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" name="email" type="text" placeholder="Enter your email">
                </div>
            </div>
        </div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cells__title"><i class="fa fa-lock"></i></div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" name="password" type="password" placeholder="Enter your password">
                </div>
            </div>
        </div>
        <div class="page__bd page__bd_spacing margin-t-b-40">
            <p id="email" class="text-base_mid">Login via moblie</p>
        </div>
        <div class="page__bd page__bd_spacing">
            <div class="weui-cells">
                <a href="javascript:;" class="weui-btn weui-btn_base" onclick="login('email',this)">LOG IN</a>
            </div>
        </div>
    </div>
    <div id="phone-pannel" class="hide">
        <div class="weui-cells">
            <div class="weui-cells__title"><i class="fa fa-phone"></i></div>
            <div class="weui-cell weui-cell_select weui-cell_select-before">
                <div class="weui-cell__hd">
                    <select class="weui-select" name="country_code">
                        <option value="1">US+1</option>
                    </select>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" name="phone" type="number" pattern="[0-9]*" placeholder="Enter your phone number">
                </div>
            </div>
        </div>
        <div class="weui-cells weui-cells_form">
            <div class="weui-cells__title"><i class="fa fa-lock"></i></div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <input class="weui-input" name="password" type="password" placeholder="Enter your password">
                </div>
            </div>
        </div>
        <div class="page__bd page__bd_spacing margin-t-b-40">
            <p id="phone" class="text-base_mid">Login via email</p>
        </div>
        <div class="page__bd page__bd_spacing">
            <div class="weui-cells">
                <a href="javascript:;" class="weui-btn weui-btn_base" onclick="login('phone',this)">LOG IN</a>
            </div>
        </div>
    </div>
    <div class="page__bd page__bd_spacing">
        <div class="text-right">
            <a href="" class="text-mute">Forgot for password ?</a>
        </div>
        <div class="weui-cells">
            <a href="{{ route('regist') }}" class="weui-btn weui-btn_plain-base">SIGN UP</a>
        </div>
    </div>
@endsection

@section('base_js')
    <script type="text/javascript">
        var email_flag = true;
        var phone_flag = true;
        var loc_href = "{{route($loc_href)}}"
        $().ready(function() {
            $('.weui-tabbar_user').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
            $('#phone').on('click', function () {
                $('#email-pannel').addClass('show').removeClass('hide');
                $('#phone-pannel').addClass('hide').removeClass('show');
            })
            $('#email').on('click', function () {
                $('#phone-pannel').addClass('show').removeClass('hide');
                $('#email-pannel').addClass('hide').removeClass('show');
            })
        })

        //login
        function login(type,tt){
            if(type=='email'){
                if(email_flag){
                    email_flag = false;
                }else{
                    return false;
                }
                var email = $.trim($('#email-pannel').find("input[name='email']").val());
                var pass  = $.trim($('#email-pannel').find("input[name='password']").val());
                if(email==''){
                    weui.topTips("Email can't be null");
                    email_flag = true;
                    return false;
                }else{
                    if(email.indexOf('@')<1  ||  email.indexOf('.')<3){
                        weui.topTips("Email format invalid");
                        email_flag = true;
                        return false;
                    }
                }
                if(pass==''){
                    weui.topTips("Password can't be null");
                    email_flag = true;
                    return false;
                }else{
                    var patrn = /^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[\,\<\.\>\/\?\;\:\'\"\[\{\]\}\\\|\ =\+\-\_\)\(\*\&\^\%$\#\@\!\`\~])([a-zA-Z0-9\,\<\.\>\/\?\;\:\'\"\[\{\]\}\\\|\=\+\-\_\)\(\*\&\^\%$\#\@\!\`\~]+).{7,19}$/;
                    if(!patrn.exec(pass)){
                        weui.topTips("Password invalid");
                        email_flag = true;
                        return false;
                    }
                }
                if(email && pass){
                    var data = {email:email,password:pass};
                    loadingOn(tt);
                    $.post("{{route('login')}}",data,function (res){
                        if(res.code===100){
                            location.href = loc_href;
                        }else{
                            weui.topTips(res.msg);
                            email_flag = true;
                            loadingOff(tt);
                            return false;
                        }
                    },'json')
                }
            }else if(type=='phone'){
                if(phone_flag){
                    phone_flag = false;
                }else{
                    return false;
                }
                var phone = $.trim($('#phone-pannel').find("input[name='phone']").val());
                var pass  = $.trim($('#phone-pannel').find("input[name='password']").val());
                var country_code  = $.trim($('#phone-pannel').find("select[name='country_code']").val());
                if(phone==''){
                    weui.topTips("Phone can't be null");
                    phone_flag = true;
                    return false;
                }else{
                    var partr = /^\d{10}/;
                    if(!partr.exec(phone)){
                        weui.topTips("Phone invalid");
                        phone_flag = true;
                        return false;
                    }
                }
                if(pass==''){
                    weui.topTips("Password can't be null");
                    phone_flag = true;
                    return false;
                }else{
                    var patrn = /^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[\,\<\.\>\/\?\;\:\'\"\[\{\]\}\\\|\ =\+\-\_\)\(\*\&\^\%$\#\@\!\`\~])([a-zA-Z0-9\,\<\.\>\/\?\;\:\'\"\[\{\]\}\\\|\=\+\-\_\)\(\*\&\^\%$\#\@\!\`\~]+).{7,19}$/;
                    if(!patrn.exec(pass)){
                        weui.topTips("Password invalid");
                        phone_flag = true;
                        return false;
                    }
                }
                if(country_code==''){
                    weui.topTips("Country_code can't be null");
                    phone_flag = true;
                    return false;
                }
                if(phone && pass && country_code){
                    var data = {phone:phone,password:pass,country_code:country_code};
                    loadingOn(tt);
                    $.post("{{route('login')}}",data,function (res){
                        if(res.code===100){
                            location.href = loc_href;
                        }else{
                            weui.topTips(res.msg);
                            loadingOff(tt);
                            phone_flag = true;
                            return false;
                        }
                    },'json')
                }
            }else{
                weui.topTips('Request invalid !');
            }
        }
    </script>
@endsection
