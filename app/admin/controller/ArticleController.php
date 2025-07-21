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

    // 新增資料
    public function insert(){
        // 接收資料
        $data = $_POST;
        //合法性判定：標題內容不可為空，分類必須存在
        if(empty($data['title']) || empty($data['content'])){
            $this->error('標題和內容不可為空' , 'add');
        }

        if(array_key_exists($data['c_id'] , $_SESSION['categories']) === false){
            $this->error('分類不存在' , 'add');
        }

        // 補充資料
        $data['u_id'] = $_SESSION['user']['id']; // 當前用戶ID
        $data['author'] = $_SESSION['user']['username']; // 當前用戶名
        $data['time'] = time();

        // 理論上來說應該要先實現文件上傳和縮略圖

        // 入庫
        $a = new \admin\model\ArticleModel();
        if($a->autoInsert($data)){
            // 成功
            $this->success('文章：'. $data['title'] . '新增成功' , 'index');
        } else {
            // 失敗
            $this->error('新增失敗' , 'add');
        }
    }

    // 博文列表
    public function index(){
        // 調用模型獲取數據
        $a = new \admin\model\ArticleModel();
        $articles = $a->getArticleInfo();

        // 顯示模板
        $this->assign('articles', $articles);
        $this->display('articleIndex.html');
    }
}