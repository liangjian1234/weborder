<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Ixudra\Curl\Facades\Curl;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //获取API服务器 并反馈
    public function requestApiServer($request,$url,$type){
        $data   = $request->all();
        $token  = $request->cookie('bearerToken');
        $res    = [
            'code'=>200,
            'msg'=>'You had logout'
        ];
        if($token){
            if($type=='get'){
                $response = Curl::to($url)->withData($data)->withHeader('Authorization:Bearer '.$token)->asJsonResponse()->get();
            }else if($type=='post'){
                $response = Curl::to($url)->withData($data)->withHeader('Authorization:Bearer '.$token)->asJsonResponse()->post();
            }else if($type=='put'){
                $response = Curl::to($url)->withData($data)->withHeader('Authorization:Bearer '.$token)->asJsonResponse()->put();
            }else{
                $response = ['code'=>2018,'msg'=>'request error'];
            }
            if($response->code===10000){
                $res = [
                    'code'=>100,
                    'msg'=>'success',
                ];
            }else{
                $res = [
                    'code'=>201,
                    'msg'=>$response->msg,
                ];
            }
        }
        return response()->json($res);
    }
    //获取API服务器数据，携带token
    public function getApiServer($token,$data,$url,$type){
        $res    = new \stdClass();
        if($token){
            if($type=='get'){
                $response = Curl::to($url)->withData($data)->withHeader('Authorization:Bearer '.$token)->asJsonResponse()->get();
            }else if($type=='post'){
                $response = Curl::to($url)->withData($data)->withHeader('Authorization:Bearer '.$token)->asJsonResponse()->post();
            }else if($type=='put'){
                $response = Curl::to($url)->withData($data)->withHeader('Authorization:Bearer '.$token)->asJsonResponse()->put();
            }else{
                $response = ['code'=>2018,'msg'=>'request error'];
            }
            if($response->code===10000){
                $res = $response;
            }
        }
        return $res;
    }
    //获取API服务器数据，不需要token
    public function getApiServerNone($data,$url,$types){
        $type   = strtolower($types);
        if($type=='get'){
            $response = Curl::to($url)->withData($data)->asJsonResponse()->get();
        }else if($type=='post'){
            $response = Curl::to($url)->withData($data)->asJsonResponse()->post();
        }else if($type=='put'){
            $response = Curl::to($url)->withData($data)->asJsonResponse()->put();
        }else{
            $response = ['code'=>2018,'msg'=>'request error'];
        }
        return $response;
    }
}
