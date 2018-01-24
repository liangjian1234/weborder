<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MchtController extends Controller
{
    public $API_URL_MCHT;
    public function __construct()
    {
        $this->API_URL_MCHT = config('advancina.api.url').config('advancina.api.merchant');
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $res = $this->getApiServerNone($data,$this->API_URL_MCHT,'get');
        return response()->json($res);
    }
}
