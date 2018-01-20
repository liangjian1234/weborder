{{--修改email信息--}}
<script type="text/javascript">
    $().ready(function(){
        var change_flag = true;
        var code_flag = true;
        $('#changeEmail').on('click',function () {
            $('#email-change').removeClass('hide').addClass('show');
            $('#email-verify').removeClass('show').addClass('hide');
        })
        $('#verifyEmail').on('click',function () {
            $('#email-verify').removeClass('hide').addClass('show');
            $('#email-change').removeClass('show').addClass('hide');
        })
        $('#email-change .weui-btn').on('click',function(){
            if(change_flag){
                change_flag = false;
            }else{
                return false;
            }
            var email = $.trim($('input[name="email"]').val());
            if(email==''){
                weui.topTips("Email can't be null");
                change_flag = true;
                return false;
            }else{
                if(email.indexOf('@')<1  ||  email.indexOf('.')<3){
                    weui.topTips("Email invalid");
                    change_flag = true;
                    return false;
                }
            }
            var data = {email:email};
            loadingOn(this);
            var tt = this;
            $.post("{{route('user.edit')}}",data,function(res){
                if(res.code===100){
                    weui.toast('Changed<br/>Code sent', {
                        duration: 3000,
                        callback: function(){
                            $('#email-verify').removeClass('hide').addClass('show');
                            $('#email-change').removeClass('show').addClass('hide');
                        }
                    });
                }else{
                    weui.topTips(res.msg);
                }
                change_flag = true;
                loadingOff(tt);
            },'json')
        })
        $('#email-verify .weui-btn').on('click',function(){
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
            var data = {type:'email',code:code};
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