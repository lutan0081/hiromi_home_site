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
 * ホーム(バックエンド)
 */
class FrontHomeController extends Controller
{   
    /**
     *  ホーム(表示)
     *
     * @param Request $request
     * @return view('application.application','list_user_count','list_app_count','list_picture_count','list_contacts_count','list_access_total','list_access_today');
     */
    public function frontHomeInit(Request $request)
    {   
        Log::debug('start:' .__FUNCTION__);

        try {
            // 現在の日付から月初を取得
            $start_date = new DateTime('first day of this month');
            $start_date = $start_date->format('Y/m/d');
            Log::debug('start_date:' .$start_date);

            // 現在の日付から来月の月初を取得
            $end_date = new DateTime('last day of this month');
            $end_date = $end_date->format('Y/m/d');
            Log::debug('end_date:' .$end_date);

            // 当月売上
            $thisMonthProfit_info = $this->getThisMonthProfit($request, $start_date, $end_date);
            $thisMonthProfit_list = $thisMonthProfit_info[0];

            // 年間売上
            $thisYearProfit_info = $this->getThisYearProfit($request, $start_date, $end_date);
            $thisYearProfit_list = $thisYearProfit_info[0];

            // 当月経費
            $thisMonthCost_info = $this->getThisMonthCost($request, $start_date, $end_date);
            $thisMonthCost_list = $thisMonthCost_info[0];

            // 年間経費
            $thisYearCost_info = $this->getThisYearCost($request, $start_date, $end_date);
            $thisYearCost_list = $thisYearCost_info[0];

            // 承諾数(売上)
            $profitApproval_info = $this->getProfitApproval($request);
            $profitApproval_list = $profitApproval_info[0];

            // 承諾数(経費)
            $costApproval_info = $this->getCostApproval($request);
            $costApproval_list = $costApproval_info[0];

            // 質問件数(経費)
            $cost_quetion_info = $this->getCostQuestionContents($request);
            $cost_quetion_list = $cost_quetion_info[0];

            // 質問件数(売上)
            $profit_quetion_info = $this->getProfitQuestionContents($request);
            $profit_quetion_list = $profit_quetion_info[0];

            // 新着情報
            $information_info = $this->getInformations($request);
            $information_list = $information_info;

            // ★リクエストパラメータをページネーション用の連想配列に格納★
            $paginate_params = [];

            /**
             * グラフデータ
             */
            $chart_data = $this->getChartData($request);
            // dd($chart_data);


            // // 年月データ(DBから取得を想定)
            // $date_list = [];

            // $d = new \stdClass();
            // $d->ym = '2020/01';
            // $date_list[] = $d;

            // $d = new \stdClass();
            // $d->ym = '2020/02';
            // $date_list[] = $d;

            // $d = new \stdClass();
            // $d->ym = '2020/03';
            // $date_list[] = $d;

            // $d = new \stdClass();
            // $d->ym = '2020/04';
            // $date_list[] = $d;

            // $d = new \stdClass();
            // $d->ym = '2020/05';
            // $date_list[] = $d;

            // // 金額データ(DBから取得を想定)
            // $money_list = [];
            // $m = new \stdClass();
            // $m->money = '20';
            // $money_list[] = $m;

            // $m = new \stdClass();
            // $m->money = '30';
            // $money_list[] = $m;

            // $m = new \stdClass();
            // $m->money = '5';
            // $money_list[] = $m;

            // // 出力値
            // $outPut = [];
            // // 年月データを設定
            // $outPut['date_list'] = $date_list;
            // // 金額データを設定
            // $outPut['money_list'] = $money_list;




            
        // 例外処理
        } catch (\Exception $e) {

            Log::debug('error:'.$e);

        } finally {

        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return view('back.backHome', $information_list, compact('paginate_params', 'thisMonthProfit_list', 'thisYearProfit_list', 'thisMonthCost_list', 'thisYearCost_list', 'profitApproval_list', 'costApproval_list', 'cost_quetion_list', 'profit_quetion_list'))->with($chart_data);
        // return view('back.backHome', $information_list, compact('paginate_params', 'thisMonthProfit_list', 'thisYearProfit_list', 'thisMonthCost_list', 'thisYearCost_list', 'profitApproval_list', 'costApproval_list', 'cost_quetion_list', 'profit_quetion_list', 'chart_data'));
    }

}