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

    // 刪除分類
    public function delete(){
        // 接收資料
        $id = intval($_GET['id']);

        // 判定是否可刪除
        // 1. 有子分類不能刪
        $c = new \admin\model\CategoryModel();
        if($c->getSon($id)){
            // 有子分類
            $this->error('當前分類下有子分類，不能刪除', 'index');
        }

        // 2. 有文章不能刪

        // 可以刪除
        if($c->deleteById($id)){
            // 刪除成功
            $this->success('刪除分類成功', 'index');
        }else{
            // 刪除失敗
            $this->error('刪除分類失敗，請稍後再試', 'index');
        }
    }

    // 編輯分類： 顯示表單信息
    public function edit(){
        // 接收資料
        $id = intval($_GET['id']);

        // 有效性驗證
        if(!array_key_exists($id, $_SESSION['categories'])){
            // 不存在
            $this->error('當前要編輯的分類不存在', 'index');
        }

        // 整理資料（自己及子分類不要）
        $c = new \admin\model\CategoryModel();
        $categories = $c->noLimitCategory($_SESSION['categories'], 0, 0, $id);

        // 分類Id給模板
        $this->assign('id', $id);
        $this->assign('categories', $categories);
        $this->display('categoryEdit.html');
    }

    // 編輯分類：更新數據入庫
    public function update(){
        // 接收資料：陣列接收要更新的資料（可能）
        $id = intval($_POST['id']); 
        $data['name'] = trim($_POST['name']);
        $data['parent_id'] = intval($_POST['parent_id']);
        $data['sort'] = trim($_POST['sort']);

        // 合法性驗證(字符長度限定 mb_strlen)
        if(empty($data['name'])){
            $this->back('分類名稱不能為空');
        }

        // 排序應該是正整數
        if(!is_numeric($data['sort']) || intval($data['sort']) != $data['sort'] || $data['sort'] < 0 || $data['sort'] > PHP_INT_MAX){
            $this->back('排序只能是正整數' );
        }

        // 有效性驗證，當前父分類下是否有同名分類
        $c = new \admin\model\CategoryModel();
        $cat = $c->checkCategoryName($data['parent_id'], $data['name'] , true);

        // 判定
        if($cat && $cat['id'] != $id){
            // 指定的父分類下有一個同名的子分類
            $this->back('當前分類名字在指定父分類下已經存在');
        }

        // 數據更新確定部分判定
        $data = array_diff_assoc($data, $_SESSION['categories'][$id]);
        // 判定數據
        if(empty($data)){
            // 沒有要更新的數據
            $this->error('沒有要更新的數據', 'index');
        }

        // 實現數據更新操作
        if($c->autoUpdate($id, $data)){
            // 更新成功
            $this->success('更新成功', 'index');
        }else{
            // 更新失敗
            $this->error('更新失敗', 'index');
        }
    }
}