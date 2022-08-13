<?php

namespace App\Http\Controllers\Front\Information;

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
 * 新着情報
 */
class FrontInformationController extends Controller
{   
    /**
     * 新着情報：表示
     */
    public function frontInformationInit(Request $request)
    {   
        Log::debug('start:' .__FUNCTION__);

        try {
      
            $information_list = $this->getInformationList($request);

        // 例外処理
        } catch (\Exception $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return view('front.front_information', $information_list);
    }

    /**
     * 新着情報：sql
     */
    private function getInformationList(Request $request){

        Log::debug('log_start:'.__FUNCTION__);

        try{

            // sql
            $str = "select * from posts "
            ."where post_type_id = 1 "
            ."and Active_flag = 0 ";
            Log::debug('str:' .$str);

            $alias = DB::raw("({$str}) as alias");

            // columnの設定、表示件数
            $res = DB::table($alias)->selectRaw("*")->orderByRaw("post_id desc")->paginate(8)->onEachSide(1);

            // resの中に値が代入されている
            $ret = [];
            $ret['res'] = $res;

        }catch(\Throwable $e) {

            throw $e;

        }finally{

        };

        Log::debug('log_end:'.__FUNCTION__);

        return $ret;
    }

    /**
     * 新着情報詳細：表示
     */
    public function frontInformationEditInit(Request $request)
    {   
        Log::debug('start:' .__FUNCTION__);

        try {
      
            $information_edit_info = $this->getInformationEditList($request);
            $information_edit_list = $information_edit_info[0];

        // 例外処理
        } catch (\Exception $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return view('front.front_information_edit', compact('information_edit_list'));
    }

    /**
     * 新着情報詳細：sql
     */
    private function getInformationEditList(Request $request){

        Log::debug('log_start:'.__FUNCTION__);

        try{

            /**
             * 値取得
             */
            $post_id = $request->input('post_id');

            /**
             * sql
             */
            $str = "select * from posts "
            ."where post_id = $post_id ";
            Log::debug('str:' .$str);
            $ret = DB::select($str);

        }catch(\Throwable $e) {

            throw $e;

        }finally{

        };

        Log::debug('log_end:'.__FUNCTION__);

        return $ret;
    }
}