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

    /**
     * 投稿詳細：登録分岐
     */
    public function backUserEditEntry(Request $request){
        Log::debug('log_start:'.__FUNCTION__);
        
        // return初期値
        $response = [];

        // バリデーション:OK=true NG=false
        $response = $this->editValidation($request);

        if($response["status"] == false){
            Log::debug('validator_status:falseのif文通過');
            return response()->json($response);
        }

        Log::debug('編集の処理');
        $ret = $this->updateData($request);

        // js側での判定のステータス(true:OK/false:NG)
        $response["status"] = $ret['status'];

        Log::debug('log_end:' .__FUNCTION__);
        return response()->json($response);
    }

    /**
     * 投稿詳細：バリデーション
     */
    private function editValidation(Request $request){
        Log::debug('log_start:'.__FUNCTION__);

        // 値取得
        $create_user_password = $request->input('create_user_password');
        $create_user_password_again = $request->input('create_user_password_again');

        // returnの出力値
        $response = [];
        $response["status"] = true;

        // rules
        $rules = [];
        $rules['create_user_name'] = "required|max:50";
        $rules['create_user_mail'] = "required|email";
        $rules['create_user_password'] = "required|max:10|min:8";
        $rules['create_user_password_again'] = "required|max:10|min:8";
        
        // messages
        $messages = [];
        $messages['create_user_name.required'] = "ユーザ名は必須です。";
        $messages['create_user_name.max'] = "ユーザ名が超過しています。";
        $messages['create_user_mail.required'] = "メールアドレスが必須です。";
        $messages['create_user_mail.email'] = "メールアドレスの形式が不正です。";
        $messages['create_user_password.required'] = "パスワードは必須です。";
        $messages['create_user_password.max'] = "パスワードは8文字から10文字以内です。";
        $messages['create_user_password.min'] = "パスワードは8文字から10文字以内です。";
        $messages['create_user_password_again.required'] = "パスワードは必須です。";
        $messages['create_user_password_again.max'] = "パスワードは8文字から10文字以内です。";
        $messages['create_user_password_again.min'] = "パスワードは8文字から10文字以内です。";

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
     * 投稿編集：編集登録（各テーブルに分岐）
     */
    private function updateData(Request $request){
        Log::debug('log_start:' .__FUNCTION__);

        try {
            // retrunの初期値
            $ret = [];
            $ret['status'] = true;

            // 投稿のinsert
            $post_info = $this->updateUser($request);
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
     * 投稿詳細；編集登録（sql）
     */
    private function updateUser(Request $request){
        Log::debug('log_start:' .__FUNCTION__);

        try {
            // returnの初期値
            $ret=[];

            // 値取得
            $create_user_name = $request->input('create_user_name');
            $session_id = $request->session()->get('create_user_id');
            $create_user_mail = $request->input('create_user_mail');
            $create_user_password = $request->input('create_user_password');
            $create_user_password_again = $request->input('create_user_password_again');
            $create_user_id = $request->input('create_user_id');
            $date = now() .'.000';
    
            // ユーザ名
            if($create_user_name == null){
                $create_user_name = '';
            }

            // メールアドレス
            if($create_user_mail == null){
                $create_user_mail = '';
            }

            // パスワード
            if($create_user_password == null){
                $create_user_password = '';
            }

            // パスワード確認用
            if($create_user_password_again == null){
                $create_user_password_again = '';
            }

            $str = "update create_users "
            ."set "
            ."create_user_name = '$create_user_name' "
            .",create_user_mail = '$create_user_mail' "
            .",create_user_password = '$create_user_password' "
            .",entry_date = '$date' "
            .",update_user_id = $session_id "
            .",update_date = '$date' "
            ."where "
            ."create_user_id = $create_user_id ";            
            Log::debug('sql:'.$str);

            // ok=1/ng=0
            $ret['status'] = DB::update($str);

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