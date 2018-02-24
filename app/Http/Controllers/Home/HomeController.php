<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public $API_URL_MCHT;
    public $API_URL_LOGIN;
    public $API_URL_REGIST;
    public $API_TOKEN_LIFETIME;
    public $API_URL_AVAILABLE;
    public function __construct()
    {
        $this->API_URL_MCHT        = config('advancina.api.url').config('advancina.api.mcht');
        $this->API_URL_LOGIN        = config('advancina.api.url').config('advancina.api.login');
        $this->API_URL_REGIST       = config('advancina.api.url').config('advancina.api.regist');
        $this->API_URL_AVAILABLE       = config('advancina.api.url').config('advancina.api.available');
        $this->API_TOKEN_LIFETIME   = config('advancina.tokenLifetime');
    }
    //home首页
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            $mchts = null;
            $response = $this->getApiServerNone($data,$this->API_URL_MCHT,'get');
            if($response->code===10000){
                $mchts = $response;
                foreach($mchts->data as $mcht){
                    $mcht->ethnic_type = config('advancina.ethnic_type.'. $mcht->ethnic_type,'');
                    $mcht->address1 = str_limit($mcht->address1,20,'');
                    $mcht->address2 = str_limit($mcht->address2,20,'');
                }
            }
            return response()->json($mchts);
        }else{
            $mcht_name = $request->get('mcht_name');
            $food_type = $request->get('food_type');
            $ethnic_types = array_sort(config('advancina.ethnic_type'));
//            $domain = config('app.file_domain') . "/" . Auth::user()->mcht_id . '/';
            return view('home.index',compact('ethnic_types','mcht_name','food_type'));
        }
    }
    //登录
    public function login(Request $request)
    {
        if($request->ajax()){
            return $this->requestLoginRegist($request,$this->API_URL_LOGIN);
        }
        $loc_href = route('user');
        if(!preg_match("/regist|login/i",url()->previous())){
            $loc_href = url()->previous();
        }
//        dd($loc_href);
        return view('home.login',compact('loc_href'));
    }
    //登出
    public function logout(){
        $cookie = cookie('bearerToken','',-1);
        return response()->json()->cookie($cookie);
    }
    //注册
    public function regist(Request $request,$type='')
    {
        if($request->ajax()){
            return $this->requestLoginRegist($request,$this->API_URL_REGIST);
        }
        return view('home.regist');
    }
    //处理登录注册请求
    public function requestLoginRegist($request,$url){
        $data['lname'] = $request->post('lname');
        $data['fname'] = $request->post('fname');
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
    //查看账号是否可用
    public function available(Request $request){
        $data['type'] = $request->post('type');
        $data['value'] = $request->post('value');
        $response = $this->getApiServerNone($data,$this->API_URL_AVAILABLE,'get');
        return response()->json($response);
    }
}
