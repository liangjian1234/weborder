<?php

return [
    'api'       =>  [
		'url'         	     =>  env('API_URL','http://neworder.advancina.net/api/'),
        'login'             =>  'login',
        'regist'            =>  'signup',
        //用户
        'userInfo'          =>  'user/info',
        'codeVerify'        =>  'verify',
        //未登录商品
        'merchant'          =>  'merchant',
        'combo'              =>  'combo',
        //登录商品
        'item'              =>  'item',
        'package'           =>  'package',
        //商品收藏
        'item_favorite'    =>   'item_favorite',
        //购物车
        'item_cart'         =>  'item_cart',
    ],

    //minutes
    'tokenLifetime'    =>23.5*60,
];