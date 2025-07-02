<?php
// 命名空間
namespace home\controller;
// 引入核心控制器類
include CORE_PATH . 'Controller.php';
use \core\Controller;

class IndexController extends Controller{
    // 首頁方法
    public function index(){
        // 調用模型
        $m = new \home\model\TableModel();
        $res = $m->getById(1);
        $this->assign('res', $res);
        $this->display('index.html');
    }
}