{{--修改mobile信息--}}
<script type="text/javascript">
    var change_flag = true;
    var code_flag = true;
    $().ready(function(){
        $('#changeMobile').on('click',function () {
            $('#mobile-change').removeClass('hide').addClass('show');
            $('#mobile-verify').removeClass('show').addClass('hide');
        })
        $('#verifyMobile').on('click',function () {
            $('#mobile-verify').removeClass('hide').addClass('show');
            $('#mobile-change').removeClass('show').addClass('hide');
        })
        $('#mobile-change .weui-btn').on('click',function(){
            loadingOff(this);
            if(change_flag){
                change_flag = false;
            }else{
                return false;
            }
            var phone = $.trim($('input[name="phone"]').val());
            var country_code = $.trim($('select[name="country_code"]').val());
            if(phone==''){
                weui.topTips("Phone can't be null");
                change_flag = true;
                return false;
            }else{
                var partr = /^\d{10}/;
                if(!partr.exec(phone)){
                    weui.topTips("Phone invalid");
                    change_flag = true;
                    return false;
                }
            }
            if(country_code==''){
                weui.topTips("Country_code can't be null");
                change_flag = true;
                return false;
            }
            var data = {phone:phone,country_code:country_code};
            loadingOn(this);
            var tt = this;
            $.post("{{route('user.edit')}}",data,function(res){
                if(res.code===100){
                    weui.toast('Changed<br/>Code sent', {
                        duration: 3000,
                        callback: function(){
                            $('#mobile-verify').removeClass('hide').addClass('show');
                            $('#mobile-change').removeClass('show').addClass('hide');
                        }
                    });
                }else{
                    weui.topTips(res.msg);
                }
                change_flag = true;
                loadingOff(tt);
            },'json')
        })
        $('#mobile-verify .weui-btn').on('click',function(){
            if(code_flag){
                code_flag = false;
            }else{
                return false;
            }
            var code = $.trim($('input[name="code"]').val());
            if(code==''){
                weui.topTips("Code can't be null");
                code_flag = true;
                return false;
            }
            var data = {type:'phone',code:code};
            loadingOn(this);
            var tt = this;
            $.post("{{route('user.verify')}}",data,function(res){
                if(res.code===100){
                    weui.toast('Verified', {
                        duration: 2000,
                        callback: function(){
                            location.href = "{{route('user')}}";
                        }
                    });
                }else{
                    weui.topTips(res.msg);
                    code_flag = true;
                }
                loadingOff(tt);
            },'json')
        })
    })
</script>