<?php
// 測試模型
namespace home\model;
// 引入核心模型類
include CORE_PATH . 'Model.php';
use core\Model;

class TableModel extends Model{
    // 增加表名
    protected $table = "student";
    // 獲取全部數據
    public function getAll(){
        // 構造SQL
        $sql = "SELECT * FROM " . $this->getTable();
        // 返回結果
        return $this->query($sql , true);
    }
    // 獲取表字段
    public function getFields(){
        // 透過desc來獲取表字段信息
        $sql = "desc " . $this->getTable();
        // 執行
        $rows = $this->query($sql , true);
        //循環遍歷
        $fields = array();
        foreach($rows as $row){
            $fields[] = $row['Field'];
        }
        // 返回
        return $fields;
    }
}