<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;

class UserController extends Controller
{
    public $API_URL_USER_INFO;
    public $API_URL_USER_VERIFY;
    public function __construct()
    {
        $this->API_URL_USER_INFO = config('advancina.api.url').config('advancina.api.userInfo');
        $this->API_URL_USER_VERIFY = config('advancina.api.url').config('advancina.api.codeVerify');
    }
    //Profile页面
    public function index(Request $request)
    {
        $user = $this->getUserInfo($request);
        return view('user.index',compact('user'));
    }

    //修改用户信息
    public function edit(Request $request){
        if($request->ajax()){
            return $this->requestApiServer($request,$this->API_URL_USER_INFO,'put');
        }else {
            $type = $request->get('type');
            switch ($type) {
                case 'name':
                    $title = 'Change name';
                    break;
                case 'email':
                    $title = 'Change email';
                    break;
                case 'mobile':
                    $title = 'Change mobile';
                    break;
                case 'address':
                    $title = 'Change address';
                    break;
            }
            $user = $this->getUserInfo($request);
            return view('user.edit', compact('title', 'type','user'));
        }
    }
    //登录状态验证验证码
    public function verify(Request $request){
        if($request->ajax()){
            return $this->requestApiServer($request,$this->API_URL_USER_VERIFY,'post');
        }
    }
    //获取用户信息
    public function getUserInfo($request){
        $token = $request->cookie('bearerToken');
        $user  = null;
        if($token){
            $response = Curl::to($this->API_URL_USER_INFO)
                ->withHeader('Authorization:Bearer '.$token)
                ->asJsonResponse()
                ->get();
            if($response->code==10000){
                $user = $response->data;
            }
        }
        return $user;
    }
}
