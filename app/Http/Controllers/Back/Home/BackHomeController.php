<?php

namespace App\Http\Controllers\Back\Home;

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
 * ホーム画面
 */
class BackHomeController extends Controller
{   

    /**
     * ホーム画面：表示
     */
    public function backHomeInit(Request $request)
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
        return view('back.back_home', compact('ret'));
    }

    /**
     * ログイン：ログインの処理
     */
    public function backLoginEntry(Request $request)
    {
        Log::debug('start:' .__FUNCTION__);

        try {
            
            /**
             * 値取得
             */
            // メールアドレス
            $create_user_mail = $request->input('create_user_mail');
            
            // パスワード
            $create_user_password = $request->input('create_user_password');

            // retrunの配列作成
            $response = [];

            // 有効のユーザ且つメールアドレス・パスワードが同一の場合
            $str = "select "
            ."create_user_id "
            .",create_user_name "
            .",create_user_post_number "
            .",create_user_address "
            .",create_user_tel "
            .",create_user_fax "
            .",create_user_mail "
            .",create_user_password "
            .",active_flag "
            .",entry_date "
            .",update_user_id "
            .",update_date "
            ."from "
            ."create_users "
            ."where "
            ."(create_user_mail = '$create_user_mail') "
            ."and "
            ."(create_user_password = '$create_user_password') "
            ."and "
            ."(active_flag = 0) ";

            // ログ
            Log::debug('str:' .$str);

            // 実行
            $create_user_list = DB::select($str);

            // データ数が1以上が存在する場合、ログイン処理
            if(count($create_user_list) > 0){

                Log::debug('データが存在する場合の処理');

                // session_id設定
                $request->session()->put('create_user_id',$create_user_list[0]->create_user_id);
                
                // アカウント名設定
                $request->session()->put('create_user_name',$create_user_list[0]->create_user_name);

                // 戻り値
                $response["status"] = true;

            }else{

                $response["status"] = false;  
            }

        } catch (\Exception $e) {

            Log::debug('error:'.$e);

            $response['status'] = false;

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);
        return response()->json($response);
    }
    
}