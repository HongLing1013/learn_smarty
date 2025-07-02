<?php
// 針對用戶表的模型（後台)
namespace admin\model;
use \core\Model;
include_once '../core/Model.php';

class UserModel extends Model
{
    // 屬性：表存表名（不帶前綴）
    protected $table = 'user';

    // 通過使用者名稱取得使用者資訊
    public function getUserByUsername($username)
    {
        // 防止sql注入，透過特殊符號改變指令
        $username = addslashes($username); // 轉義

        // 組織SQL指令，獲取用戶信息
        $sql = "SELECT * FROM {$this->getTable()} WHERE username = '{$username}' ";
        // 執行SQL指令，並返回結果
        return $this->query($sql);
    }

    // 獲取使用者數量
    public function getCounts(){
        // 組織SQL指令，獲取使用者數量
        $sql = "SELECT COUNT(*) AS c FROM {$this->getTable()}";
        
        // 獲取結果保留下來
        $res = $this->query($sql);

        // 返回結果
        return $res['c'] ?? 0; // 如果沒有結果，則返回0
    }
}
