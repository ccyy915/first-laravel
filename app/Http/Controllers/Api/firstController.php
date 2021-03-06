<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class firstController extends Controller
{
    public function plus(Request $request)
    {
        $status = 0 ;
        if(!$request->has("x") || !$request->has("y")){
            $message = "X 或 Y 不存在";
        }else{
            $x = $request->x;
            $y = $request->y;
            if(!is_numeric($x) || !is_numeric($y)){
                $message = "x 或 y 不是數字";
            }else{
                $result = $x*$y;
                $status = 1;
            }
        }
        if($status == 1){
            return ["status"=> $status, "result"=> $result];
        }else{
            return ["status"=> $status, "message"=> $message];
        }
    }
}
