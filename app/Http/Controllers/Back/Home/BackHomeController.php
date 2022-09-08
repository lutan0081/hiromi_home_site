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

            // access数取得
            $access_count = $this->getAccessCount($request);

            // 施工事例：登録件数
            $reform_count = $this->getReformCount($request);

            // その他投稿：登録件数
            $post_count = $this->getPostCount($request);

            // 施工事例：一覧
            $reform_list = $this->getReformList($request);

            // その他投稿：一覧
            $post_list = $this->getPostList($request);
        

        // 例外処理
        } catch (\Exception $e) {
            Log::debug('error:'.$e);
        } finally {
        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return view('back.back_home', compact('reform_count','post_count', 'reform_list', 'post_list', 'access_count'));
    }

    /**
     * アクセス数：sql
     *
     * @param Request $request
     * @return void
     */
    private function getAccessCount(Request $request){

        Log::debug('log_start:' .__FUNCTION__);

        // 本日の日付を取得
        $nowDate = date("Y-m-d");
        Log::debug('nowDate:'.$nowDate);

        $start_date = date("Y-m-d", strtotime("-6 day". $nowDate));
        Log::debug('start_date:'.$start_date);

        $ret = [];

        $str = "select "
        ."count(*) as row_count, "
        ."date_format(entry_date,'%Y-%m-%d') as format_entry_date "
        ."from accesses "
        ."where "
        ."date_format(entry_date,'%Y-%m-%d') between '$start_date' and '$nowDate' "
        ."group by date_format(entry_date,'%Y-%m-%d') ";
        Log::debug('str:' .$str);
        
        // selectで返却の値はオブジェクト（複数件のオブジェクト）
        // その為、ループが必要
        // [0]を指定した場合、ループが不要
        $ret = DB::select($str);
        
        // パターン
        // $list = [];
        // $list[] = 'value';
        // $list[] = 'value02';
        // $list_value = $list[0]; 

        // // パターン01
        // $obj = new \stdClass();
        // $obj->key = 'value';
        // $obj->key02 = 'value02';
        // $list[] = $obj;

        // $obj = new \stdClass();
        // $obj->key = 'value';
        // $obj->key02 = 'value02';
        // $list[] = $obj;

        // $list_value = $list[0];

        // [0] => stdClass Object
        // stdClass Object
        // (
        //     [key] => value
        //     [key02] => value02
        // )


        // [1] => stdClass Object
        // stdClass Object
        // (
        //     [key] => value
        //     [key02] => value02
        // )

        // 配列デバック
        $arrString = print_r($ret , true);
        Log::debug('messages:'.$arrString);

        Log::debug('log_end:' .__FUNCTION__);

        return $ret;
    }

    /**
     * 施工事例：件数
     *
     * @param Request $request
     * @return void
     */
    private function getReformCount(Request $request){

        Log::debug('log_start:' .__FUNCTION__);

        // 本日の日付を取得
        $ret = [];

        $str = "select "
        ."count(reform_id) as count_reform_id "
        ."from "
        ."reforms ";
        Log::debug('str:' .$str);
        
        $ret = DB::select($str)[0];
        Log::debug('log_end:' .__FUNCTION__);

        return $ret;
    }

    /**
     * その他投稿：件数
     *
     * @param Request $request
     * @return void
     */
    private function getPostCount(Request $request){

        Log::debug('log_start:' .__FUNCTION__);

        // 本日の日付を取得
        $ret = [];

        $str = "select "
        ."count(post_id) as count_post_id "
        ."from "
        ."posts ";
        Log::debug('str:' .$str);
        
        $ret = DB::select($str)[0];
        Log::debug('log_end:' .__FUNCTION__);

        return $ret;
    }

    /**
     * 施工事例：sql
     *
     * @param Request $request
     * @return void
     */
    private function getReformList(Request $request){

        Log::debug('log_start:' .__FUNCTION__);

        $ret = [];

        $str = "select * from reforms "
        ."order by reform_id desc "
        ."limit 3 ";
        Log::debug('str:' .$str);
        
        $ret = DB::select($str);
        Log::debug('log_end:' .__FUNCTION__);

        return $ret;
    }

    /**
     * その他投稿：sql
     *
     * @param Request $request
     * @return void
     */
    private function getPostList(Request $request){

        Log::debug('log_start:' .__FUNCTION__);

        $ret = [];

        $str = "select * from posts "
        ."order by post_id desc "
        ."limit 3 ";
        Log::debug('str:' .$str);
        
        $ret = DB::select($str);
        Log::debug('log_end:' .__FUNCTION__);

        return $ret;
    }
}