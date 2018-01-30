@extends('layout.main')

@section('main_title','Home')

@section('main_head')
    <style rel="stylesheet" type="text/css" href="{{asset('css/mescroll.min.css')}}"></style>
@endsection

@section('main_body')
    {{--<div class="weui-cells weui-cells_top0 bg-base_light text-white">--}}
        {{--<div class="weui-cell">--}}
            {{--<div class="weui-cell__bd text-center">--}}
                {{--<p>home</p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="merchant-list" id="merchant-list">

    </div>
    {{--回到顶部--}}
    <div id="back-to-top" class="back-to-top"></div>


    {{--<div class="weui-cells">--}}
        {{--<div class="weui-cell">--}}
            {{--<div class="weui-cell__bd">--}}
                {{--<div class="weui-flex">--}}
                    {{--<div class="weui-flex__item f_15">--}}
                        {{--name--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="weui-flex">--}}
                    {{--<div class="weui-flex__item">--}}
                        {{--<i class="fa fa-dot-circle-o text-base_light f_08"></i> address1--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="weui-flex">--}}
                    {{--<div class="weui-flex__item">--}}
                        {{--<i class="fa fa-dot-circle-o text-base_light f_08"></i> address2--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="weui-cell__ft">--}}
                    {{--city--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('main_js')
    <script type="text/javascript" src="{{asset('js/mescroll.min.js')}}"></script>
    <script type="text/javascript">
        $().ready(function(){
            $('.weui-tabbar_home').addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
        })
    </script>
    <script type="text/javascript" charset="utf-8">
        $(function(){
            //创建MeScroll对象
            var mescroll = new MeScroll("mescroll", {
                down: {
                    use:false
                },
                up: {
                    auto: true, //是否在初始化时以上拉加载的方式自动加载第一页数据; 默认false
                    isBounce: false, //此处禁止ios回弹,解析(务必认真阅读,特别是最后一点): http://www.mescroll.com/qa.html#q10
                    callback: upCallback, //上拉回调,此处可简写; 相当于 callback: function (page) { upCallback(page); }
                    toTop:{ //配置回到顶部按钮
                        warpId:'back-to-top',
                        {{--src : "{{asset('images/icon_nav_button.png')}}", //默认滚动到1000px显示,可配置offset修改--}}
                        showClass: "show",
                        hideClass:"hide",
                        html:"<i class='fa fa-chevron-circle-up'></i>"
                        //offset : 1000
                    },
                    htmlLoading:'<div class="weui-loadmore text-base_light">\n' +
                    '            <i class="weui-loading"></i>\n' +
                    '            <span class="weui-loadmore__tips">Loading data</span>\n' +
                    '        </div>',
                    htmlNodata:'<div class="weui-loadmore weui-loadmore_line">\n' +
                    '            <span class="weui-loadmore__tips">No more</span>\n' +
                    '        </div>',
                }
            });
            function downCallback(){
                getListDataFromNet(0, 1, function(data){
                    mescroll.endSuccess();
                    setListData(data, false);
                }, function(){
                    mescroll.endErr();
                });
            }
            function upCallback(page){
                getListDataFromNet(page.num, page.size, function(curPageData,totalPage){
                    mescroll.endByPage(curPageData.length, totalPage); //必传参数(当前页的数据个数, 总页数)
                    setListData(curPageData, true);
                }, function(){
                    mescroll.endErr();
                });
            }
            function setListData(curPageData, isAppend) {
                var listDom=document.getElementById("merchant-list");
                for (var i = 0; i < curPageData.length; i++) {
                    var newObj1=curPageData[i];
                    var url = "{{url('merchant')}}"+"/"+newObj1.mcht_id;
                    var start = '    <div class="weui-cells">\n' +
                        '        <a class="weui-cell weui-cell_access" href="'+url+'">\n' +
                        '            <div class="weui-cell__bd">\n' +
                        '                <div class="weui-flex">\n' +
                        '                    <div class="weui-flex__item f_15">\n' +
                        newObj1.mcht_name+
                        '                    </div>\n' +
                        '                </div>\n' ;
                    if(newObj1.address1===null || newObj1.address1===''){
                        var address1 = '';
                    }else{
                        var address1 = '<div class="weui-flex">\n' +
                        '                    <div class="weui-flex__item">\n' +
                        '                        <i class="fa fa-dot-circle-o text-base_light f_08"></i>&nbsp;<span class="text-mute">\n' +
                        newObj1.address1+
                        '                    </span></div>\n' +
                        '                </div>\n';
                    }
                    if(newObj1.address2===null || newObj1.address2===''){
                        var address2 = '';
                    }else {
                        var address2 = '<div class="weui-flex">\n' +
                            '                    <div class="weui-flex__item">\n' +
                            '                        <i class="fa fa-dot-circle-o text-base_light f_08"></i>&nbsp;<span class="text-mute">\n' +
                            newObj1.address2 +
                            '                    </span></div>\n' +
                            '                </div>\n';
                    }
                    var end = '</div>\n' +
                        '            <div class="weui-cell__ft">\n' +
                        newObj1.city+
                        '            </div>\n' +
                        '        </a>\n' +
                        '    </div>';
                    var str = start+address1+address2+end;
                    var liDom=document.createElement("div");
                    liDom.innerHTML=str;
                    if (isAppend) {
                        listDom.appendChild(liDom);//加在列表的后面,上拉加载
                    } else{
                        listDom.insertBefore(liDom, listDom.firstChild);//加在列表的前面,下拉刷新
                    }
                }
            }

            var downIndex=0;
            function getListDataFromNet(pageNum,pageSize,successCallback,errorCallback) {
                try{
                    var data = {status:'A',per_page:pageSize,page:pageNum};
                    $.post("{{route('home')}}",data,function(res){
                        // console.log(res)
                        if(res.code===10000){
                            var newArr = res.data;
                            var pages = res.meta.last_page;
                            successCallback&&successCallback(newArr,pages);
                        }
                    })
                }catch(e){
                    errorCallback&&errorCallback();
                }
            }
        });
    </script>
@endsection