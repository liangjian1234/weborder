<?php

return [
    'api'       =>  [
		'url'         	     =>  env('API_URL','http://neworder.advancina.net/api/'),
        'login'             =>  'login',
        'regist'            =>  'signup',
        'available'            =>  'account/available',
        //用户
        'userInfo'          =>  'user/info',
        'codeVerify'        =>  'verify',
        //商户
        'mcht'               => 'mcht',
        //未登录商品
        'merchant'          =>  'merchant',
        'combo'              =>  'combo',
        'detail'            =>  'detail',
        //登录商品
        'item'              =>  'item',
        'package'           =>  'package',
        'item_detail'       =>  'item_detail',
        //商品收藏
        'item_favorite'    =>   'item_favorite',
        //购物车
        'item_cart'         =>  'item_cart',
        //订单
        'order'             =>  'order',
        //wallet
        'wallet'            =>  'wallet',
    ],

    //minutes
    'tokenLifetime'    =>23.5*60,

    //订单状态
    'order_status'      =>  [
            'N'=>'New',
            'U'=>'Unpaid',
            'P'=>'Processing',
            'S'=>'Success',
            'C'=>'Cancelled',
            'D'=>'Delete',
    ],
    //支付状态  N=未支付 S=success 支付成功  F=支付失败  C=支付取消
    'pay_status'      =>  [
            'N'=>'Unpaid',
            'S'=>'Success',
            'F'=>'Faliure',
            'C'=>'Cancelled',
    ],
    //支付方式  V=Visa, M=Mastercard, A=American Express, P=Paypal, W=Wechat, Z=AliPay
    'pay_method'      =>  [
            'V'=>'Visa',
            'M'=>'Mastercard',
            'A'=>'American Express',
            'P'=>'Paypal',
            'W'=>'Wechat',
            'Z'=>'AliPay',
            'D'=>'Discover',
    ],
    'pay_method_img'      =>  [
            'V'=>'visa.png',
            'M'=>'mastercard.png',
            'A'=>'americanexpress.png',
            'P'=>'paypal.png',
            'W'=>'wechat.png',
            'Z'=>'aliPay.png',
            'D'=>'discover.png',
    ],
    //食材地区
    'ethnic_type'       =>      [
        'C'     =>  'Chinese',
        'MX'     =>  'Mexican',
        'I'     =>  'Italian',
        'J'     =>  'Japanese',
        'A'     =>  'American',
        'G'     =>  'Greek',
        'F'     =>  'French',
        'T'     =>  'Thai',
        'S'     =>  'Spanish',
        'MD'     =>  'Mediterranean',
        'K'     =>  'Korean'
    ],
];