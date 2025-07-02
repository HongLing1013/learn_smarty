<?php
// 後台首頁功能
namespace admin\controller;

include_once '../core/Controller.php';
use \core\Controller;

class IndexController extends Controller
{
    // 獲取首頁頁面
    public function index()
    {
        // 獲取用戶數量
        $u = new \admin\model\UserModel();
        $counts = $u->getCounts();

        // 開啟session
        @session_start(); // 前面加一個錯誤抑制符

        // 加載首頁模板
        $this->assign("counts" , $counts); // 分配變量到模板
        $this->display("index.html");
    }
}