<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MchtController extends Controller
{
    public $API_URL_MCHT;

    public function index(Request $request)
    {
        $mcht_id = $request->get('mcht');
        $data =[] ;
        if($mcht_id){
            $this->getApiServer($request->cookie('bearerToken',$data,$this->API_URL_MCHT),'get');
        }
    }
}
