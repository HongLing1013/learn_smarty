<?php
// 公共模型
namespace core;
require_once __DIR__ . '/Dao.php';

class Model {
    // 屬性，保存Dao對象
    protected $dao;
    // 保存當前表的所有字段，額外多出一個主鍵字段
    protected $fields;

    // 實例化
    public function __construct() {
        // 加載配置文件
        global $config;
        // 實例化Dao
        // $this->dao = new Dao($config['database'], $config['driver']);
        $this->dao = new Dao($config['database'], []);
        // 初始化字段信息
        $this->getFields();
    }

    // 寫方法
    protected function exec(string $sql) {
        return $this->dao->dao_exec($sql);
    }

    // 獲取ID
    public function getLastId() {
        return $this->dao->dao_last_id();
    }

    // 讀方法
    protected function query(string $sql, $all = false) {
        return $this->dao->dao_query($sql, $all);
    }

    // 構造全表名
    protected function getTable(string $table = "") {
        // 構造前綴
        global $config;
        // 確定表名字
        $table = empty($table) ? $this->table : $table;
        // 構造全名（添加反引號轉義）
        return $config['database']['prefix'] . "`" . $table . "`";
    }

    // 獲取全部數據，當前表
    protected function getAll() {
        // 構造SQL
        $sql = "SELECT * FROM " . $this->getTable();
        // 返回結果
        return $this->query($sql, true);
    }
    
    // 獲取表字段
    private function getFields() {
        // 透過desc來獲取表字段信息
        $sql = "desc " . $this->getTable();
        // 執行
        $rows = $this->query($sql, true);
        // 循環遍歷
        foreach($rows as $row) {
            // 保存字段
            $this->fields[] = $row['Field'];
            // 判斷是否為主鍵
            if($row['Key'] == 'PRI') {
                $this->fields['Key'] = $row['Field'];
            }
        }
    }

    // 通過主鍵獲取紀錄
    public function getById($id) {
        //  判定，當前表是否有主鍵
        if(!isset($this->fields['Key'])) return false;
        // 構造SQL
        $sql = "SELECT * FROM " . $this->getTable() . " WHERE " . $this->fields['Key'] . " = " . $id;
        // 執行
        return $this->query($sql);
    }

    // 根據key刪除紀錄
    public function deleteById($id) {
        // 判定，當前表是否有主鍵
        if(!isset($this->fields['Key'])) return false;
        // 構造SQL
        $sql = "DELETE FROM {$this->getTable()} WHERE {$this->fields['Key']} = " . $id;
        // 執行
        return $this->exec($sql);
    }

    // 自動更新數據
    public function autoUpdate($id , $data){
        // 確定where條件
        $where = " WHERE {$this->fields['Key']} = '{$id}'";

        //組織更新指令（內容）
        $sql = "UPDATE {$this->getTable()} SET ";
        //循環遍歷所有要更新的內容
        foreach($data as $key => $value){
            $sql .= "`{$key}` = '{$value}', ";
        }

        // 去掉最後的逗號
        $sql = rtrim($sql, ', ') . $where;

        // 執行
        return $this->exec($sql);
    }
}