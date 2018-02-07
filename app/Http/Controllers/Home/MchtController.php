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
    public $API_URL_ITEM_DETAIL;
    public $API_URL_DETAIL;
    public function __construct()
    {
        $this->API_URL_MCHT = config('advancina.api.url').config('advancina.api.merchant');
        $this->API_URL_COMBO = config('advancina.api.url').config('advancina.api.combo');
        $this->API_URL_DETAIL = config('advancina.api.url').config('advancina.api.detail');
        $this->API_URL_ITEM_DETAIL = config('advancina.api.url').config('advancina.api.item_detail');
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

    public function merchant(Request $request,$mchtid='',$mchtname=''){
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
                    return response()->view('merchant.merchant', compact('mchtid','mchtname'));
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
                    return response()->view('merchant.merchant', compact('mchtid','mchtname'));
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
                $package = $response->data;
                return response()->view('merchant.combo',compact('package','package_id'));
            }
        }
        return view('home.notfound',['msg'=>'Package Not Found !']);
    }
    public function details(Request $request)
    {
        if($request->isMethod('post')){
            $item_id = $request->post('item_id');
            $merchant_name = $request->post('merchant_name');
            $merchant_id = $request->post('merchant_id');
            $data = [
                'item_id'=>$item_id,
                'merchant_id'=>$merchant_id,
                'merchant_name'=>$merchant_name,
            ];
            $request->session()->put('item_details',$data);
            return response()->json(['code'=>100,'msg'=>'ok']);
        }
        $item_details = $request->session()->get('item_details');
        if(!$item_details){
            return redirect()->route('home');
        }
        $item_id = $item_details['item_id'];
        $token = $request->cookie('bearerToken');
        if($token){
            $response = $this->getApiServer($token,['item_id'=>$item_id],$this->API_URL_ITEM_DETAIL,'get');
        }else{
            $response = $this->getApiServerNone(['item_id'=>$item_id,'type'=>'unlogin'],$this->API_URL_DETAIL,'get');
        }
        if($response->code===10000){
            $item_list = $response->data[0];
        }else{
            $item_list = null;
        }
        $merchant_id = $item_details['merchant_id'];
        $merchant_name = $item_details['merchant_name'];
//        dd($response);
        return view('merchant.details',compact('item_id','item_list','merchant_id','merchant_name'));
    }
}
