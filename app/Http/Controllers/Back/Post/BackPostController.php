<?php

namespace App\Http\Controllers\Back\Post;

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
 * 投稿
 */
class BackPostController extends Controller
{   

    /**
     * 投稿一覧：表示
     */
    public function backPostInit(Request $request)
    {   
        Log::debug('start:' .__FUNCTION__);

        try {
      
            // 投稿一覧
            $post_list = $this->getPostList($request);
            
            // 共通クラス
            $common = new Common();

            // 投稿種別
            $post_type_list = $common->getPostType();

            /**
             * フォームに値を保持させるためにそのまま返す
             */
            // フリーワード
            $free_word = $request->input('free_word');
            
            // ★リクエストパラメータをページネーション用の連想配列に格納★
            $paginate_params = [
                'free_word' => $free_word,
            ];

        // 例外処理
        } catch (\Exception $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return view('back.back_post', $post_list, compact('paginate_params', 'post_type_list'));
    }

    /**
     * 一覧(sql)
     */
    private function getPostList(Request $request){

        Log::debug('log_start:'.__FUNCTION__);

        try{

            // フリーワード
            $free_word = $request->input('free_word');
            Log::debug('$free_word:' .$free_word);

            // セッションid
            $session_id = $request->session()->get('create_user_id');
            Log::debug('$session_id:' .$session_id);

            $str = "select "
            ."posts.post_id "
            .",posts.post_title "
            .",posts.post_type_id "
            .",post_types.post_type_name "
            .",posts.post_contents "
            .",posts.active_flag "
            .",posts.entry_user_id "
            .",posts.entry_date "
            .",posts.update_user_id "
            .",posts.update_date "
            ."from "
            ."posts "
            ."left join post_types on "
            ."post_types.post_type_id = posts.post_type_id "
            ."where "
            ."(1 = 1) ";
            
            // where句
            $where = "";

            // フリーワード
            if($free_word !== null){
                $where = $where ."and ifnull(post_title,'') like '%$free_word%'";
                $where = $where ."or ifnull(post_contents,'') like '%$free_word%'";
            };
    
            $str = $str .$where;
            Log::debug('$str:' .$str);

            // query
            $alias = DB::raw("({$str}) as alias");

            // columnの設定、表示件数
            $res = DB::table($alias)->selectRaw("*")->orderByRaw("post_id desc")->paginate(30)->onEachSide(1);

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
     * 投稿編集：表示
     */
    public function backPostEditInit(Request $request)
    {   
        Log::debug('start:' .__FUNCTION__);

        try {
      
            // // 投稿一覧
            // $post_list = $this->getPostList($request);
            
            // 共通クラス
            $common = new Common();

            // 投稿種別
            $post_type_list = $common->getPostType();

        // 例外処理
        } catch (\Exception $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return view('back.back_post_edit', compact('post_type_list'));
    }

}