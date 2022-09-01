<?php

namespace App\Http\Controllers\Front\Works;

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
 * 施工事例
 */
class FrontWorksController extends Controller
{   
    /**
     * 施工事例一覧：表示
     *
     * @param Request $request
     * @return view()
     */
    public function frontWorksInit(Request $request)
    {   
        Log::debug('start:' .__FUNCTION__);

        try {
            // 詳細
            $reform_list = $this->getReformList($request);

        // 例外処理
        } catch (\Exception $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return view('front.front_works', compact('reform_list'));
    }

    /**
     * 施工事例一覧：sql
     */
    private function getReformList(Request $request){

        Log::debug('log_start:'.__FUNCTION__);

        try{

            // 施工事例id
            $reform_id = $request->input('reform_id');
            Log::debug('$reform_id:' .$reform_id);

            // sql
            $str = "select "
            ."reforms.reform_id "
            .",imgs.img_path "
            .",imgs.img_type_id "
            .",reforms.reform_title "
            .",reforms.reform_sub_title "
            .",reforms.reform_contents "
            .",reforms.active_flag "
            .",reforms.entry_user_id "
            .",reforms.entry_date "
            .",reforms.update_user_id "
            .",reforms.update_date "
            ."from "
            ."reforms "
            ."left join imgs "
            ."on imgs.reform_id = reforms.reform_id "
            ."where imgs.img_type_id = 1 "
            ."order by img_id desc "
            ."limit 9 "
            ."offset 0 ";
            // limit = 件数取得
            // ofset = 開始位置を取得
            // もっと見るをclickの後、初期=0、2回目=10...

            Log::debug('sql:' .$str);
            $ret = DB::select($str);

        }catch(\Throwable $e) {

            throw $e;

        }finally{

        };

        Log::debug('log_end:'.__FUNCTION__);

        return $ret;
    }

    /**
     * 施工事例一覧（もっと見る）：分岐
     */
    public function frontWorksViewMore(Request $request)
    {   
        Log::debug('start:' .__FUNCTION__);

        try {

            // return初期値
            $response = [];

            $ofset_id = $request->input('ofset_id');
            Log::debug('ofset_id:' .$ofset_id);

            // 一覧
            $response['reform_list'] = $this->getReformMoreList($request);

            // 配列デバック
            $arrString = print_r($response['reform_list'] , true);
            Log::debug('reform_list:'.$arrString);

            /**
             * 初期値=9
             * もっと見るをclick毎に+9
             */
            // ofset_id
            // $ofset_id = $request->input('ofset_id');
            // Log::debug('$ofset_id:' .$ofset_id);

            $response['ofset_id'] = $ofset_id + 9;
            Log::debug('ofset_id_add:'.$ofset_id);

        // 例外処理
        } catch (\Exception $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return response()->json($response);
    }

    /**
     * 施工事例一覧：（もっと見る）：sql
     */
    private function getReformMoreList(Request $request){

        Log::debug('log_start:'.__FUNCTION__);

        try{

            // ofset_id
            $ofset_id = $request->input('ofset_id');
            Log::debug('$ofset_id:' .$request->input('ofset_id'));
            
            // sql
            $str = "select "
            ."reforms.reform_id "
            .",imgs.img_path "
            .",imgs.img_type_id "
            .",reforms.reform_title "
            .",reforms.reform_sub_title "
            .",reforms.reform_contents "
            .",reforms.active_flag "
            .",reforms.entry_user_id "
            .",reforms.entry_date "
            .",reforms.update_user_id "
            .",reforms.update_date "
            ."from "
            ."reforms "
            ."left join imgs "
            ."on imgs.reform_id = reforms.reform_id "
            ."where imgs.img_type_id = 1 "
            ."order by reform_id desc "
            ."limit 9 "
            ."offset $ofset_id ";
            // limit = 件数取得
            // ofset = 開始位置を取得
            // もっと見るをclickの後、初期=0、2回目=10...

            Log::debug('sql:' .$str);
            $ret = DB::select($str);

        }catch(\Throwable $e) {

            throw $e;

        }finally{

        };

        Log::debug('log_end:'.__FUNCTION__);

        return $ret;
    }

    /**
     * 施工事例詳細：表示
     */
    public function frontWorksEditInit(Request $request)
    {   
        Log::debug('start:' .__FUNCTION__);

        try {
            // 詳細
            $reform_edit_list = $this->getReformEditList($request);

            // 写真一覧
            $img_list = $this->getImgList($request);

        // 例外処理
        } catch (\Exception $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return view('front.front_works_edit', compact('reform_edit_list', 'img_list'));
    }

    /**
     * 施工事例詳細：sql
     */
    private function getReformEditList(Request $request){

        Log::debug('log_start:'.__FUNCTION__);

        try{

            // 施工事例id
            $reform_id = $request->input('reform_id');
            Log::debug('$reform_id:' .$reform_id);

            // sql
            $str = "select "
            ."reform_id "
            .",reform_title "
            .",reform_sub_title "
            .",reform_contents "
            .",active_flag "
            .",entry_user_id "
            .",entry_date "
            .",update_user_id "
            .",update_date "
            ."from "
            ."reforms "
            ."where "
            ."reform_id = $reform_id ";
            Log::debug('sql:' .$str);
            $ret = DB::select($str)[0];

        }catch(\Throwable $e) {

            throw $e;

        }finally{

        };

        Log::debug('log_end:'.__FUNCTION__);

        return $ret;
    }

    /**
     * 画像一覧：sql
     */
    private function getImgList(Request $request){
        Log::debug('start:' .__FUNCTION__);

        try{
            // 値設定
            $reform_id = $request->input('reform_id');

            $str = "select "
            ."imgs.img_id "
            .",imgs.reform_id "
            .",imgs.img_type_id "
            .",img_types.img_type_name "
            .",imgs.img_path "
            .",imgs.img_memo "
            .",imgs.entry_user_id "
            .",imgs.entry_date "
            .",imgs.update_user_id "
            .",imgs.update_date "
            ."from "
            ."imgs "
            ."left join img_types on "
            ."img_types.img_type_id = imgs.img_type_id "
            ."where "
            ."reform_id = $reform_id ";
            Log::debug('sql:' .$str);

            $ret = DB::select($str);

        } catch (\Throwable $e) {

            throw $e;

        } finally {

        }

        Log::debug('end:' .__FUNCTION__);
        return $ret;
    }
}