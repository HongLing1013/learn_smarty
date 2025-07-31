<?php
// 圖片處理類
namespace vendor;

class Image{
    private static $ext=array(
        "jpg" => "jpeg",
        "jpeg" => "jpeg",
        "png" => "png",
        "gif" => "gif"
    );

    // 紀錄錯誤訊息
    public static $error;

    // 製作縮略圖
    public static function makeThumb($file , $path , $width = 90 , $height = 90){
        // 判定資源有效性
        if(!is_file($file)){
            self::$error = '上傳的文件不存在！';
            return false;
        }

        if(!is_dir($path)){
            self::$error = '縮略圖目錄不存在！';
            return false;
        }

        // 獲取文件訊息，判定是否可製作縮略圖
        $file_info = pathinfo($file);
        $img_info = getimagesize($file);

        if(!array_key_exists($file_info['extension'], self::$ext) && $img_info){
            self::$error = '不支持的圖片格式！';
            return false;
        }

        // 明確原圖資源函數： 打開函數保存函數
        $open = "imagecreatefrom" . self::$ext[$file_info['extension']];
        $save = "image" . self::$ext[$file_info['extension']];

        // 打開圖片資源
        $src = $open($file);
        $thumb = imagecreatetruecolor($width, $height);

        // 背景補白
        $bg_color = imagecolorallocate($thumb, 255, 255, 255);
        imagefill($thumb, 0, 0, $bg_color);

        // 補白計算：計算寬高比率
        $src_b = $img_info[0] / $img_info[1];
        $thumb_b = $width / $height;

        // 原圖寬高大於縮略圖：原圖太寬，縮略圖的寬度要站滿
        if($src_b > $thumb_b){
            // 縮略圖實際寬高
            $w = $width;
            $h = ceil($width / $src_b);

            //縮略圖起始位子
            $x = 0;
            $y = ceil(($height - $h) / 2);
        } else {
            // 原圖寬高比小於縮略圖：原圖太高，縮略圖的高度要站佔滿
            $w = ceil($height * $src_b);
            $h = $height;

            $x = ceil(($width - $w) / 2);
            $y = 0;
        }

        // 複製合併：縮略圖
        if(!imagecopyresampled($thumb, $src, $x, $h, 0, 0, $w, $h, $img_info[0], $img_info[1])){
            // 採樣複製失敗
            self::$error = '縮略圖製作失敗！';
            return false;
        }

        // 保存縮略圖
        $res = $save($thumb, $path . 'thumb_' . $file_info['basename']);
        
        // 銷毀資源
        imagedestroy($src);
        imagedestroy($thumb);

        //判定結果
        if($res){
            return 'thumb_' . $file_info['basename'];
        }else{
            // 保存失敗
            self::$error = '縮略圖保存失敗！';
            return false;
        }
    }
}