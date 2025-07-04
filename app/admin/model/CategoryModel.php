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
        static $list = array();

        // 遍歷所有分類，獲取滿足要求的結果
        foreach($categories as $cat){
            // 匹配條件
            if($cat['parent_id'] == $parent_id){
                // 增加level信息
                $cat['level'] = $level;
                // 當前需要的分類
                $list[$cat['id']] = $cat;

                // 當前分類$cat可能有子分類，遞歸
                $this->noLimitCategory($categories, $cat['id'], $level + 1);
            }
        }
        // 返回需要的結果
        return $list;
    }

    // 驗證付分類下是否有指定名字的分類（根據名字獲取分類訊息）
    public function checkCategoryName($parent_id, $name)
    {
        // 組織 SQL 語句
        $sql = "SELECT `id` FROM {$this->table} WHERE parent_id = {$parent_id} AND name = '{$name}'";

        // 獲取結果
        $result = $this->query($sql);

        // 判斷是否存在
        return !empty($result);
    }

    // 新增分類
    public function insertCategory($name, $parent_id, $sort)
    {
        // 組織 SQL 語句
        $sql = "INSERT INTO {$this->table} VALUES (null , '{$name}', {$sort} , {$parent_id})";

        // 執行 SQL 語句
        return $this->exec($sql);
    }

    // 獲取子分類
    public function getSon($id)
    {
        // 驗整：有沒有分類的父分累id是當前分類的id
        $sql = "SELECT id FROM {$this->table} WHERE parent_id = {$id}";
        //返回執行結果
        return $this->query($sql);
    }
}
