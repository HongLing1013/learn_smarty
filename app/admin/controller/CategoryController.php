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

    // 新增分類數據庫
    public function insert(){
        // 接收資料
        $name = trim($_POST['name']);
        $parent_id = intval($_POST['parent_id']);
        $sort = trim($_POST['sort']);
        
        // 合法性驗證(字符長度限定 mb_strlen)
        if(empty($name)){
            $this->error('分類名稱不能為空' , 'add');
        }

        // 排序應該是正整數
        if(!is_numeric($sort) || intval($sort) != $sort || $sort < 0 || $sort > PHP_INT_MAX){
            $this->error('排序只能是正整數' , 'add');
        }

        // 有效性驗證，當前付分類下是否有同名分類
        $c = new \admin\model\CategoryModel();
        if($c->checkCategoryName($parent_id, $name)){
            // 已經存在
            $this->error('當前分類名字：' . $name . '已經存在', 'add');
        }

        // 儲存數據
        if($c->insertCategory($name, $parent_id, $sort)){
            // 新增成功
            $this->success('新增分類成功', 'index');
        }else{
            // 失敗
            $this->error('新增分類失敗，請稍後再試', 'add');
        }
    }
}