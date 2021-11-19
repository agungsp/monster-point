<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\LogHelper;
use DB;

class LogApiController extends Controller
{
    // public function index($token, $event, $id, $value){
    //     return LogHelper::indexLogApi($token, $event, $id, $value);
    // }
    public function index(Request $request, $token, $event, $id, $value){
        return LogHelper::indexLogApi($request, $token, $event, $id, $value);

    }
}
