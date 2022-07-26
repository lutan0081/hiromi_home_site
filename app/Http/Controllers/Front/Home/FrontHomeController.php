<?php

namespace App\Http\Controllers\Front\Home;

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
 * トップ画面
 */
class FrontHomeController extends Controller
{   
    /**
     *  トップ画面：表示
     *
     * @param Request $request
     * @return view()
     */
    public function frontHomeInit(Request $request)
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
        return view('front.frontHome', compact('ret'));
    }
    
}