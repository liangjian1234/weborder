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
        }
//        dd($response);
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
        if(!preg_match("/^\d{13,16}$/",$pay_idnum)){
            return response()->json([
                'code'=>200,
                'msg'=>'Card number error!'
            ]);
        }
        $data = [
            'card_num'=>$pay_idnum
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
    public function show($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
