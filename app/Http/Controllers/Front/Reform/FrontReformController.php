<?php

namespace App\Http\Controllers\Front\Reform;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Crypt;

use DateTime;

use Common;

/**
 * Reform
 */
class FrontReformController extends Controller
{   
    /**
     *  Reform：表示
     */
    public function frontReformInit(Request $request)
    {   
        Log::debug('start:' .__FUNCTION__);

        try {
      
            $ret = [];

        // 例外処理
        } catch (\Exception $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return view('front.front_reform', compact('ret'));
    }
    
}