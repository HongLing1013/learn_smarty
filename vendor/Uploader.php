<?php
// 文件上傳
namespace vendor;

class Uploader {
    // 設定屬性：保存允許上傳的MIME類型
    private static $type = array('image/gif', 'image/jpeg', 'image/png', 'image/bmp', 'image/webp');

    //修改類型方法
    public static function setTypes(array $types = array()) {
        //判定是否為空
        if(!empty($types)){
            self::$type = $types;
        }
    }

    // 單文件上傳
    public static $error; // 紀錄上傳過程中出現的錯誤
    public static function uploadOne(array $file, string $path,int $max = 2000000){
        // 判定文件有效性
        if(isset($file['error']) || count($file) != 5){
            self::$error = '錯誤的上傳文件！';
            return false;
        }

        //判定路徑
        if(!is_dir($path)){
            self::$error = '上傳目錄不存在！';
            return false;
        }

        //判定文件是否正確上傳
        switch($file['error']){
            case 1:
            case 2:
                self::$error = '上傳的文件過大！';
                return false;
            case 3:
                self::$error = '文件上傳不完整！';
                return false;
            case 4:
                self::$error = '沒有選擇上傳文件！';
                return false;
            case 6:
            case 7:
                self::$error = '服務器錯誤，請稍後再試！';
                return false;
        }

        // 判定文件類型
        if(!in_array($file['type'], self::$type)){
            self::$error = '不支持的文件類型！';
            return false;
        }

        // 判定文件大小
        if($file['size'] > $max){
            self::$error = '上傳的文件過大！允許的大小為:' . (string) ($max / 100000) . 'MB';
            return false;
        }

        // 獲取隨機名字
        $filename = self::getRandomName($file['name']);

        // 移動上傳文件到指定目錄
        if(move_uploaded_file($file['tmp_name'], $path . '/' . $filename)){
            // 成功
            return $filename;
        }else{
            // 失敗
            self::$error = '文件上傳失敗！';
            return false;
        }
    }

    // 增加方法獲取隨機文件名
    private static function getRandomName($filename , $prefix = 'image') {
        // 獲取文件擴展名
        $ext =strrchr($filename, '.');

        // 構建新名字
        $newname = $prefix . date('YmdHis') ;

        //增加隨機字符(6位大寫字母)
        for($i = 0; $i < 6; $i++){
            $newname .= chr(rand(65, 90));
        }

        //返回最終結果
        return $newname . $ext;
    }
}