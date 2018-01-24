<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MchtController extends Controller
{
    public $API_URL_MCHT;
    public $API_URL_COMBO;
    public function __construct()
    {
        $this->API_URL_MCHT = config('advancina.api.url').config('advancina.api.merchant');
        $this->API_URL_COMBO = config('advancina.api.url').config('advancina.api.combo');
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $res = $this->getApiServerNone($data,$this->API_URL_MCHT,'get');
        return response()->json($res);
    }

    public function merchant($mchtid=''){
        if($mchtid){
            $data   =   [
                'mcht_id'      => $mchtid,
                'item_status'  => 'A',
                'per_page'     => 10,
                'page'          => 1,
                'type'          => 'unlogin'
            ];
            $response = $this->getApiServerNone($data,$this->API_URL_MCHT,'get');
            if($response->code===10000){
                $cookie1 = cookie('scantype','merchant',0);
                $cookie2 = cookie('scanid',$mchtid,0);
                return response()->view('merchant.merchant',compact('mchtid'))->withCookie($cookie1)->withCookie($cookie2);
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
