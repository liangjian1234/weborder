<script type="text/javascript">
    var flag = true;
    $().ready(function(){
        $('.weui-btn').on('click',function(){
            if(flag){
                flag = false;
            }else{
                return false;
            }
            var fname = $.trim($("input[name='fname']").val());
            var mname = $.trim($("input[name='mname']").val());
            var lname = $.trim($("input[name='lname']").val());

            var data = {fname:fname,mname:mname,lname:lname};
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