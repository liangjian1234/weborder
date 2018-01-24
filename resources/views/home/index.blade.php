@extends('layout.main')

@section('main_title','Home')

@section('main_head')
    <style rel="stylesheet" type="text/css" href="{{asset('css/mescroll.min.css')}}"></style>
@endsection

@section('main_body')
        <div  id="list-items" class="list-items">
            {{--<div class="weui-flex">--}}
                {{--<div class="weui-flex__item">--}}
                    {{--<div class="list-item">--}}
                        {{--<div class="item-favourite text-right text-base_mid">--}}
                            {{--<i class="fa fa-heart-o"></i>--}}
                        {{--</div>--}}
                        {{--<div class="item-img">--}}
                            {{--<img  class="center-block" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAuCAMAAABgZ9sFAAAAVFBMVEXx8fHMzMzr6+vn5+fv7+/t7e3d3d2+vr7W1tbHx8eysrKdnZ3p6enk5OTR0dG7u7u3t7ejo6PY2Njh4eHf39/T09PExMSvr6+goKCqqqqnp6e4uLgcLY/OAAAAnklEQVRIx+3RSRLDIAxE0QYhAbGZPNu5/z0zrXHiqiz5W72FqhqtVuuXAl3iOV7iPV/iSsAqZa9BS7YOmMXnNNX4TWGxRMn3R6SxRNgy0bzXOW8EBO8SAClsPdB3psqlvG+Lw7ONXg/pTld52BjgSSkA3PV2OOemjIDcZQWgVvONw60q7sIpR38EnHPSMDQ4MjDjLPozhAkGrVbr/z0ANjAF4AcbXmYAAAAASUVORK5CYII=" alt="" style="width:100px">--}}
                        {{--</div>--}}
                        {{--<div class="item-name">--}}
                            {{--Chinck past--}}
                        {{--</div>--}}
                        {{--<div class="item-desc">--}}
                            {{--how lacad doddi ldlhf a dsad--}}
                        {{--</div>--}}
                        {{--<div class="item-cart">--}}
                            {{--<div>&dollar;199</div>--}}
                            {{--<div class="text-right text-base_mid"><i class="fa fa-shopping-cart"></i></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="weui-flex__item">--}}
                    {{--<div class="list-item">--}}
                        {{--<div class="item-favourite text-right text-base_mid">--}}
                            {{--<i class="fa fa-heart-o"></i>--}}
                        {{--</div>--}}
                        {{--<div class="item-img">--}}
                            {{--<img  class="center-block" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAuCAMAAABgZ9sFAAAAVFBMVEXx8fHMzMzr6+vn5+fv7+/t7e3d3d2+vr7W1tbHx8eysrKdnZ3p6enk5OTR0dG7u7u3t7ejo6PY2Njh4eHf39/T09PExMSvr6+goKCqqqqnp6e4uLgcLY/OAAAAnklEQVRIx+3RSRLDIAxE0QYhAbGZPNu5/z0zrXHiqiz5W72FqhqtVuuXAl3iOV7iPV/iSsAqZa9BS7YOmMXnNNX4TWGxRMn3R6SxRNgy0bzXOW8EBO8SAClsPdB3psqlvG+Lw7ONXg/pTld52BjgSSkA3PV2OOemjIDcZQWgVvONw60q7sIpR38EnHPSMDQ4MjDjLPozhAkGrVbr/z0ANjAF4AcbXmYAAAAASUVORK5CYII=" alt="" style="width:100px">--}}
                        {{--</div>--}}
                        {{--<div class="item-name">--}}
                            {{--Chinck past--}}
                        {{--</div>--}}
                        {{--<div class="item-desc">--}}
                            {{--how lacad doddi ldlhf a dsad--}}
                        {{--</div>--}}
                        {{--<div class="item-cart">--}}
                            {{--<div>&dollar;199</div>--}}
                            {{--<div class="text-right text-base_mid"><i class="fa fa-shopping-cart"></i></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        {{--回到顶部--}}
        <div id="back-to-top" style="position: fixed;width: 50px;height:50px;bottom:125px;right:-8px;font-size:3em;color:#FF822E"></div>
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
            var merchant_id = "{{$mchtid}}";
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

            /*下拉刷新的回调 */
            function downCallback(){
                getListDataFromNet(0, 1, function(data){
                    mescroll.endSuccess();
                    setListData(data, false);
                }, function(){
                    mescroll.endErr();
                });
            }

            /*上拉加载的回调 page = {num:1, size:10}; num:当前页 从1开始, size:每页数据条数 */
            function upCallback(page){
                //联网加载数据
                getListDataFromNet(page.num, page.size, function(curPageData,totalPage){
                    //联网成功的回调,隐藏下拉刷新和上拉加载的状态;
                    //mescroll会根据传的参数,自动判断列表如果无任何数据,则提示空;列表无下一页数据,则提示无更多数据;
                   // console.log("page.num="+page.num+", page.size="+page.size+", curPageData.length="+curPageData.length);

                    //方法一(推荐): 后台接口有返回列表的总页数 totalPage
                    mescroll.endByPage(curPageData.length, totalPage); //必传参数(当前页的数据个数, 总页数)

                    //方法二(推荐): 后台接口有返回列表的总数据量 totalSize
                    //mescroll.endBySize(curPageData.length, totalSize); //必传参数(当前页的数据个数, 总数据量)

                    //方法三(推荐): 您有其他方式知道是否有下一页 hasNext
                    //mescroll.endSuccess(curPageData.length, hasNext); //必传参数(当前页的数据个数, 是否有下一页true/false)

                    //方法四 (不推荐),会存在一个小问题:比如列表共有20条数据,每页加载10条,共2页.如果只根据当前页的数据个数判断,则需翻到第三页才会知道无更多数据,如果传了hasNext,则翻到第二页即可显示无更多数据.
                    // mescroll.endSuccess(curPageData.length);

                    //设置列表数据
                    setListData(curPageData, true);
                }, function(){
                    //联网失败的回调,隐藏下拉刷新和上拉加载的状态;
                    mescroll.endErr();
                });
            }

            /*设置列表数据*/
            function setListData(curPageData, isAppend) {
                var listDom=document.getElementById("list-items");
                for (var i = 0; i < curPageData.length; i=i+2) {
                    var newObj1=curPageData[i];
                    if(i+1<curPageData.length){
                        var newObj2=curPageData[i+1];
                    }
                    var str1 = '<div class="weui-flex">\n' +
                        '                <div class="weui-flex__item">\n' +
                        '                    <div class="list-item">\n' +
                        '                        <div class="item-favourite text-right text-base_mid">\n' +
                        '                            <i class="fa fa-heart-o"></i>\n' +
                        '                        </div>\n' +
                        '                        <div class="item-img">\n' +
                        '                            <img  class="center-block" src="'+newObj1.default_image_prefix+'/'+newObj1.default_image+'" alt="" style="width:100%">\n' +
                        '                        </div>\n' +
                        '                        <div class="item-name">\n' +
                                                    newObj1.item_name+
                        '                        </div>\n' +
                        '                        <div class="item-desc">\n' +
                                                    newObj1.item_desc+
                        '                        </div>\n' +
                        '                        <div class="item-cart">\n' +
                        '                            <div>&dollar;'+newObj1.price+'</div>\n' +
                        '                            <div class="text-right text-base_mid"><i class="fa fa-shopping-cart"></i></div>\n' +
                        '                        </div>\n' +
                        '                    </div>\n' +
                        '                </div>\n' ;
                    if (typeof(newObj2) == "undefined") {
                        var str = str1+'<div class="weui-flex__item item_none"></div><div>';
                    }else {
                        var str2 = '    <div class="weui-flex__item">\n' +
                            '                    <div class="list-item">\n' +
                            '                        <div class="item-favourite text-right text-base_mid">\n' +
                            '                            <i class="fa fa-heart-o"></i>\n' +
                            '                        </div>\n' +
                            '                        <div class="item-img">\n' +
                            '                            <img  class="center-block" src="' + newObj2.default_image_prefix + '/' + newObj2.default_image + '" alt="" style="width:100%">\n' +
                            '                        </div>\n' +
                            '                        <div class="item-name">\n' +
                            newObj2.item_name +
                            '                        </div>\n' +
                            '                        <div class="item-desc">\n' +
                            newObj2.item_desc +
                            '                        </div>\n' +
                            '                        <div class="item-cart">\n' +
                            '                            <div>&dollar;' + newObj2.price + '</div>\n' +
                            '                            <div class="text-right text-base_mid"><i class="fa fa-shopping-cart"></i></div>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </div>\n' +
                            '            </div>';
                        var str = str1+str2
                    }
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
                    var data = {type:'unlogin',mcht_id:merchant_id,item_status:'A',per_page:pageSize,page:pageNum};
                    $.post("{{route('merchant')}}",data,function(res){
                        // console.log(res)
                        if(res.code===10000){
                            var newArr = res.data;
                            var pages = res.meta.last_page;
                            successCallback&&successCallback(newArr,pages);
                        }
                    })
                }catch(e){
                    //联网失败的回调
                    errorCallback&&errorCallback();
                }
            }

        });
    </script>
@endsection