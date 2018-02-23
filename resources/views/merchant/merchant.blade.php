@extends('layout.main')

@section('main_title','Merchant')

@section('main_head')
    <style rel="stylesheet" type="text/css" href="{{asset('css/mescroll.min.css')}}"></style>
@endsection

@section('main_body')
    <div class="weui-cells weui-cells_top0 bg-base_light text-white">
        <div class="weui-cell">
            <div class="weui-cell__hd" onclick="location.href='{{route('home')}}'">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="weui-cell__bd text-center">
                <p>{{$mchtname}}</p>
            </div>
        </div>
    </div>
    <div  id="list-items" class="list-items">
    </div>
    {{--购物车--}}
    <div id="shopping-cart" class="shopping-cart hide" onclick="location.href='{{route('user.cart')}}'">
        <i class="fa fa-shopping-cart"></i>
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
        var merchant_id = "{{$mchtid}}";
        var merchant_name = "{{$mchtname}}";
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
                var listDom=document.getElementById("list-items");
                if(curPageData.length<1){
                    var str = '<div class="weui-loadmore weui-loadmore_line">\n' +
                        '            <span class="weui-loadmore__tips">Empty Items !</span>\n' +
                        '        </div>'
                    var liDom = document.createElement("div");
                    liDom.innerHTML = str;
                    if (isAppend) {
                        listDom.appendChild(liDom);//加在列表的后面,上拉加载
                    } else {
                        listDom.insertBefore(liDom, listDom.firstChild);//加在列表的前面,下拉刷新
                    }
                }else {
                    for (var i = 0; i < curPageData.length; i = i + 2) {
                        var newObj1 = curPageData[i];
                        if (i + 1 < curPageData.length) {
                            var newObj2 = curPageData[i + 1];
                        }
                        var str1_start = '<div class="weui-flex__item">\n' + '<div class="list-item">\n ';
                        var str1_favourite1 = (newObj1.added_to_favorite === true) ? '<i class="fa fa-heart" onclick="my_favorite(' + newObj1.item_id + ',true,this)"></i>\n' : '<i class="fa fa-heart-o" onclick="my_favorite(' + newObj1.item_id + ',false,this)"></i>\n';
                        var str1_favourite = '<div class="item-favourite text-right text-base_mid">\n' + str1_favourite1 + '</div>\n';
                        var str1_img = '<div class="item-img" onclick="href_detail('+newObj1.item_id+')">\n' + '<img  class="center-block" src="' + newObj1.default_image_prefix + '/' + newObj1.default_image + '" alt="" height=100 style="width:100%">\n' + '</div>\n';
                        var str1_name = '<div class="item-name" onclick="href_detail('+newObj1.item_id+')">\n' + newObj1.item_name + '</div>\n';
                        var str1_desc = '<div class="item-desc" onclick="href_detail('+newObj1.item_id+')">\n' + newObj1.item_desc + '</div>\n';
                        var str1_price = '<div class="item-cart">\n' + '<div>&dollar;' + newObj1.price + '</div>\n';
                        var str1_cart1 = (newObj1.added_to_cart === true) ? '<i class="fa fa-shopping-cart" onclick="my_cart(' + newObj1.item_id + ',true,this)"></i>\n' : '<i class="fa fa-cart-plus" onclick="my_cart(' + newObj1.item_id + ',false,this)"></i>\n';
                        var str1_cart = '<div class="text-right text-base_mid">' + str1_cart1 + '</div>\n' + '</div>\n' + '</div>\n' + '</div>\n';
                        var str1 = str1_start + str1_favourite + str1_img + str1_name + str1_desc + str1_price + str1_cart;
                        if (typeof(newObj2) == "undefined") {
                            var str = str1 + '<div class="weui-flex__item item_none"></div>';
                        } else {
                            var str2_start = '<div class="weui-flex__item">\n' + '<div class="list-item">\n';
                            var str2_favourite1 = (newObj2.added_to_favorite === true) ? '<i class="fa fa-heart" onclick="my_favorite(' + newObj2.item_id + ',true,this)"></i>\n' : '<i class="fa fa-heart-o" onclick="my_favorite(' + newObj2.item_id + ',false,this)"></i>\n';
                            var str2_favourite = '<div class="item-favourite text-right text-base_mid">\n' + str2_favourite1 + '</div>\n';
                            var str2_img = '<div class="item-img" onclick="href_detail('+newObj2.item_id+')">\n' + '<img  class="center-block" src="' + newObj2.default_image_prefix + '/' + newObj2.default_image + '" alt=""  height=100 style="width:100%">\n' + '</div>\n';
                            var str2_name = '<div class="item-name" onclick="href_detail('+newObj2.item_id+')">\n' + newObj2.item_name + '</div>\n';
                            var str2_desc = '<div class="item-desc" onclick="href_detail('+newObj2.item_id+')">\n' + newObj2.item_desc + '</div>\n';
                            var str2_price = '<div class="item-cart">\n' + '<div>&dollar;' + newObj2.price + '</div>\n';
                            var str2_cart1 = (newObj2.added_to_cart === true) ? '<i class="fa fa-shopping-cart" onclick="my_cart(' + newObj2.item_id + ',true,this)"></i>\n' : '<i class="fa fa-cart-plus" onclick="my_cart(' + newObj2.item_id + ',false,this)"></i>\n';
                            var str2_cart = '<div class="text-right text-base_mid">' + str2_cart1 + '</div>\n' + '</div>\n';
                            var str2 = str2_start + str2_favourite + str2_img + str2_name + str2_desc + str2_price + str2_cart;
                            var str = str1 + str2
                        }
                        var liDom = document.createElement("div");
                        liDom.setAttribute('class','weui-flex');
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
                try{
                    var data = {mcht_id:merchant_id,item_status:'A',per_page:pageSize,page:pageNum};
                    $.post("{{route('merchant')}}",data,function(res){
                        console.log(res)
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
    {{--Functions--}}
    <script type="text/javascript">
        // 收藏
        var favorite_flag = true;
        function my_favorite(item_id,flag,tt){
            if(favorite_flag){
                favorite_flag = false;
            }else{
                return false;
            }
            if(flag){
                var data = {type:'delete',item_id:item_id};
                $(tt).removeClass('fa-heart').addClass('fa-heart-o');
                $.post("{{route('user.favorite')}}",data,function(res){
                    if(res.code===100){
                        $(tt).attr('onclick',"my_favorite("+item_id+","+!flag+",this)");
                    }else{
                        $(tt).removeClass('fa-heart-o').addClass('fa-heart');
                        weui.topTips(res.msg,{
                            duration: 3000,
                        });
                    }
                    favorite_flag = true;
                })
            }else{
                var data = {type:'post',item_id:item_id};
                $(tt).removeClass('fa-heart-o').addClass('fa-heart');
                $.post("{{route('user.favorite')}}",data,function(res){
                    if(res.code===100){
                        $(tt).attr('onclick',"my_favorite("+item_id+","+!flag+",this)");
                    }else if(res.code===200){
                        $(tt).removeClass('fa-heart').addClass('fa-heart-o');
                        weui.confirm('Ready to login in?', {
                            buttons: [{
                                label: 'NO',
                                type: 'default',
                                onClick: function(){  }
                            }, {
                                label: 'GO !',
                                type: 'primary',
                                onClick: function(){ location.href = "{{route('login')}}" }
                            }]
                        });
                    }else{
                        $(tt).removeClass('fa-heart').addClass('fa-heart-o');
                        weui.topTips(res.msg);
                    }
                    favorite_flag = true;
                })
            }
        }
        //操作购物车
        var cart_flag = true;
        function my_cart(item_id,flag,tt) {
            if (cart_flag) {
                cart_flag = false;
            } else {
                return false;
            }
            if(flag){
                var data = {type:'delete',item_id:item_id};
                $(tt).removeClass('fa-shopping-cart').addClass('fa-cart-plus');
                $.post("{{route('user.cart')}}",data,function(res){
                    if(res.code===100){
                        shop_cart();
                        $(tt).attr('onclick',"my_cart("+item_id+","+!flag+",this)");
                    }else{
                        $(tt).removeClass('fa-cart-plus').addClass('fa-shopping-cart');
                        weui.topTips(res.msg,{
                            duration: 3000,
                        });
                    }
                    cart_flag = true;
                })
            }else{
                var data = {type:'post',item_id:item_id,mcht_id:merchant_id,item_num:1};
                $(tt).removeClass('fa-cart-plus').addClass('fa-shopping-cart');
                $.post("{{route('user.cart')}}",data,function(res){
                    if(res.code===100){
                        shop_cart();
                        $(tt).attr('onclick',"my_cart("+item_id+","+!flag+",this)");
                    }else if(res.code===200){
                        $(tt).removeClass('fa-shopping-cart').addClass('fa-cart-plus');
                        weui.confirm('Ready to login in?', {
                            buttons: [{
                                label: 'NO',
                                type: 'default',
                                onClick: function(){  }
                            }, {
                                label: 'GO !',
                                type: 'primary',
                                onClick: function(){ location.href = "{{route('login')}}" }
                            }]
                        });
                    }else{
                        $(tt).removeClass('fa-shopping-cart').addClass('fa-cart-plus');
                        weui.topTips(res.msg);
                    }
                    cart_flag = true;
                })
            }
        }
        //购物车显示
        function shop_cart(){
            $.get("{{route('user.cart')}}", {}, function (res) {
                if (!$.isEmptyObject(res)) {
                    if (res.code === 10000) {
                        var str = '';
                        if (res.data.length != 0) {
                            str = '<span class="weui-badge" >' + res.data.length + '</span>';
                        }
                        $('#shopping-cart').removeClass('hide');
                        $('#shopping-cart').find('span').remove();
                        $('#shopping-cart').append(str);
                    }
                    // else {
                    //     weui.topTips(res.msg);
                    // }
                }
            })
        }
        //到详情页面
        function href_detail(id){
            $.post("{{url('details')}}",{item_id:id,merchant_id:merchant_id,merchant_name:merchant_name},function(res){
                // console.log(res);return;
                location.href = "{{url('details')}}"+"/"+id;
            });
        }
        $().ready(function(){
            shop_cart();
        })
    </script>
@endsection