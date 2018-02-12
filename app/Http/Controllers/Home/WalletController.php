<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    public $API_URL_WALLET;
    public function __construct(Request $request)
    {
        $this->API_URL_WALLET = config('advancina.api.url').config('advancina.api.wallet');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $response = $this->getApiServer($request->cookie('bearerToken'),$data,$this->API_URL_WALLET,'get');
        $cards = null;
        if($response->code===10000){
            $cards = $response->data;
            foreach($cards as $key=>$card){
                if($card->default_pay){
                    unset($cards[$key]);
                    array_unshift($cards,$card);
                    break;
                }
            }
        }
//        dd($cards);
        return view('wallet.index',compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('wallet.wallet_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $pay_idnum = $request->post('num');
        $default_pay = $request->post('default_pay');
        if(!preg_match("/^\d{13,16}$/",$pay_idnum)){
            return response()->json([
                'code'=>200,
                'msg'=>'Card number error!'
            ]);
        }
        $data = [
            'card_num'=>$pay_idnum,
            'default_pay'=>$default_pay,
        ];
        $response = $this->getApiServer($request->cookie('bearerToken'),$data,$this->API_URL_WALLET,'post');
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //
        $response = $this->getApiServer($request->cookie('bearerToken'),[],$this->API_URL_WALLET.'/'.$id,'get');
        if($response->code===10000){
            $card = $response->data;
        }else{
            $card = null;
        }
//        dd(isset($a));
        return view('wallet.show',compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $response = $this->requestApiServer($request,$this->API_URL_WALLET.'/'.$id,'put');
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $response = $this->requestApiServer($request,$this->API_URL_WALLET.'/'.$id,'delete');
        return $response;
    }
}
