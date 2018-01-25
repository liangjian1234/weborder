<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public $API_URL_LOGIN;
    public $API_URL_REGIST;
    public $API_TOKEN_LIFETIME;
    public function __construct()
    {
        $this->API_URL_LOGIN        = config('advancina.api.url').config('advancina.api.login');
        $this->API_URL_REGIST       = config('advancina.api.url').config('advancina.api.regist');
        $this->API_TOKEN_LIFETIME   = config('advancina.tokenLifetime');
    }
    //home首页
    public function index(Request $request)
    {
        $type = $request->cookie('scantype');
        $value = $request->cookie('scanid');
        if($type && $value){
                return redirect('/'.$type.'/'.$value);
        }
        return view('home.notfound',['msg'=>'Scan had expired , Please rescan !']);
    }
    //登录
    public function login(Request $request)
    {
        if($request->ajax()){
            return $this->requestLoginRegist($request,$this->API_URL_LOGIN);
        }
        $loc_href = 'user';
        if(preg_match("/merchant/i",url()->previous())){
            $loc_href = 'home';
        }
        return view('home.login',compact('loc_href'));
    }
    //登出
    public function logout(){
        $cookie1 = cookie('bearerToken','',-1);
        $cookie2 = cookie('scantype','',-1);
        $cookie3 = cookie('scanid','',-1);
        return response()->json()->cookie($cookie1)->cookie($cookie2)->cookie($cookie3);
    }
    //注册
    public function regist(Request $request)
    {
        if($request->ajax()){
            return $this->requestLoginRegist($request,$this->API_URL_REGIST);
        }
        return view('home.regist');
    }
    //处理登录注册请求
    public function requestLoginRegist($request,$url){
        $data['email'] = $request->post('email');
        $data['mobile'] = $request->post('phone');
        $data['password'] = $request->post('password');
        $data['country_code'] = $request->post('country_code');
        $response = Curl::to($url)
            ->withData($data)
            ->asJsonResponse()
            ->post();
        if($response->code===10000){
            $cookie = cookie('bearerToken',$response->data->token,$this->API_TOKEN_LIFETIME);
            $res = [
                'code'=>100,
                'msg'=>'success'
            ];
            return response()->json($res)->cookie($cookie);
        }else{
            $res = [
                'code'=>201,
                'msg'=>$response->msg
            ];
            return response()->json($res);
        }
    }
}
