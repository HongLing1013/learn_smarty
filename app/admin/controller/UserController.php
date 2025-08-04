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
}