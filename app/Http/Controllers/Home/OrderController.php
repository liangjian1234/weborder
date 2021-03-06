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
        $order  =   $request->get('order','');
        $status =   $request->get('status','');
        $data = [
            'order'=>$order,
            'status'=>$status
        ];
        $response = $this->getApiServer($token,$data,$this->API_URL_ORDER,'get');
        if($response->code===10000){
            $orders = $response->data;
            $order_status = config('advancina.order_status');
            return view('order.index',compact('orders','order_status','order','status'));
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
                $type = $request->post('type');
                if($type==3) {
                    $package_id = $request->post('package_id');
                    $combo = $this->getApiServerNone([], $this->API_URL_COMBO . '/' . $package_id, 'get');
                    if ($combo->code === 10000) {
                        $data = [
                            'items' => json_encode($request->post('items')),
                            'order_note' => $request->post('order_note'),
                            'mcht_id' => $combo->data->mcht_id,
                            'order_type' => $combo->data->avail_order_type,
                            'pay_now_flag' => 'N',
                        ];
                        $response = $this->getApiServer($token, $data, $this->API_URL_ORDER, 'post');
                        return response()->json($response);
                    }
                    return response()->json($combo);
                }else if($type==1 || $type==2){
                    //TODO判断？
                    $data = [
                        'items' => json_encode($request->post('items')),
                        'order_note' => $request->post('order_note'),
                        'mcht_id' => $request->post('mcht_id'),
                        'order_type' => $request->post('order_type'),
                        'seat_mcht_id' => $request->post('seat_mcht_id'),
                        'pay_now_flag' => 'N',
                    ];
                    $response = $this->getApiServer($token, $data, $this->API_URL_ORDER, 'post');
                    return response()->json($response);
                }
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
           // dd($response);
            return view('order.order',compact('order'));
        }
        return view('home.notfound',['msg'=>'no order']);
    }

    public function update(Request $request,$order_id)
    {
        //仅在未添加支付接口时，直接修改order_status为N，pay_status为S
        $response = $this->requestApiServer($request,$this->API_URL_ORDER.'/'.$order_id,'put');
        return $response;
    }
}
