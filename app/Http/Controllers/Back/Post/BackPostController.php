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
     * 投稿一覧：sql
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

    /**
     * 投稿編集：登録分岐
     */
    public function backPostEntry(Request $request){
        Log::debug('log_start:'.__FUNCTION__);
        
        // return初期値
        $response = [];

        // バリデーション:OK=true NG=false
        $response = $this->editValidation($request);

        if($response["status"] == false){
            Log::debug('validator_status:falseのif文通過');
            return response()->json($response);
        }

        // 値取得
        $post_id = $request->input('post_id');

        /**
         * id=無:insert、id=有:update
         */
        // 新規登録
        if($post_id == ""){
            Log::debug('新規の処理');
            $ret = $this->insertData($request);
        // 編集登録
        }else{
            Log::debug('編集の処理');
            $ret = $this->updateData($request);
        }

        // js側での判定のステータス(true:OK/false:NG)
        $response["status"] = $ret['status'];

        Log::debug('log_end:' .__FUNCTION__);
        return response()->json($response);
    }

    /**
     * 投稿編集：バリデーション
     */
    private function editValidation(Request $request){
        Log::debug('log_start:'.__FUNCTION__);

        // returnの出力値
        $response = [];
        $response["status"] = true;

        // rules
        $rules = [];
        $rules['post_title'] = "required|max:50";
        $rules['editor_input'] = "required";

        // messages
        $messages = [];
        $messages['post_title.required'] = "タイトルは必須です。";
        $messages['post_title.max'] = "タイトルの文字数が超過しています。";
        $messages['editor_input.required'] = "記事本文は必須です。";
    
        // validation判定
        $validator = Validator::make($request->all(), $rules, $messages);

        // エラーがある場合処理
        if ($validator->fails()) {
            Log::debug('validator:失敗');

            // response初期値
            $keys = [];
            $msgs = [];

            // errorsをjson形式に変換(true=連想配列)
            $ary = json_decode($validator->errors(), true);
            
            // ループ&値をvalueに設定
            foreach ($ary as $key => $value) {
                // キーを配列に設定
                $keys[] = $key;
                // 値(メッセージ)を設定
                $msgs[] = $value;
            }

            // keyデバック
            $arrKeys = print_r($keys , true);
            Log::debug('keys:'.$arrKeys);

            // msgsデバック
            $arrMsgs = print_r($msgs , true);
            Log::debug('msgs:'.$arrMsgs);

            // response値設定
            // status = falseの場合js側でerrorメッセージ表示
            $response["status"] = false;
            $response['msg'] = "入力を確認して下さい。";
            $response["messages"] = $msgs;
            $response["errkeys"] = $keys;
            
            Log::debug('log_end:' .__FUNCTION__);
        }

        Log::debug('log_end:'.__FUNCTION__);
        return $response;
    }

    /**
     * 投稿編集：新規登録（各テーブルに分岐）
     */
    private function insertData(Request $request){
        Log::debug('log_start:' .__FUNCTION__);

        try {
            // retrunの初期値
            $ret = [];
            $ret['status'] = true;

            // 投稿のinsert
            $post_info = $this->insertPost($request);
            $ret['status'] = $post_info['status'];

        // 例外処理
        } catch (\Throwable $e) {

            Log::debug(__FUNCTION__ .':' .$e);
            $ret['status'] = 0;

        // status:OK=1/NG=0
        } finally {

            if($ret['status'] == 1){
                Log::debug('status:trueの処理');
                $ret['status'] = true;
            }else{
                Log::debug('status:falseの処理');
                $ret['status'] = false;
            }

            Log::debug('log_end:'.__FUNCTION__);
            return $ret;
        }
    }

    /**
     * 投稿編集；sql
     */
    private function insertPost(Request $request){
        Log::debug('log_start:' .__FUNCTION__);

        try {
            // returnの初期値
            $ret=[];

            // 値取得
            $session_id = $request->session()->get('create_user_id');
            $post_title = $request->input('post_title');
            $post_type_id = $request->input('post_type_id');
            $editor_input = $request->input('editor_input');
            $date = now() .'.000';
    
            // タイトル
            if($post_title == null){
                $post_title = '';
            }

            // カテゴリ
            if($post_type_id == null){
                $post_type_id = 0;
            }

            // 記事本文
            if($editor_input == null){
                $editor_input = '';
            }

            $str = "insert "
            ."into posts( "
            ."post_title "
            .",post_type_id "
            .",post_contents "
            .",active_flag "
            .",entry_user_id "
            .",entry_date "
            .",update_user_id "
            .",update_date "
            .")values( "
            ."'$post_title' "
            .",$post_type_id "
            .",'$editor_input' "
            .",0 "
            .",$session_id "
            .",'$date' "
            .",$session_id "
            .",'$date' "
            .") ";
            Log::debug('sql:'.$str);

            // ok=1/ng=0
            $ret['status'] = DB::insert($str);

        // 例外処理
        } catch (\Throwable  $e) {

            throw $e;

        // status:OK=1/NG=0
        } finally {
        }

        Log::debug('log_end:'.__FUNCTION__);
        return $ret;
    }
}