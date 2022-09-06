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

            // 配列デバック
            $arrString = print_r($access_count , true);
            Log::debug('access_count:'.$arrString);

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
        Log::debug('first_date:'.$start_date);

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

    

    /**
     * グラフデータ
     */
    private function getChartData(Request $request){
        Log::debug('log_start:'.__FUNCTION__);

        try{
            // 初期値
            $ret = [];

            // 本日の日付を取得
            $nowDate = date("Y/m/d");
            Log::debug('nowDate:'.$nowDate);

            // 一週間前を取得
            $first_date = date("Y/m/d", strtotime("-6 day". $nowDate));
            Log::debug('first_date:'.$first_date);

            /**
             * 日付の配列作成
             */
            $date_list = [];

            for ($i = 0; $i < 7; $i++){

                if($i == 0){
                    $date_list[] = $first_date;
                    $add_date = date("Y/m/d", strtotime("+1 day". $first_date));
                }elseif($i == 1){
                    $date_list[] = $add_date;
                }else{
                    $date_list[] = $add_date = date("Y/m/d", strtotime("+1 day". $add_date));
                }
                
            }

            $arrString = print_r($date_list , true);
            Log::debug('messages:'.$arrString);

            /**
             * グラフデータ
             */
            // 日付データ作成(DBから取得を想定)


            $date_list[] = $nowYear. '/08';

            $date_list[] = $nowYear. '/09';

            $date_list[] = $nowYear. '/10';

            $date_list[] = $nowYear. '/11';

            $date_list[] = $nowYear. '/12';
            
            $date_list[] = $nextYear. '/01';

            $date_list[] = $nextYear. '/02';

            $date_list[] = $nextYear. '/03';

            $date_list[] = $nextYear. '/04';

            $date_list[] = $nextYear. '/05';

            $date_list[] = $nextYear. '/06';

            $date_list[] = $nextYear. '/07';







            // 本日の年度だけを取得
            $nowYear = explode("/",$nowDate)[0];
            Log::debug('nowYear:'.$nowYear);

            // 本日の日付を年月日に分割
            $explode_date = explode("/",$nowDate);
            
            // 月日を変数に格納
            $month = $explode_date[1];
            $date = $explode_date[2];

            // 現在の月日を生成
            $nowMonthDate = $month. '/'. $date;
            Log::debug('nowMonthDate:'.$nowMonthDate);
            
            // 配列初期値（日付）
            $date_list = [];

            // 金額初期値（日付）
            $money_list = [];

            // 現在が8月から12月の場合の処理
            if($nowMonthDate >= '08/01' && $nowMonthDate <= '12/31'){
                Log::debug('現在が8月から12月の場合の処理');


                // 本年度
                $nowYear = $nowYear;
                Log::debug('$nowYear:'. $nowYear);

                // 翌年度
                $nextYear = $nowYear + 1;
                Log::debug('$nextYear:'. $nextYear);

                /**
                 * グラフデータ
                 */               
                $date_list[] = $nowYear. '/08';

                $date_list[] = $nowYear. '/09';

                $date_list[] = $nowYear. '/10';

                $date_list[] = $nowYear. '/11';

                $date_list[] = $nowYear. '/12';
                
                $date_list[] = $nextYear. '/01';

                $date_list[] = $nextYear. '/02';

                $date_list[] = $nextYear. '/03';

                $date_list[] = $nextYear. '/04';

                $date_list[] = $nextYear. '/05';

                $date_list[] = $nextYear. '/06';

                $date_list[] = $nextYear. '/07';
    
                /**
                 * 売上データ
                 */
                /**
                 * 8月～12月までをループ
                 */
                // 月の初期値
                $first_half_month_count = 8;

                for($i = 0; $i < 5; $i++){
                    Log::debug('$i:'. $i);

                    // ループの回数分月を加算
                    $month_count = $first_half_month_count + $i;

                    // 月初・月末を取得
                    $year_month = $nowYear. '-'. $month_count;
                    Log::debug('$year_month:'. $year_month);

                    // 月初取得
                    $first_date = date('Y/m/d', strtotime('first day of ' . $year_month));
                    Log::debug('$first_date:'. $first_date);

                    // 月末取得
                    $last_date = date('Y/m/d', strtotime('last day of ' . $year_month));
                    Log::debug('$last_date:'. $last_date);

                    // 売上データ取得
                    $str = "select "
                    ."count(*) as row_count "
                    .",sum(profit_fee) as profit_fee "
                    ."from "
                    ."profits "
                    ."where "
                    ."profits.profit_date between '$first_date' and '$last_date' ";
                    Log::debug('$str:'. $str);

                    // 実行
                    $profit_fee_info = DB::select($str)[0];

                    // 売上合計値を取得
                    $profit_fee = $profit_fee_info->profit_fee;
                    Log::debug('profit_fee:'.$profit_fee);

                    // 連想配列に売上を設定
                    $money_list[] = $profit_fee;  
                }

                /**
                 * 1月～7月までをループ
                 */
                // 月の初期値
                $second_half_month_count = 1;

                for($i = 0; $i < 7; $i++){
                    Log::debug('$i:'. $i);

                    // ループの回数分月を加算
                    $month_count = $second_half_month_count + $i;

                    // 月初・月末を取得
                    $year_month = $nextYear. '-'. $month_count;
                    Log::debug('$year_month:'. $year_month);

                    // 月初取得
                    $first_date = date('Y/m/d', strtotime('first day of ' . $year_month));
                    Log::debug('$first_date:'. $first_date);

                    // 月末取得
                    $last_date = date('Y/m/d', strtotime('last day of ' . $year_month));
                    Log::debug('$last_date:'. $last_date);

                    // 売上データ取得
                    $str = "select "
                    ."count(*) as row_count "
                    .",sum(profit_fee) as profit_fee "
                    ."from "
                    ."profits "
                    ."where "
                    ."profits.profit_date between '$first_date' and '$last_date' ";
                    Log::debug('$str:'. $str);

                    // 実行
                    $profit_fee_info = DB::select($str)[0];

                    // 売上合計値を取得
                    $profit_fee = $profit_fee_info->profit_fee;
                    Log::debug('profit_fee:'.$profit_fee);

                    // 連想配列に売上を設定
                    $money_list[] = $profit_fee;  
                }

                // 配列デバック
                $arrString = print_r($money_list , true);
                Log::debug('money_list:'.$arrString);

            }

            // 現在が1月から7月の場合の処理
            elseif($nowMonthDate >= '01/01' && $nowMonthDate <= '07/31'){
                Log::debug('現在が1月から7月の場合の処理');

                // 本年度
                $nowYear = $nowYear;
                Log::debug('$nowYear:'. $nowYear);

                // 昨年度
                $last_year = $nowYear - 1;
                Log::debug('$last_year:'. $last_year);

                /**
                 * グラフデータ
                 */               
                $date_list[] = $last_year. '/08';

                $date_list[] = $last_year. '/09';

                $date_list[] = $last_year. '/10';

                $date_list[] = $last_year. '/11';

                $date_list[] = $last_year. '/12';
                
                $date_list[] = $nowYear. '/01';

                $date_list[] = $nowYear. '/02';

                $date_list[] = $nowYear. '/03';

                $date_list[] = $nowYear. '/04';

                $date_list[] = $nowYear. '/05';

                $date_list[] = $nowYear. '/06';

                $date_list[] = $nowYear. '/07';

                /**
                 * 8月～12月までをループ
                 */
                // 月の初期値
                $first_half_month_count = 8;

                for($i = 0; $i < 5; $i++){
                    Log::debug('$i:'. $i);

                    // ループの回数分月を加算
                    $month_count = $first_half_month_count + $i;

                    // 月初・月末を取得
                    $year_month = $last_year. '-'. $month_count;
                    Log::debug('$year_month:'. $year_month);

                    // 月初取得
                    $first_date = date('Y/m/d', strtotime('first day of ' . $year_month));
                    Log::debug('$first_date:'. $first_date);

                    // 月末取得
                    $last_date = date('Y/m/d', strtotime('last day of ' . $year_month));
                    Log::debug('$last_date:'. $last_date);

                    // 売上データ取得
                    $str = "select "
                    ."count(*) as row_count "
                    .",sum(profit_fee) as profit_fee "
                    ."from "
                    ."profits "
                    ."where "
                    ."profits.profit_date between '$first_date' and '$last_date' ";
                    Log::debug('$str:'. $str);

                    // 実行
                    $profit_fee_info = DB::select($str)[0];

                    // 売上合計値を取得
                    $profit_fee = $profit_fee_info->profit_fee;
                    Log::debug('profit_fee:'.$profit_fee);

                    // 連想配列に売上を設定
                    $money_list[] = $profit_fee;  
                }

                /**
                 * 1月～7月までをループ
                 */
                // 月の初期値
                $second_half_month_count = 1;

                for($i = 0; $i < 7; $i++){
                    Log::debug('$i:'. $i);

                    // ループの回数分月を加算
                    $month_count = $second_half_month_count + $i;

                    // 月初・月末を取得
                    $year_month = $nowYear. '-'. $month_count;
                    Log::debug('$year_month:'. $year_month);

                    // 月初取得
                    $first_date = date('Y/m/d', strtotime('first day of ' . $year_month));
                    Log::debug('$first_date:'. $first_date);

                    // 月末取得
                    $last_date = date('Y/m/d', strtotime('last day of ' . $year_month));
                    Log::debug('$last_date:'. $last_date);

                    // 売上データ取得
                    $str = "select "
                    ."count(*) as row_count "
                    .",sum(profit_fee) as profit_fee "
                    ."from "
                    ."profits "
                    ."where "
                    ."profits.profit_date between '$first_date' and '$last_date' ";
                    Log::debug('$str:'. $str);

                    // 実行
                    $profit_fee_info = DB::select($str)[0];

                    // 売上合計値を取得
                    $profit_fee = $profit_fee_info->profit_fee;
                    Log::debug('profit_fee:'.$profit_fee);

                    // 連想配列に売上を設定
                    $money_list[] = $profit_fee;  
                }
            }

            $ret['date_list'] = $date_list;

            // 金額データを設定
            $ret['money_list'] = $money_list;



        }catch(\Throwable $e) {

            throw $e;

        }finally{

        };

        Log::debug('log_end:'.__FUNCTION__);

        return $ret;
    }
}