<?php
// 分類模型
namespace admin\model;
use \core\Model;

class CategoryModel extends Model
{
    // 屬性：保存表名
    protected $table = 'category';

    // 獲取所有分類訊息
    public function getAllCategories()
    {
        // 組織 SQL 語句
        $sql = "SELECT * FROM {$this->table} ORDER BY sort DESC";

        // 獲取結果
        $categories = $this->query($sql,true);

        // 進行無限極分類加工
        return $this->noLimitCategory($categories);
    }

    // 無限極分類
    public function noLimitCategory($categories ,$parent_id = 0, $level = 0)
    {
        // 定義一個空數組
        $list = array();

        // 遍歷所有分類，獲取滿足要求的結果
        foreach($categories as $cat){
            // 匹配條件
            if($cat['parent_id'] == $parent_id){
                // 增加level信息
                $cat['llevel'] = $level;
                // 當前需要的分類
                $list[$cat['id']] = $cat;
            }
        }
        // 反為需要的結果
        return $list;
    }
}
