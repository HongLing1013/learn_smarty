<?php
// 後台用戶管理
namespace admin\controller;
use \core\Controller;

class UserController extends Controller
{
    // 新增用戶：顯示表單
    public function add()
    {
        // 顯示筆單
        $this->display("userAdd.html");
    }

    // 新增用戶：處理表單提交
    public function insert()
    {
        // 獲取表單數據
        $data = $_POST;
        // 合法性驗證
        if(empty(trim($data['username'])) || empty(trim($data['password']))) {
            $this->error("用戶名和密碼不能為空" , "add");
        }

        // 驗證合理性
        $u = new \admin\model\UserModel();
        if($u->checkUsername($data['username'])) {
            $this->error("用戶名".$data['username']."已存在", "add");
        }

        // 用戶名可以用，寫入資料庫
        $data['reg_time'] = time();
        $data['password'] = md5($data['password']); // 密碼加密

        if($u->autoInsert($data)) {
            // 寫入成功
            $this->success("用戶添加成功", "index");
        } else {
            // 寫入失敗
            $this->error("用戶添加失敗", "add");
        }
    }

    // 顯示所有用戶信息
    public function index(){
        //獲取所有用戶
        $u = new \admin\model\UserModel();
        $users = $u->getAllUsers();
        
        $this->assign("users", $users);
        $this->display("userIndex.html");
    }
}