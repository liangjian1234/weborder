@extends('layout.main')

@section('main_title','Home')

@section('main_head')
    <style rel="stylesheet" type="text/css" href="{{asset('css/mescroll.min.css')}}"></style>
@endsection

@section('main_body')
    <div class="weui-cells weui-cells_top0 merchant-list-top">
        <form action="{{route('home')}}" method="get">
        <div class="weui-flex">
            <div class="weui-flex__item text-left">
                <div class="item-food-type" id="food-type">
                    <span>{{empty($food_type)?'Food type':config('advancina.ethnic_type.'.$food_type,'')}}</span> <i class="fa fa-caret-down"></i>
                    <input type="hidden" name="food_type" value="{{$food_type}}">
                </div>
            </div>
            <div class="weui-flex__item text-right">
                <div class="item-search" id="search">
                    <input class="weui-input" type="text" name="mcht_name" placeholder="Find by name" value="{{$mcht_name}}">
                    <i class="fa fa-search-plus text-black"></i>
                </div>
            </div>
        </div>
        </form>
    </div>

    <div class="merchant-list weui-cells weui-cells_top0" id="merchant-list">
    </div>
    <div class="isempty">

    </div>
    {{--回到顶部--}}
    <div id="back-to-top" class="back-to-top"></div>
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
                if(curPageData.length<1){
                    var str = '<div class="weui-loadmore weui-loadmore_line">' +
                        '            <span class="weui-loadmore__tips">Empty Data !</span>' +
                        '        </div>';
                    $('.isempty').html(str);
                }else {
                    for (var i = 0; i < curPageData.length; i++) {
                        var newObj1 = curPageData[i];
                        var address = '';
                        if (newObj1.address1 != null && newObj1.address1 != '') {
                            address = newObj1.address1;
                        } else if (newObj1.address2 != null && newObj1.address2 != '') {
                            address = newObj1.address2;
                        }
                        var str = '<div class="weui-cell__hd"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAuCAMAAABgZ9sFAAAAVFBMVEXx8fHMzMzr6+vn5+fv7+/t7e3d3d2+vr7W1tbHx8eysrKdnZ3p6enk5OTR0dG7u7u3t7ejo6PY2Njh4eHf39/T09PExMSvr6+goKCqqqqnp6e4uLgcLY/OAAAAnklEQVRIx+3RSRLDIAxE0QYhAbGZPNu5/z0zrXHiqiz5W72FqhqtVuuXAl3iOV7iPV/iSsAqZa9BS7YOmMXnNNX4TWGxRMn3R6SxRNgy0bzXOW8EBO8SAClsPdB3psqlvG+Lw7ONXg/pTld52BjgSSkA3PV2OOemjIDcZQWgVvONw60q7sIpR38EnHPSMDQ4MjDjLPozhAkGrVbr/z0ANjAF4AcbXmYAAAAASUVORK5CYII=" alt="" style="width:65px;margin-right:5px;display:block"></div>\n' +
                            '                <div class="weui-cell__bd">\n' +
                            '                    <div class="weui-flex">\n' +
                            '                        <div class="weui-flex__item"><h4>\n' +
                            newObj1.mcht_name +
                            '                        </h4></div>\n' +
                            '                    </div>\n' +
                            '                    <div class="weui-flex">\n' +
                            '                        <div class="weui-flex__item f_08">\n' +
                            address + ' , ' + newObj1.city +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '<input type="hidden" name="mcht_id" value="' + newObj1.mcht_id + '">' +
                            '<input type="hidden" name="mcht_name" value="' + newObj1.mcht_name + '">' +
                            '                </div>\n' +
                            '                <div class="weui-cell__ft">\n' +
                            '                    <div class="weui-flex">\n' +
                            '                        <div class="weui-flex__item">\n' +
                            newObj1.ethnic_type +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                    <div class="weui-flex">\n' +
                            '                        <div class="weui-flex__item">\n' +
                            '                             &nbsp;\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </div>\n' +
                            '            </div>\n';
                        var liDom = document.createElement("div");
                        liDom.setAttribute('class', 'weui-cell');
                        liDom.setAttribute('onclick', 'href_detail(this)');
                        liDom.innerHTML = str;
                        if (isAppend) {
                            listDom.appendChild(liDom);//加在列表的后面,上拉加载
                        } else {
                            listDom.insertBefore(liDom, listDom.firstChild);//加在列表的前面,下拉刷新
                        }
                    }
                }
            }

            var downIndex=0;
            function getListDataFromNet(pageNum,pageSize,successCallback,errorCallback) {
                var food_type = $('input[name="food_type"]').val();
                var mcht_name = $('input[name="mcht_name"]').val();
                try{
                    var data = {mcht_name:mcht_name,food_type:food_type,status:'A',per_page:pageSize,page:pageNum};
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
        function href_detail(tt){
            var mcht_id = $(tt).find("input[name='mcht_id']").val();
            var mcht_name = $(tt).find("input[name='mcht_name']").val();
            var url = "{{url('merchant')}}"+"/"+mcht_id+"/"+mcht_name;
            location.href = url;
        }
    </script>
    <script type="text/javascript">
        //食材地区
        var ethnic_type = new Array();
        ethnic_type.push({
            label:'ALL',
            value:0,
        })
        @foreach($ethnic_types as $key=>$type)
        ethnic_type.push({
            label:'{{$type}}',
            value:'{{$key}}',
        })
        @endforeach
        $().ready(function(){
            $('#food-type').on('click',function() {
                weui.picker(
                    ethnic_type,{
                    className: 'weui-cells',
                    container: 'body',
                    defaultValue: ['{{$food_type}}'],
                    onChange: function (result) {
                        // console.log(result)
                    },
                    onConfirm: function (result) {
                        // console.log(result)
                        var s_value = result[0].value;
                        var s_label = result[0].label;
                        if(s_value==0){
                            $('#food-type span').text('Food type');
                            $('input[name="food_type"]').val('');
                            $('form').submit();
                        }else{
                            $('#food-type span').text(s_label);
                            $('input[name="food_type"]').val(s_value);
                            $('form').submit();
                        }
                    },id:'picker-foodtype'
                })
            })
        })
    </script>
@endsection