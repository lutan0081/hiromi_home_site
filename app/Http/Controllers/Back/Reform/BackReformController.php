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

// データ縮小
use InterventionImage;

use Storage;

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
            // 施工一覧
            $reform_list = $this->getNewList($request);

            // 画像一覧
            $img_list = [];

            // 画像種別一覧
            $img_type_list = [];

        // 例外処理
        } catch (\Exception $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);

        // compctは代入名=キーになる
        // キーに名前をつけるときはwith()にする
        return view('back.back_reform_edit', compact('reform_list', 'img_list', 'img_type_list'));
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

            // 画像一覧
            $img_list = $this->getImgList($request);

            // 共通クラス
            $common = new Common();

            // お知らせ
            $img_type_list = $common->getImgType();

        // 例外処理
        } catch (\Throwable $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);
        return view('back.back_reform_edit', compact('reform_list', 'img_list' ,'img_type_list'));
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

    /**
     * 施工事例詳細：登録分岐
     */
    public function backReformEntry(Request $request){
        Log::debug('log_start:'.__FUNCTION__);
        
        // return初期値
        $response = [];

        // // バリデーション:OK=true NG=false
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

        $img_files = $request->file('img_files');

        // returnの出力値
        $response = [];
        $response["status"] = true;

        // rules
        $rules = [];
        $rules['reform_title'] = "required|max:50";
        $rules['reform_sub_title'] = "required|max:50";
        if($img_files !== null){
            Log::debug('画像(rules)添付の処理');
            $rules['img_files'] = "nullable|mimes:jpeg,png,jpg";
        }

        // messages
        $messages = [];
        $messages['reform_title.required'] = "タイトルは必須です。";
        $messages['reform_title.max'] = "タイトルの文字数が超過しています。";
        $messages['reform_sub_title.required'] = "サブタイトルは必須です。";
        $messages['reform_sub_title.max'] = "サブタイトルの文字数が超過しています。";
        if($img_files !== null){
            Log::debug('画像(messages)添付の処理');
            $messages['img_files.mimes'] = "画像ファイル（jpg.jpeg.png）でアップロードしてください。";
        }

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

            if($img_files !== null){
                // 保存時同じファイル名になってしまうので、カウントを追加
                $count = 0;

                // アップロードしたファイルの件数分ループ
                foreach ($img_files as $file) {
                    Log::debug('file'. $file);
                    
                    // 画像登録
                    $reform_img_info = $this->insertImg($request, $reform_id, $file, $count);
                    $ret['status'] = $reform_img_info['status'];

                    $count = $count + 1;
                    Log::debug('count:'. $count);
                }
            }

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
     * 施工事例編集：編集登録（各テーブルに分岐）
     */
    private function updateData(Request $request){
        Log::debug('log_start:' .__FUNCTION__);

        try {
            // retrunの初期値
            $ret = [];
            $ret['status'] = true;

            /**
             * 値取得
             */
            $reform_id = $request->input('reform_id');

            /**
             * 施工事例_update
             */
            $reform_info = $this->updateReform($request);
            $ret['status'] = $reform_info['status'];

            /**
             * 画像登録
             */
            $img_files = $request->file('img_files');

            if($img_files !== null){
                // 保存時同じファイル名になってしまうので、カウントを追加
                $count = 0;

                // アップロードしたファイルの件数分ループ
                foreach ($img_files as $file) {
                    Log::debug('file'. $file);
                    
                    // 画像登録
                    $reform_img_info = $this->insertImg($request, $reform_id, $file, $count);
                    $ret['status'] = $reform_img_info['status'];

                    $count = $count + 1;
                    Log::debug('count:'. $count);
                }
            }

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
     * 施工事例編集：編集登録（sql）
     */
    private function updateReform(Request $request){
        Log::debug('log_start:' .__FUNCTION__);

        try {
            // returnの初期値
            $ret=[];

            // 値取得
            $session_id = $request->session()->get('create_user_id');
            $reform_id = $request->input('reform_id');
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

            // update
            $str = "update reforms "
            ."set "
            ."reform_title = '$reform_title' "
            .",reform_sub_title = '$reform_sub_title' "
            .",reform_contents = '$reform_contents' "
            .",update_user_id = $session_id "
            .",update_date = '$date' "
            ."where "
            ."reform_id = $reform_id ";
            
            Log::debug('sql:'.$str);
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

    /**
     * 施工事例編集：新規・編集登録（画像）
     */
    private function insertImg(Request $request, $reform_id, $file, $count){
        Log::debug('log_start:'.__FUNCTION__);

        try {

            /**
             * 値取得
             */
            // session_id
            $session_id = $request->session()->get('create_user_id');

            // 画像ファイル
            $img_file = $file;
            Log::debug('$img_file:'.$img_file);

            // 画像がない場合、trueでretrun
            if($img_file == null){
                Log::debug('画像がない場合の処理');
                $ret['status'] = 1;
                return $ret;
            }

            // 拡張子取得
            $file_extension = $img_file->getClientOriginalExtension();
            Log::debug('file_extension:'.$file_extension);

            // 現在の日付取得
            $date = now() .'.000';
        
            // idごとのフォルダ作成のためのパス生成
            $dir ='img/reform/' .$reform_id;
            
            // 任意のフォルダ作成
            // ※appを入れるとエラーになる
            Storage::makeDirectory('/public/' .$dir);

            /**
             * 画像登録
             */
            // ファイル名変更
            $file_name = time(). '_'. $count .'.' .$file_extension;
            Log::debug('ファイル名:'.$file_name);

            // ファイルパス+ファイル名
            $tmp_file_path = $dir .'/' .$file_name;
            Log::debug('tmp_file_path :'.$tmp_file_path);

            // pdf以外は、リサイズし、保存する
            Log::debug('jpg,pngの処理');
            InterventionImage::make($img_file)->resize(380, null,
            function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/' .$tmp_file_path));

            /**
             * 画像データ(insert)
             */
            $str = "insert "
            ."into imgs( "
            ."reform_id "
            .",img_type_id "
            .",img_path "
            .",img_memo "
            .",entry_user_id "
            .",entry_date "
            .",update_user_id "
            .",update_date "
            .") values ( "
            ."$reform_id "
            .",0 "
            .",'$tmp_file_path' "
            .",'' "
            .",$session_id "
            .",'$date' "
            .",$session_id "
            .",'$date' "
            .") ";
            Log::debug('sql:'.$str);

            // OK=1/NG=0
            $ret['status'] = DB::insert($str);
            
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
     * 施工事例画像：編集表示
     */
    public function backImgEditInit(Request $request){   
        Log::debug('start:' .__FUNCTION__);

        try {

            // 値取得
            $img_id = $request->input('id');
    
            // update
            $str = "select * from imgs "
            ."where "
            ."img_id = $img_id ";
            Log::debug('sql:'.$str);
            $img_list = DB::select($str);

            // return初期値
            $response = [];
            $response['img_list'] = $img_list;

        // 例外処理
        } catch (\Throwable $e) {

            Log::debug('error:'.$e);

        } finally {
        }

        Log::debug('end:' .__FUNCTION__);
        return response()->json($response);
    }

    /**
     * 施工事例画像：登録分岐
     */
    public function backImgEditEntry(Request $request){
        Log::debug('log_start:'.__FUNCTION__);
        
        // return初期値
        $response = [];

        // // バリデーション:OK=true NG=false
        // $response = $this->editValidation($request);

        // if($response["status"] == false){
        //     Log::debug('validator_status:falseのif文通過');
        //     return response()->json($response);
        // }
        $ret = $this->updateImgData($request);

        // js側での判定のステータス(true:OK/false:NG)
        $response["status"] = $ret['status'];

        Log::debug('log_end:' .__FUNCTION__);
        return response()->json($response);
    }

    /**
     * 施工事例画像：バリデーション
     */
    private function editImgValidation(Request $request){
        Log::debug('log_start:'.__FUNCTION__);

        $img_files = $request->file('img_files');

        // returnの出力値
        $response = [];
        $response["status"] = true;

        // rules
        $rules = [];
        $rules['reform_title'] = "required|max:50";
        $rules['reform_sub_title'] = "required|max:50";
        if($img_files !== null){
            Log::debug('画像(rules)添付の処理');
            $rules['img_files'] = "nullable|mimes:jpeg,png,jpg";
        }

        // messages
        $messages = [];
        $messages['reform_title.required'] = "タイトルは必須です。";
        $messages['reform_title.max'] = "タイトルの文字数が超過しています。";
        $messages['reform_sub_title.required'] = "サブタイトルは必須です。";
        $messages['reform_sub_title.max'] = "サブタイトルの文字数が超過しています。";
        if($img_files !== null){
            Log::debug('画像(messages)添付の処理');
            $messages['img_files.mimes'] = "画像ファイル（jpg.jpeg.png）でアップロードしてください。";
        }

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
     * 施工事例画像：登録（各テーブルに分岐）
     */
    private function updateImgData(Request $request){
        Log::debug('log_start:' .__FUNCTION__);

        try {
            // retrunの初期値
            $ret = [];
            $ret['status'] = true;

            /**
             * 画像詳細：update
             */
            $img_info = $this->updateImg($request);
            $ret['status'] = $img_info['status'];

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
     * 施工事例画像：登録（sql）
     */
    private function updateImg(Request $request){
        Log::debug('log_start:' .__FUNCTION__);

        try {
            // returnの初期値
            $ret=[];

            // 値取得
            $session_id = $request->session()->get('create_user_id');
            $img_id = $request->input('img_id');
            $img_type_id = $request->input('img_type_id');
            $img_memo = $request->input('img_memo');
            $date = now() .'.000';
    
            // 種別
            if($img_type_id == null){
                $img_type_id = 0;
            }

            // 備考
            if($img_memo == null){
                $img_memo = '';
            }

            $str = "update imgs "
            ."set "
            ."img_type_id = $img_type_id "
            .",img_memo = '$img_memo' "
            .",update_user_id = $session_id "
            .",update_date = '$date' "
            ."where "
            ."img_id = $img_id ";

            Log::debug('sql:'.$str);
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

    /**
     * 施工事例削除：登録分岐
     *
     * @param Request $request
     * @return void
     */
    public function backReformDeleteEntry(Request $request){
        Log::debug('log_start:'.__FUNCTION__);

        try{

            DB::beginTransaction();

            // return初期値
            $response = [];

            /**
             * 経費概要
             */
            $reform_info = $this->deleteReform($request);

            // js側での判定のステータス(true:OK/false:NG)
            $response['status'] = $reform_info['status'];

            /**
             * 補足資料
             */
            $img_info = $this->deleteImg($request);

            // js側での判定のステータス(true:OK/false:NG)
            $ret['status'] = $img_info['status'];

            // js側での判定のステータス(true:OK/false:NG)
            $response["status"] = $ret['status'];

            DB::commit();

        // 例外処理
        } catch (\Throwable $e) {

            DB::rollback();

            Log::debug(__FUNCTION__ .':' .$e);

            $response['status'] = 0;

        // status:OK=1/NG=0
        } finally {

            if($response['status'] == 1){

                Log::debug('status:trueの処理');
                $response['status'] = true;

            }else{

                Log::debug('status:falseの処理');
                $response['status'] = false;
            }

        }

        Log::debug('log_end:' .__FUNCTION__);
        return response()->json($response);
    }

    /**
     * 施工事例削除：sql
     *
     * @param Request $request
     * @return void
     */
    private function deleteReform(Request $request){
        Log::debug('log_start:'.__FUNCTION__);

        try{
            // return初期値
            $ret = [];

            // 値取得
            $reform_id = $request->input('reform_id');

            $str = "delete "
            ."from "
            ."reforms "
            ."where "
            ."reform_id = $reform_id; ";
            Log::debug('str:'.$str);

            // OK=1/NG=0
            $ret['status'] = DB::delete($str);

        // 例外処理
        } catch (\Throwable $e) {

            Log::debug(__FUNCTION__ .':' .$e);

            throw $e;

        // status:OK=1/NG=0
        } finally {

        }

        Log::debug('log_end:' .__FUNCTION__);
        return $ret;
    }

    /**
     * 施工事例削除：画像データ
     *
     * @param Request $request
     * @return void
     */
    public function deleteImg(Request $request){
        Log::debug('log_start:'.__FUNCTION__);

        try{
            $ret = [];

            // 値取得
            $reform_id = $request->input('reform_id');

            /**
             * 画像削除
             * 1.契約者Idごとの画像データ取得
             * 2.パス取得
             * 3.フォルダ削除
             * 4.データ(DB)削除
             */
            $str = "select * from imgs "
            ."where reform_id = '$reform_id' ";
            Log::debug('select_img_sql:'.$str);
            $img_list = DB::select($str);

            // デバック
            $arrString = print_r($img_list , true);
            Log::debug('log_Imgs:'.$arrString);

            /**
             * 画像データが存在しない場合
             * 削除対象が無のため、return=trueを返却
             */
            if(count($img_list) == 0){
                Log::debug('画像データが存在しない場合の処理');

                $ret['status'] = 1;

                return $ret;
            }

            // 画像パスを"/"で分解->配列化
            $arr = explode('/', $img_list[0]->img_path);

            // appを除外し文字結合(public/img/214)
            $img_dir_path = $arr[0] ."/" .$arr[1] ."/" .$arr[2];

            // フォルダ削除
            Storage::deleteDirectory('/public/' .$img_dir_path);

            // 画像データ削除(DB)
            $str = "delete from imgs "
            ."where reform_id = '$reform_id' ";
            Log::debug('delete_img_sql:'.$str);

            $ret['status'] = DB::delete($str);
            Log::debug($ret['status']);
            
        // 例外処理
        } catch (\Throwable $e) {

            Log::debug(__FUNCTION__ .':' .$e);

            throw $e;

        // status:OK=1/NG=0
        } finally {

        }

        Log::debug('log_end:' .__FUNCTION__);
        return $ret;
    }

    /**
     * 施工事例削除（画像詳細）：削除・画像データ
     *
     * @param Request $request
     * @return $ret['status'] OK=true/NG=false
     */
    public function backImgDeleteEntry(Request $request){
        Log::debug('log_start:'.__FUNCTION__);

        try{
            // トランザクション
            DB::beginTransaction();

            $response = [];

            // 値取得
            $img_id = $request->input('img_id');

            /**
             * 画像削除
             * 1.契約者Idごとの画像データ取得
             * 2.パス取得
             * 3.フォルダ削除
             * 4.データ(DB)削除
             */
            $str = "select * from imgs "
            ."where img_id = '$img_id' ";
            Log::debug('select_img_sql:'.$str);
            $img_list = DB::select($str);

            // デバック
            $arrString = print_r($img_list , true);
            Log::debug('imgs:'.$arrString);

            // 画像データが存在しない場合、削除対象が無のため、return=trueを返却
            if(count($img_list) == 0){
                Log::debug('画像が存在しない場合の処理');

                $ret['status'] = true;

                // コミット(記載無しの場合、処理が実行されない)
                DB::commit();

                return response()->json($response);
            }
            
            /**
             * 画像ファイル削除
             */
            // 画像パスを"/"で分解->配列化
            $img_name_path = $img_list[0]->img_path;
            Log::debug('img_name_path:'.$img_name_path);

            // ファイル削除(例:Storage::delete('public/img/214/1637578613.jpg');
            Storage::delete('/public/' .$img_name_path);

            /**
             * 画像フォルダ削除
             */
             // 画像パスを"/"で分解->配列化
            $arr = explode('/', $img_list[0]->img_path);
            $img_dir_path = $arr[0] ."/" .$arr[1] ."/" .$arr[2];

            // フォルダの中身を確認
            $img_arr = Storage::files('/public/' .$img_dir_path);

            // デバック(ファイルの中身を確認)
            Log::debug('img_arr:'.$arrString);
            $arrString = print_r($img_arr , true);

            // 参照の値が空白の場合、フォルダ削除
            if(empty($img_arr)){

                Log::debug('フォルダの中身がない場合の処理');

                // フォルダ削除
                Storage::deleteDirectory('/public/' .$img_dir_path);
            }

            // 画像データ削除(DB)
            $str = "delete from imgs "
            ."where img_id = '$img_id' ";
            Log::debug('delete_sql:'.$str);

            $response['status'] = DB::delete($str);
            Log::debug($response['status']);
            
            // コミット
            DB::commit();

        // 例外処理
        } catch (\Throwable $e) {
            Log::debug(__FUNCTION__ .':' .$e);

            DB::rollback();

            $response['status'] = 0;
        // status:OK=1/NG=0
        } finally {

            if($response['status'] == 1){
                Log::debug('status:trueの処理');
                $response['status'] = true;

            }else{
                Log::debug('status:falseの処理');
                $response['status'] = false;
            }
        }

        Log::debug('log_end:' .__FUNCTION__);
        return response()->json($response);
    }
}