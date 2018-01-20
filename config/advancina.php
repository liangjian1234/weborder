<?php

return [
    'api'       =>  [
		'url'         	=>  env('API_URL','http://neworder.advancina.net/api/'),
        'login'         =>  'login',
        'regist'        =>  'signup',
        'userInfo'      =>  'user/info',
        'codeVerify'    =>  'verify'
    ],

    //minutes
    'tokenLifetime'    =>23.5*60,
];