@extends('layout.base')

@section('base_title')
    Regist
@endsection

@section('base_body')
    {{-- email regist--}}
    <div class="regist-account">
        <div id="email-pannel" class="show">
            <div class="weui-cells weui-cells_form">
                <div class="weui-cells__title text-black">What's your email address?</div>
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input class="weui-input" name="email" type="text" placeholder="Enter your email">
                    </div>
                </div>
                <div class="weui-cell text-mute">
                     You will use your email address to login and reset your password.
                </div>
            </div>
            <div class="page__bd page__bd_spacing margin-t-b-40">
                <p id="email" class="text-base_mid text-center">Use my mobile number</p>
            </div>
            <div class="page__bd page__bd_spacing">
                <div class="weui-cells  weui-cells_none">
                    <a href="javascript:;" class="weui-btn weui-btn_base"  onclick="regist_continue('email',this)">Continue</a>
                </div>
            </div>
        </div>
        {{-- phone regist--}}
        <div  id="phone-pannel" class="hide">
            <div class="weui-cells">
                <div class="weui-cells__title text-black">What's your mobile number?</div>
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
                <div class="weui-cell text-mute">
                    You will use your mobile number to login and reset your password.
                </div>
            </div>
            <div class="page__bd page__bd_spacing margin-t-b-40">
                <p id="phone" class="text-base_mid text-center">Use my email address</p>
            </div>
            <div class="weui-cells page__bd page__bd_spacing weui-cells_none">
                <a href="javascript:;" class="weui-btn weui-btn_base" onclick="regist_continue('phone',this)">Continue</a>
            </div>
        </div>
    </div>
    <div class="regist-name hide">
        <div class="weui-cells weui-cells_form">
            <div class="weui-cells__title text-black">What's your name?</div>
            <div class="weui-cell">
                <div class="weui-cell__hd text-muted">
                    First Name
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" name="fname" placeholder="Enter your first name">
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd text-muted">
                    Last Name
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" name="lname" placeholder="Enter your last name">
                </div>
            </div>
        </div>
        <div class="weui-cell text-mute">
            Your name will be used for orders.
        </div>
        <div class="weui-cells page__bd page__bd_spacing weui-cells_none">
            <a href="javascript:;" class="weui-btn weui-btn_base" onclick="regist_continue('name',this)">Continue</a>
        </div>
    </div>
    <div  class="regist-password hide">
        <div class="weui-cells weui-cells_form">
            <div class="weui-cells__title text-black">Create a password.</div>
            <div class="weui-cell">
                <div class="weui-cell__hd text-muted">
                    <i class="fa fa-lock"></i>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="password" name="password" placeholder="Enter your password">
                </div>
            </div>
            <div class="weui-cell text-mute">
                Enter a combination of at least 8 numbers, letters and punctuation marks (like ! and &).
            </div>
        </div>
        <div class="weui-cells page__bd page__bd_spacing weui-cells_none">
            <a href="javascript:;" class="weui-btn weui-btn_base" onclick="signup(this)">SIGN UP</a>
        </div>
    </div>
    <div class="text-center page__bd page__bd_spacing">
        <div class="weui-cells weui-cells_none">
            <a href="{{ route('login') }}" class="text-mute">Had an account ?</a>
        </div>
    </div>
@endsection

@section('base_js')
    <script type="text/javascript">
        var email_flag = true;
        var phone_flag = true;
        var pass_flag = true;

        var regist_email = '';
        var regist_contrycode = '';
        var regist_phone = '';
        var regist_fname = '';
        var regist_lname = '';

        $().ready(function(){
            $('#phone').on('click',function(){
                $('#email-pannel').addClass('show').removeClass('hide');
                $('#phone-pannel').addClass('hide').removeClass('show');
            })
            $('#email').on('click',function(){
                $('#phone-pannel').addClass('show').removeClass('hide');
                $('#email-pannel').addClass('hide').removeClass('show');
            })
        })
        function regist_continue(type,tt){
            if(type=='email'){
                if(email_flag){
                    email_flag = false;
                }else{
                    return false;
                }
                var email = $.trim($('#email-pannel').find("input[name='email']").val());
                if(email==''){
                    weui.topTips("Email can't be null");
                    email_flag = true;
                    return false;
                }else{
                    if(email.indexOf('@')<1){
                        weui.topTips("Email invalid");
                        email_flag = true;
                        return false;
                    }
                }
                loadingOn(tt);
                $.post("{{route('available')}}",{type:'email',value:email},function(res){
                    if(res.code===20000){
                        regist_email = email;
                        $('.regist-account').addClass('hide');
                        $('.regist-name').addClass('show').removeClass('hide');
                    }else{
                        weui.topTips(res.msg);
                        email_flag = true;
                    }
                    loadingOff(tt);
                })
            }else if(type=='phone'){
                if(phone_flag){
                    phone_flag = false;
                }else{
                    return false;
                }
                var phone = $.trim($('#phone-pannel').find("input[name='phone']").val());
                var country_code  = $.trim($('#phone-pannel').find("select[name='country_code']").val());
                if(country_code==''){
                    weui.topTips("Country_code can't be null");
                    phone_flag = true;
                    return false;
                }
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
                loadingOn(tt);
                $.post("{{route('available')}}",{type:'mobile',value:phone},function(res){
                    if(res.code===20000){
                        regist_phone = email;
                        regist_contrycode = country_code;
                        $('.regist-account').addClass('hide');
                        $('.regist-name').addClass('show').removeClass('hide');
                    }else{
                        weui.topTips(res.msg);
                        phone_flag = true;
                    }
                    loadingOff(tt);
                })
            }else if(type=='name'){
                var fname = $.trim($(".regist-name input[name='fname']").val());
                var lname = $.trim($(".regist-name input[name='lname']").val());
                if(fname.length<2 || lname.length<2){
                    weui.topTips('Name invaild');
                    return false
                }
                regist_fname = fname;
                regist_lname = lname;
                $('.regist-name').addClass('hide').removeClass('show');
                $('.regist-password').addClass('show').removeClass('hide');
            }else{
                return false;
            }
        }
        function signup(tt){
            if(pass_flag){
                pass_flag = false;
            }else{
                return false;
            }
            var pass  = $.trim($('.regist-password').find("input[name='password']").val());
            if(pass==''){
                weui.topTips("Password can't be null");
                pass_flag = true;
                return false;
            }else{
                var patrn = /^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[\,\<\.\>\/\?\;\:\'\"\[\{\]\}\\\|\ =\+\-\_\)\(\*\&\^\%$\#\@\!\`\~])([a-zA-Z0-9\,\<\.\>\/\?\;\:\'\"\[\{\]\}\\\|\=\+\-\_\)\(\*\&\^\%$\#\@\!\`\~]+).{7,19}$/;
                if(!patrn.exec(pass)){
                    weui.topTips("Password must have Digital,alphabet,special character and min length 8");
                    pass_flag = true;
                    return false;
                }
            }

            var data = {email:regist_email,country_code:regist_contrycode,mobile:regist_phone,password:pass,fname:regist_fname,lname:regist_lname};
            loadingOn(tt);
            $.post("{{route('regist')}}",data,function(res){
                if(res.code===100){
                    location.href = "{{route('user')}}";
                }else{
                    weui.topTips(res.msg);
                    loadingOff(tt);
                    pass_flag = true;
                    return false;
                }
            },'json')
        }
    </script>
@endsection
