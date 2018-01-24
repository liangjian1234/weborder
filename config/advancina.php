<?php

return [
    'api'       =>  [
		'url'         	=>  env('API_URL','http://neworder.advancina.net/api/'),
        'login'         =>  'login',
        'regist'        =>  'signup',
        //用户
        'userInfo'      =>  'user/info',
        'codeVerify'    =>  'verify',
        //商品
        'merchant'          =>  'merchant',
        'combo'             =>  'combo',
    ],

    //minutes
    'tokenLifetime'    =>23.5*60,
];