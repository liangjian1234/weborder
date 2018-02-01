<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;

class UserController extends Controller
{
    public $API_URL_USER_INFO;
    public $API_URL_USER_VERIFY;
    public $API_URL_USER_FAVORITE;
    public $API_URL_USER_CART;
    public function __construct()
    {
        $this->API_URL_USER_INFO = config('advancina.api.url').config('advancina.api.userInfo');
        $this->API_URL_USER_VERIFY = config('advancina.api.url').config('advancina.api.codeVerify');
        $this->API_URL_USER_FAVORITE = config('advancina.api.url').config('advancina.api.item_favorite');
        $this->API_URL_USER_CART = config('advancina.api.url').config('advancina.api.item_cart');
    }
    //Profile页面
    public function index(Request $request)
    {
        $user = $this->getUserInfo($request);
        return view('user.index',compact('user'));
    }
    //settings
    public function settings(Request $request){
        $user = $this->getUserInfo($request);
        return view('user.settings',compact('user'));
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
        $response = $this->getApiServer($token,[],$this->API_URL_USER_INFO,'get');
        $user = empty($response) ? $response : $response->data;
        return $user;
    }
    //item_favorite
    public function item_favorite(Request $request){
        if($request->ajax()){
            $type = $request->post('type');
            $item_id = $request->post('item_id');
            if($type=='post'){
                return $this->requestApiServer($request,$this->API_URL_USER_FAVORITE,'post');
            }else if($type=='delete'){
                return $this->requestApiServer($request,$this->API_URL_USER_FAVORITE.'/'.$item_id,'delete');
            }
        }
        if($request->isMethod('get')){
            $token = $request->cookie('bearerToken');
            $response = $this->getApiServer($token,[],$this->API_URL_USER_FAVORITE,'get');
            return $response;
        }
    }
    //item_cart
    public function item_cart(Request $request){
        if($request->isMethod('post')){
            $type = $request->post('type');
            $item_id = $request->post('item_id');
            if($type=='post'){
                return $this->requestApiServer($request,$this->API_URL_USER_CART,'post');
            }else if($type=='delete'){
                return $this->requestApiServer($request,$this->API_URL_USER_CART.'/'.$item_id,'delete');
            }
        }
        if($request->isMethod('get')){
            $token = $request->cookie('bearerToken');
            $response = $this->getApiServer($token,[],$this->API_URL_USER_CART,'get');
            return response()->json($response);
        }
    }
}
