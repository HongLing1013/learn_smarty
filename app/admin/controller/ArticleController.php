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
        if($img = \vendor\Uploader::uploadOne($_FILES['img'], UPLOAD_PATH )){
            //圖片上傳成功
            $data['img'] = $img;

            // 製作縮略圖
            $img_thumb = \vendor\Image::makeThumb(UPLOAD_PATH . $img, UPLOAD_PATH);
            if($img_thumb){
                $data['thumb'] = $img_thumb;
            }
        }

        // 入庫
        $a = new \admin\model\ArticleModel();
        if($a->autoInsert($data)){
            //確定圖片是否上傳成功
            if(!$img){
                $this->success("文章新增成功，但圖片上傳失敗，失敗原因：" . \vendor\Uploader::$error, 'index');
            }
            //縮略圖可能出錯
            if($img && !$img_thumb){
                $this->success("文章新增成功，但縮略圖製作失敗，失敗原因：" . \vendor\Image::$error, 'index');
            }
            // 成功
            $this->success('文章：'. $data['title'] . '新增成功' , 'index');
        } else {
            // 失敗：刪除可能上傳成功的圖片
            @unlink(UPLOAD_PATH . $img);
            $this->error('新增失敗' , 'add');
        }
    }

    // 博文列表
    public function index(){
        // 接收可能存在的頁碼
        $page = intval($_REQUEST['page'] ?? 1);
        
        // 判定分頁數據，每頁顯示多少
        global $config;
        $pagecount = $config['admin']['article_pagecount'] ?? 5; // 每頁

        // 接收可能存在的搜尋條件
        $cond = array();

        // 換個判定接收條件
        if(isset($_POST['title']) && !empty($_POST['title'])){
            $cond['title'] = trim($_POST['title']);
        }

        if(isset($_POST['c_id']) && $_POST['c_id'] != 0){
            $cond['c_id'] = intval($_POST['c_id']);
        }

        if(isset($_POST['status']) && $_POST['status'] != 0){
            $cond['status'] = intval($_POST['status']);
        }

        if(isset($_POST['toped']) && $_POST['toped'] != 0){
            $cond['toped'] = intval($_POST['toped']);
        }

        // 添加普通用戶條件
        if(!$_SESSION['user']['is_admin']){
            $cond['u_id'] = $_SESSION['user']['id']; // 當前用戶ID
        }

        // 獲取分類訊息
        if(!isset($_SESSION['categories'])){
            // 如果不存在，則從數據庫中獲取分類
            $c = new \admin\model\CategoryModel();
            $categories = $c->getAllCategories();

            // 保存session無限極分類比較佔用計算機計算資源
            $_SESSION['categories'] = $categories;
        }
        
        // 調用模型獲取數據
        $a = new \admin\model\ArticleModel();
        $articles = $a->getArticleInfo($cond,$pagecount, $page);

        // 獲取滿足條件的紀錄總數
        $counts = $a->getSearchCounts($cond);

        // 調用分頁累產生分頁數據
        $pagestr = \vendor\Page::clickPage(URL."index.php",$counts,$pagecount, $page, $cond);

        // 顯示模板
        $this->assign('pagestr', $pagestr);
        $this->assign('cond', $cond);
        $this->assign('articles', $articles);
        $this->display('articleIndex.html');
    }

    // 刪除部落格
    public function delete(){
        // 接收ID
        $id = intval($_GET['id']);

        // 刪除數據
        $a = new \admin\model\ArticleModel();
        if($a->deleteById($id)){
            $this->success('刪除成功' , 'index');
        } else {
            $this->error('刪除失敗' , 'index');
        }
    }

    // 編輯文章
    public function edit(){
        // 接收數據
        $id = intval($_GET['id']); 
        // 獲取文章訊息
        $a = new \admin\model\ArticleModel();
        $article = $a->getById($id);

        // 判定
        if(!$article){
            $this->error('文章不存在或已被刪除' , 'index');
        }

        // 判定是否需要重新獲取分類
        if(!isset($_SESSION['categories'])){
            // 如果不存在，則從數據庫中獲取分類
            $c = new \admin\model\CategoryModel();
            $categories = $c->getAllCategories();

            // 保存session無限極分類比較佔用計算機計算資源
            $_SESSION['categories'] = $categories;
        }

        // 分配給模板顯示資料
        $this->assign('article', $article); 
        $this->display('articleEdit.html');
    }

    // 編輯文章：更新入庫
    public function update(){
        $id = intval($_POST['id']);
        $data['title'] = trim($_POST['title']);
        $data['c_id'] = intval($_POST['c_id']);
        $data['status'] = intval($_POST['status']);
        $data['toped'] = intval($_POST['toped']);
        $data['content'] = trim($_POST['content']);

        // 合法性驗證
        if(empty($data['title']) || empty($data['content'])){
            $this->error('標題和內容不可為空');
        }

        // 獲取當前id對應原本的資料
        $a = new \admin\model\ArticleModel();
        $article = $a->getById($id);

        // 數據篩選
        $data = array_diff_assoc($data , $article);

        // 判定
        if(empty($data)){
            $this->error('沒有任何修改' , 'index');
        }

        // 要更新內容
        if($a->autoUpdate($id, $data)){
            // 成功
            $this->success('文章更新成功' , 'index');
        } else {
            // 失敗
            $this->back('更新失敗');
        }
    }
}