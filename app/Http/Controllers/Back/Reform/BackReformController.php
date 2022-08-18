<?php

namespace App\Http\Controllers\Back\Reform;

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
class BackReformController extends Controller
{
    /**
     * 施工事例一覧：表示
     */
    public function backReformInit(Request $request)
    {   
        Log::debug('start:' .__FUNCTION__);

        try {
      
            // 施工事例一覧
            $reform_list = $this->getReformList($request);
            
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
        return view('back.back_reform', $reform_list, compact('paginate_params', 'reform_list', 'free_word'));
    }

    /**
     * 施工事例一覧：sql
     */
    private function getReformList(Request $request){

        Log::debug('log_start:'.__FUNCTION__);

        try{

            // フリーワード
            $free_word = $request->input('free_word');
            Log::debug('$free_word:' .$free_word);

            // セッションid
            $session_id = $request->session()->get('create_user_id');
            Log::debug('$session_id:' .$session_id);

            $str = "select "
            ."reforms.reform_id "
            .",reforms.reform_title "
            .",reforms.reform_sub_title "
            .",reforms.reform_contents "
            .",reforms.active_flag "
            .",reforms.entry_user_id "
            .",create_users.create_user_name "
            .",reforms.entry_date "
            .",reforms.update_user_id "
            .",reforms.update_date "
            ."from "
            ."reforms "
            ."left join create_users on "
            ."create_users.create_user_id = reforms.entry_user_id "
            ."where "
            ."(1 = 1) ";
            
            // where句
            $where = "";

            // フリーワード
            if($free_word !== null){
                $where = $where ."and ifnull(reform_title,'') like '%$free_word%'";
                $where = $where ."or ifnull(reform_sub_title,'') like '%$free_word%'";
                $where = $where ."or ifnull(reform_contents,'') like '%$free_word%'";
            };
    
            $str = $str .$where;
            Log::debug('$str:' .$str);

            // query
            $alias = DB::raw("({$str}) as alias");

            // columnの設定、表示件数
            $res = DB::table($alias)->selectRaw("*")->orderByRaw("reform_id desc")->paginate(30)->onEachSide(1);

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
     * 施工事例詳細：新規表示
     */
    public function backReformNewInit(Request $request)
    { 
        Log::debug('start:' .__FUNCTION__);

        try {
            // 一覧
            $reform_list = $this->getNewList($request);
            
        // 例外処理
        } catch (\Exception $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return view('back.back_reform_edit', compact('reform_list'));
    }

    /**
     * 施工事例詳細：ダミー配列取得
     */
    private function getNewList(Request $request){
        Log::debug('log_start:'.__FUNCTION__);
        
        $obj = new \stdClass();
        
        $obj->reform_id= '';
        $obj->reform_title= '';
        $obj->reform_sub_title= '';
        $obj->reform_contents= '';
        
        $ret = [];
        $ret = $obj;

        Log::debug('log_end:'.__FUNCTION__);
        return $ret;
    }

    /**
     * 施工事例詳細：編集表示
     */
    public function backReformEditInit(Request $request){   
        Log::debug('start:' .__FUNCTION__);

        try {
            // 施工事例一覧
            $reform_info = $this->getEditList($request);
            $reform_list = $reform_info[0];
            
        // 例外処理
        } catch (\Throwable $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);
        return view('back.back_reform_edit', compact('reform_list'));
    }

    /**
     * 施工事例詳細：編集表示(sql)
     *
     * @return void
     */
    private function getEditList(Request $request){

        Log::debug('start:' .__FUNCTION__);

        try{
            // 値設定
            $reform_id = $request->input('reform_id');

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
            
            $ret = DB::select($str);

        // 例外処理
        } catch (\Exception $e) {

            throw $e;

        } finally {
        }
        
        Log::debug('start:' .__FUNCTION__);
        return $ret;
    }

    /**
     * 施工事例詳細：登録分岐
     */
    public function backReformEntry(Request $request){
        Log::debug('log_start:'.__FUNCTION__);
        
        // return初期値
        $response = [];

        // バリデーション:OK=true NG=false
        // $response = $this->editValidation($request);

        // if($response["status"] == false){
        //     Log::debug('validator_status:falseのif文通過');
        //     return response()->json($response);
        // }

        // 値取得
        $reform_id = $request->input('reform_id');

        /**
         * id=無:insert、id=有:update
         */
        // 新規登録
        if($reform_id == ""){
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
     * 施工事例詳細：バリデーション
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
     * 施工事例編集：新規登録（各テーブルに分岐）
     */
    private function insertData(Request $request){
        Log::debug('log_start:' .__FUNCTION__);

        try {
            // retrunの初期値
            $ret = [];
            $ret['status'] = true;

            /**
             * 施工事例_insert
             */
            $reform_info = $this->insertReform($request);
            $ret['status'] = $reform_info['status'];

            // 登録時のidを取得
            $reform_id = $reform_info['reform_id'];
            Log::debug('reform_id:'.$reform_id);

            /**
             * 画像登録
             */
            $img_files = $request->file('img_files');
            Log::debug('img_files:'.$img_files);
            $count = count($img_files);
            $arrString = print_r($count , true);
            Log::debug('messages:'.$arrString);


            // アップロードしたファイルの件数分ループ
            foreach ($img_files as $file) {
                Log::debug('file'. $file);

                // $reform_img_info = $this->insertImg($request, $reform_id);
                // $ret['status'] = $reform_img_info['status'];
            }
;
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
     * 施工事例編集：新規登録（sql）
     */
    private function insertReform(Request $request){
        Log::debug('log_start:' .__FUNCTION__);

        try {
            // returnの初期値
            $ret=[];

            // 値取得
            $session_id = $request->session()->get('create_user_id');
            $reform_title = $request->input('reform_title');
            $reform_sub_title = $request->input('reform_sub_title');
            $reform_contents = $request->input('editor_input');
            $date = now() .'.000';
    
            // タイトル
            if($reform_title == null){
                $reform_title = '';
            }

            // カテゴリ
            if($reform_sub_title == null){
                $reform_sub_title = '';
            }

            // 記事本文
            if($reform_contents == null){
                $reform_contents = '';
            }

            // insert
            $str = "insert "
            ."into reforms( "
            ."reform_title "
            .",reform_sub_title "
            .",reform_contents "
            .",active_flag "
            .",entry_user_id "
            .",entry_date "
            .",update_user_id "
            .",update_date "
            .") values ( "
            ."'$reform_title' "
            .",'$reform_sub_title' "
            .",'$reform_contents' "
            .",0 "
            .",$session_id "
            .",'$date' "
            .",$session_id "
            .",'$date' "
            ."); ";
            Log::debug('sql:'.$str);
            $ret['status'] = DB::insert($str);

            // select：reform_id取得
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
            ."(reform_title = '$reform_title') "
            ."and "
            ."(reform_sub_title = '$reform_sub_title') "
            ."and "
            ."(reform_contents = '$reform_contents') ";
            Log::debug('sql:'.$str);
            $reform_info = DB::select($str);

            $ret['reform_id'] = $reform_info[0]->reform_id;

        // 例外処理
        } catch (\Throwable  $e) {

            throw $e;

        // status:OK=1/NG=0
        } finally {
        }

        Log::debug('log_end:'.__FUNCTION__);
        return $ret;
    }

    /**
     * 施工事例編集：新規登録（画像）
     */
    private function insertImg(Request $request, $reform_id){
        Log::debug('log_start:'.__FUNCTION__);

        try {

            /**
             * 値取得
             */
            // session_id
            $session_id = $request->session()->get('create_user_id');

            $img_files = $request->file('img_files');
            Log::debug('img_files:'.$img_files);

            // 付属書類がない場合、trueでretrun
            if($img_files == null){
                Log::debug('付属書類がない場合の処理');
                $ret['status'] = 1;
                return $ret;
            }

            // 拡張子取得
            $file_extension = $img_file->getClientOriginalExtension();
            Log::debug('file_extension:'.$file_extension);

            // 種別
            $img_type = $request->input('img_type');
            Log::debug('img_type:'.$img_type);

            // 備考
            $img_text = $request->input('img_text');
            Log::debug('img_text:'.$img_text);

            // 現在の日付取得
            $date = now() .'.000';
        
            // idごとのフォルダ作成のためのパス生成
            $dir ='img/reform/' .$reform_id;
            
            // 任意のフォルダ作成
            // ※appを入れるとエラーになる
            Storage::makeDirectory('/public/' .$dir);

            /**
             * 画像登録処理
             */
            // ファイル名変更
            $file_name = time() .'.' .$file_extension;
            Log::debug('ファイル名:'.$file_name);

            // ファイルパス+ファイル名
            $tmp_file_path = $dir .'/' .$file_name;
            Log::debug('tmp_file_path :'.$tmp_file_path);

            // pdfの場合、通常の保存をする
            if($file_extension == 'pdf'){

                // 第一引数=dir,第二引数=ファイル名
                Log::debug('PDFの処理');
                $img_file->storeAs('/public/'. $dir, $file_name);

            }else{

                // pdf以外は、リサイズし、保存する
                Log::debug('jpg,pngの処理');
                InterventionImage::make($img_file)->resize(380, null,
                function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/' .$tmp_file_path));

            }

            /**
             * 種別idがnullの場合、0を入れる
             */
            if($img_type == null){
                $img_type = 0;
            }

            /**
             * 画像データ(insert)
             */
            $str = "insert "
            ."into "
            ."cost_imgs "
            ."( "
            ."cost_id, "
            ."cost_img_type_id, "
            ."cost_img_path, "
            ."cost_img_memo, "
            ."entry_user_id, "
            ."entry_date, "
            ."update_user_id, "
            ."update_date "
            .")values( "
            ."$cost_id, "
            ."$img_type, "
            ."'$tmp_file_path', "
            ."'$img_text', "
            ."$session_id, "
            ."'$date', "
            ."$session_id, "
            ."'$date' "
            ."); ";
            
            Log::debug('sql:'.$str);

            // OK=1/NG=0
            $ret['status'] = DB::insert($str);

            Log::debug('status:'.$ret);
            
        } catch (\Throwable $e) {

            Log::debug('error:'.$e);

            // storage/app/public/imagesから、画像ファイルを削除する
            Storage::delete($tmp_file_path);

            throw $e;

        }finally{

            Log::debug('log_end:'.__FUNCTION__);
            return $ret;

        }
    }

    /**
     * 投稿詳細：公開・非公開（登録分岐）
     */
    public function backReformReleaseEntry(Request $request){
        Log::debug('log_start:'.__FUNCTION__);
        
        // 初期値
        $response = [];

        /**
         * 値取得
         */
        // id
        $reform_id = $request->input('reform_id');

        // 公開フラグ
        $active_id = $request->input('active_id');

        $ret = $this->updateActiveData($request);

        // js側での判定のステータス(true:OK/false:NG)
        $response["status"] = $ret['status'];

        Log::debug('log_end:' .__FUNCTION__);
        return response()->json($response);
    }

    /**
     * 投稿詳細：公開・非公開（sql）
     */
    private function updateActiveData(Request $request){
        Log::debug('log_start:' .__FUNCTION__);

        try {
            // returnの初期値
            $ret=[];

            // 値取得
            $session_id = $request->session()->get('create_user_id');

            // id
            $reform_id = $request->input('reform_id');

            // 公開フラグ
            $active_id = $request->input('active_id');

            // 日付
            $date = now() .'.000';

            $str = "update reforms "
            ."set "
            ."active_flag = $active_id "
            .",update_user_id = $session_id "
            .",update_date = '$date' "
            ."where "
            ."reform_id = $reform_id ";
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