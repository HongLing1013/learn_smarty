<?php
// 部落格控制器
namespace admin\controller;
use \core\Controller;

class ArticleController extends Controller
{
    // 新增，顯示表單
    public function add(){
        // 比單要顯示所有分類，所以要判斷分類是否存在
        if(!isset($_SESSION['categories'])){
            // 如果不存在，則從數據庫中獲取分類
            $c = new \admin\model\CategoryModel();
            $categories = $c->getAllCategories();

            // 保存session無限極分類比較佔用計算機計算資源
            $_SESSION['categories'] = $categories;
        }

        // 顯示模板
        $this->display('articleAdd.html');
    }

}