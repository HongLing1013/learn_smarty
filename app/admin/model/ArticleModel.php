<?php
// 文字模型
namespace admin\model;
use \core\Model;

class ArticleModel extends Model
{
    // 屬性：保存表名
    protected $table = 'article';

    // 分頁獲取文章基本訊息
    public function getArticleInfo($cond = array() , $pagecount = 5 , $page = 1){
        // 基礎條件： 文章沒有被刪除
        $where = " WHERE is_delete = 0 ";

        // 條件組織
        foreach($cond as $k => $v){
            // k代筆字段名v代表條件值
            switch($k){
                case 'title':
                    $where .= " AND title LIKE '%{$v}%' ";
                    break;
                case 'c_id':
                case 'u_id':
                case 'status':
                case 'toped':
                    $where .= " AND {$k} = {$v} ";
                    break;
                default:
                    break;
            }
        }

        // 求出分頁起始位子
        $offset = ($page - 1) * $pagecount;

        // 組織sql指令
       $sql = "SELECT id,title,c_id,time,status,author,u_id,toped FROM {$this->table} {$where} ORDER BY time DESC LIMIT {$offset} , {$pagecount}";
       
        // 執行sql指令
        return $this->query($sql,true);

    }
    // 獲取滿足條件的紀錄總數
    public function getSearchCounts($cond = array()){
        // 基礎條件： 文章沒有被刪除
        $where = " WHERE is_delete = 0 ";

        // 條件組織
        foreach($cond as $k => $v){
            // k代筆字段名v代表條件值
            switch($k){
                case 'title':
                    $where .= " AND title LIKE '%{$v}%' ";
                    break;
                case 'c_id':
                case 'u_id':
                case 'status':
                case 'toped':
                    $where .= " AND {$k} = {$v} ";
                    break;
                default:
                    break;
            }
        }

        // 組織sql指令
        $sql = "SELECT COUNT(*) AS c FROM {$this->table} {$where}";
        
        //取出結果
        $res = $this->query($sql);
        return $res['c'] ?? 0; // 直接訪問 $res['c']
        return $res[0]['c'] ?? 0; // 返回滿足條件的紀錄總數
    }
}