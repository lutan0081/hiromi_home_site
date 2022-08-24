<?php
namespace App\Common;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;

class Common
{   
    // 投稿種別
    public function getPostType(){
        Log::debug('log_start:'.__FUNCTION__);

        $str = "select * from post_types "
        ."order by post_type_id asc ";

        $ret = DB::select($str);

        Log::debug('log_end:'.__FUNCTION__);
        return $ret; 
    }

    // 施工事例種別
    public function getImgType(){
        Log::debug('log_start:'.__FUNCTION__);

        $str = "select * from img_types "
        ."order by sort_id asc ";

        $ret = DB::select($str);

        Log::debug('log_end:'.__FUNCTION__);
        return $ret; 
    }

    /**
     * 日付fフォーマット(年月日)
     * {{ Common::format_date($update->create_date,'Y年m月d日') }}
     * @return return date('Y/m/d', strtotime($date));
     */
    public static function format_date($date, $format='Y/m/d'){
        return date($format, strtotime($date));
    }

    // 年月日
    public static function format_date_jp($date){
        return self::format_date($date,'Y年m月d日');
    }

    // 年月日時分
    public static function format_date_min($date){
        return self::format_date($date,'Y年m月d日H時i分');
    }

    // 年-月-日
    public static function format_date_hy($date){
        return self::format_date($date,'Y-m-d');
    }

    // 数値を三桁区切り
    public static function format_three_digit_separator($money){
        return number_format($money);
    }

    // 文字コードのエンコード・カンマ・余白除去
    public static function format_csv_colmun($val){

        $val = trim(mb_convert_encoding($val, 'UTF-8', 'SJIS'));
        $val = str_replace(',','', $val);
        $val = str_replace('\\','', $val);

        return $val;
    }

    // 文字コードのエンコード・カンマ・余白除去
    public static function format_csv_date($val){

        $val = trim(mb_convert_encoding($val, 'UTF-8', 'SJIS'));
        $val = str_replace(',','', $val);
        $val = str_replace('年','/', $val);
        $val = str_replace('月','/', $val);
        $val = str_replace('日','', $val);

        return $val;
    }

}