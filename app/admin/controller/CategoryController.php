<?php

// 分類管理功能
namespace admin\controller;
use \core\Controller;

class CategoryController extends Controller
{
    // 首頁顯示所有分類
    public function index(){
        // 獲取所有無限極分類訊息
        $c = new \admin\model\CategoryModel();
        $categories = $c->getAllCategories();

        // 保存session無限極分類比較佔用計算機計算資源
        $_SESSION['categories'] = $categories;

        // 顯示模板
        $this->display('categoryIndex.html');
    }

    // 新增分類： 顯示表單信息
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
        $this->display('categoryAdd.html');
    }
}