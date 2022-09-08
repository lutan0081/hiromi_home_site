<?php

namespace App\Http\Controllers\Back\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Crypt;

use DateTime;

use Common;

// データ縮小
use InterventionImage;

use Storage;

/**
 * ユーザ
 */
class BackUserController extends Controller
{
    /**
     * ユーザ編集：表示
     */
    public function backUserEditInit(Request $request)
    {   
        Log::debug('start:' .__FUNCTION__);

        try {
            // ユーザ情報
            $user_info = $this->getEditList($request);
            $user_list = $user_info[0];
            
        // 例外処理
        } catch (\Throwable $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);
        return view('back.back_user_edit', compact('user_list'));
    }

    /**
     * ユーザ情報：sql
     */
    private function getEditList(Request $request){

        Log::debug('log_start:'.__FUNCTION__);

        try{

            $ret = [];

            // セッションid
            $session_id = $request->session()->get('create_user_id');
            Log::debug('$session_id:' .$session_id);

            $str = "select "
            ."create_user_id "
            .",create_user_name "
            .",create_user_mail "
            .",create_user_password "
            .",active_flag "
            .",entry_date "
            .",update_user_id "
            .",update_date "
            ."from "
            ."create_users "
            ."where "
            ."create_user_id = $session_id ";

            Log::debug('$str:' .$str);
            $ret = DB::select($str);

        }catch(\Throwable $e) {

            throw $e;

        }finally{

        };

        Log::debug('log_end:'.__FUNCTION__);

        return $ret;
    }
}