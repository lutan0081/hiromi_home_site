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

            // 新着情報一覧
            $information_list = $this->getInformationList($request);

            // 施工事例一覧
            $reform_img_list = $this->getReformImgList($request);

            // 登録：登録
            $access_count = $this->ipInsert($request);


        // 例外処理
        } catch (\Exception $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return view('front.front_home', compact('information_list', 'reform_img_list'));
    }

    /**
     * 新着情報：sql
     */
    private function getInformationList(Request $request)
    {

        Log::debug('log_start:'.__FUNCTION__);

        try{

            // sql
            $str = "select * from posts "
            ."where post_type_id = 1 "
            ."and active_flag = 0 "
            ."order by post_id desc "
            ."LIMIT 4; ";
            Log::debug('str:' .$str);
            $ret = DB::select($str);

        }catch(\Throwable $e) {

            throw $e;

        }finally{

        };

        Log::debug('log_end:'.__FUNCTION__);

        return $ret;
    }

    /**
     * アクセスカウンター(DBに登録)
     *
     * @param Request $request
     * @return void
     */
    private function ipInsert(Request $request){

        Log::debug('log_start:' .__FUNCTION__);

        // ipをテーブルに登録
        $ip = $request->ip();
        Log::debug('ip:' .$ip);

        // sql
        $str = "insert "
        ."into "
        ."accesses( "
        ."ip_address, "
        ."entry_date "
        .")values( "
        ."'$ip', "
        ."now() "
        ."); ";
        Log::debug('str:' .$str);
        
        DB::insert($str);
        Log::debug('log_end:' .__FUNCTION__);
    }
    
    /**
     * 自社物件画像一覧
     */
    private function getReformImgList(Request $request){

        Log::debug('log_start:'.__FUNCTION__);

        try{

            $str = "select "
            ."reforms.reform_id "
            .",reforms.reform_title "
            .",reforms.reform_sub_title "
            .",reforms.reform_contents "
            .",reforms.active_flag "
            .",imgs.img_path "
            .",imgs.img_type_id "
            .",reforms.entry_user_id "
            .",reforms.entry_date "
            .",reforms.update_user_id "
            .",reforms.update_date "
            ."from "
            ."reforms "
            ."left join imgs on "
            ."reforms.reform_id = imgs.reform_id "
            ."where "
            ."reforms.active_flag = 0 "
            ."and imgs.img_type_id = 1 "
            ."order by "
            ."reforms.reform_id desc "
            ."limit 8; ";
            Log::debug('str:' .$str);
            $ret = DB::select($str);

        }catch(\Throwable $e) {

            throw $e;

        }finally{

        };

        Log::debug('log_end:'.__FUNCTION__);

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

                // 配列デバック
                $arrString = print_r($money_list , true);
                Log::debug('money_list:'.$arrString);
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