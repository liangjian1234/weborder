<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    public $API_URL_ORDER;
    public $API_URL_COMBO;
    public function __construct()
    {
        $this->API_URL_ORDER = config('advancina.api.url').config('advancina.api.order');
        $this->API_URL_COMBO = config('advancina.api.url').config('advancina.api.combo');

    }
    //订单列表
    public function index(Request $request){
        $token = $request->cookie('bearerToken');
        $response = $this->getApiServer($token,[],$this->API_URL_ORDER,'get');
        if($response->code===10000){
            $orders = $response->data;
            return view('order.index',compact('orders'));
        }else if($response->code===401){
            return redirect()->route('login');
        }
        return view('home.notfound',['msg'=>'error !']);
    }
    //下订单
    public function store(Request $request){
        $token = $request->cookie('bearerToken');
        if($token){
            if($request->ajax()){
                $package_id = $request->post('package_id');
                $combo = $this->getApiServerNone([],$this->API_URL_COMBO.'/'.$package_id,'get');
                if($combo->code===10000){
                    $data = [
                        'items'           =>  json_encode($request->post('items')),
                        'order_note'    =>  $request->post('order_note'),
                        'mcht_id'       =>   $combo->data->mcht_id,
                        'order_type'    =>  $combo->data->avail_order_type,
                        'pay_now_flag'  =>  'N',
                    ];
                    $response = $this->getApiServer($token,$data,$this->API_URL_ORDER,'post');
                    return response()->json($response);
                }
                return response()->json($combo);
            }
        }else{
            return response()->json(['code'=>200,'msg'=>'You had logout']);
        }
    }

    //订单详情17242857
    public function order(Request $request,$order_id){
        if($order_id){
            $order = null;
            $token = $request->cookie('bearerToken');
            $response = $this->getApiServer($token,[],$this->API_URL_ORDER.'/'.$order_id,'get');
            if($response->code===10000){
                $order = $response->data;
            }else if($response->code===401){
                return redirect()->route('login');
            }
//            dd($response);
            return view('order.order',compact('order'));
        }
        return view('home.notfound',['msg'=>'no order']);
    }
}
