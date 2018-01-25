<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MchtController extends Controller
{
    public $API_URL_MCHT;
    public $API_URL_COMBO;
    public $API_URL_ITEM;
    public $API_URL_PACKAGE;
    public function __construct()
    {
        $this->API_URL_MCHT = config('advancina.api.url').config('advancina.api.merchant');
        $this->API_URL_COMBO = config('advancina.api.url').config('advancina.api.combo');
        //登录
        $this->API_URL_ITEM = config('advancina.api.url').config('advancina.api.item');
        $this->API_URL_PACKAGE = config('advancina.api.url').config('advancina.api.package');
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $token = $request->cookie('bearerToken');
        if($token){
            $res = $this->getApiServer($token,$data,$this->API_URL_ITEM,'get');
        }else{
            $data['type'] = 'unlogin';
            $res = $this->getApiServerNone($data,$this->API_URL_MCHT,'get');
        }
        return response()->json($res);
    }

    public function merchant(Request $request,$mchtid=''){
        if($mchtid){
            $token = $request->cookie('bearerToken');
            if($token){
                $data = [
                    'mcht_id' => $mchtid,
                    'item_status' => 'A',
                    'per_page' => 10,
                    'page' => 1,
                ];
                $response = $this->getApiServer($token,$data, $this->API_URL_ITEM, 'get');
                if ($response->code === 10000) {
                    $cookie1 = cookie('scantype', 'merchant', 0);
                    $cookie2 = cookie('scanid', $mchtid, 0);
                    return response()->view('merchant.merchant', compact('mchtid'))->withCookie($cookie1)->withCookie($cookie2);
                }
            }else {
                $data = [
                    'mcht_id' => $mchtid,
                    'item_status' => 'A',
                    'per_page' => 10,
                    'page' => 1,
                    'type' => 'unlogin'
                ];
                $response = $this->getApiServerNone($data, $this->API_URL_MCHT, 'get');
                if ($response->code === 10000) {
                    $cookie1 = cookie('scantype', 'merchant', 0);
                    $cookie2 = cookie('scanid', $mchtid, 0);
                    return response()->view('merchant.merchant', compact('mchtid'))->withCookie($cookie1)->withCookie($cookie2);
                }
            }
        }
        return view('home.notfound',['msg'=>'Mercahnt Not Found !']);
    }
    public function combo(Request $request,$package_id='')
    {
        if($package_id){
            $data   =   [];
            $response = $this->getApiServerNone($data,$this->API_URL_COMBO.'/'.$package_id,'get');
            if($response->code===10000){
                $cookie1 = cookie('scantype','combo',0);
                $cookie2 = cookie('scanid',$package_id,0);
                $package = $response->data;
                return response()->view('merchant.combo',compact('package'))->withCookie($cookie1)->withCookie($cookie2);
            }
        }
        return view('home.notfound',['msg'=>'Package Not Found !']);
    }
}
