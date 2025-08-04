<?php
//分頁工具：不帶數據
namespace vendor;   

class Page{
    // 生成分頁字符串
    public static function clickPage($url , $counts , $pagecount = 5 , $page = 1, $cond = array()){
        // 計算頁碼
        $pages = ceil($counts / $pagecount);
        $prev = $page > 1 ? $page - 1 : 1;
        $next = $page < $pages ? $page + 1 : $pages;

        // 組織條件：路徑條件
        $pathinfo = '';
        foreach($cond as $key => $value) {
            $pathinfo .= $key . '=' . $value . '&';
        }

        // 組織上一頁功能
        $click = "<li><a href='{$url}?{$pathinfo}page={$prev}'>上一頁</a></li>";
        
        //頁碼點擊判定
        if($pages <= 7){
            //有多少頁點多少頁
            for($i = 1; $i <= $pages; $i++){
                $click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
            }
        }else{
            // 頁碼大於七頁
            // 當前選中的頁碼是否小於5
            if($page <= 5){
                for($i =1 ; $i <=7 ; $i ++){
                    $click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
                }

                // 追加...
                $click .= "<li><a href='#'>...</a></li>";
            }else{
                // 大於5頁,固定顯示前兩頁
                $click .= "<li><a href='{$url}?{$pathinfo}page=1'>1</a></li>";
                $click .= "<li><a href='{$url}?{$pathinfo}page=2'>2</a></li>";
                $click .= "<li><a href='#'>...</a></li>";

                // 顯示中間對應5頁
                // 判定是否是最後三頁
                if($pages - $page <= 3){
                    for($i = $page - 4; $i <= $page; $i++){
                        $click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
                    }
                }else{
                    // 選擇的5頁在中間  
                    for($i = $page - 2; $i <= $page + 2; $i++){
                        $click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
                    }

                    // 追加...
                    $click .= "<li><a href='#'>...</a></li>";
                }
            }
        }

        //補充下一頁功能
        $click .= "<li><a href='{$url}?{$pathinfo}page={$next}'>下一頁</a></li>"; 

        // 返回
        return $click;
    }
}