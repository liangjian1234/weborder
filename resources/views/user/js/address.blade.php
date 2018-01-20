<script type="text/javascript">
    var flag = true;
    $().ready(function(){
        $('.weui-btn').on('click',function(){
            if(flag){
                flag = false;
            }else{
                return false;
            }
            var address = $.trim($("input[name='address']").val());

            var data = {address:address};
            loadingOn(this);
            var tt = this;
            $.post("{{route('user.edit')}}",data,function(res){
                if(res.code===100){
                    weui.toast('Changed', {
                        duration: 2000,
                        callback: function(){
                            location.href = "{{route('user')}}";
                        }
                    });
                }else{
                    weui.topTips(res.msg);
                    flag = true;
                }
                loadingOff(tt);
            },'json')
        })
    })
</script>