<?php
// 命名空間
namespace core;

class Controller{
    // 增加屬性：保存對象
    protected $smarty;
    
    // 構造方法，實現一些只有在控制器中才會執行的代碼
    public function __construct(){
        // 實現smarty的初始化
        // 1. 引入smarty類
        include VENDOR_PATH . 'smarty/Smarty.class.php';
        // 2. 實例化smarty
        $this->smarty = new \Smarty;
        // 3. 設置smarty
        $this->smarty->template_dir = APP_PATH . P . '/view/' . C . '/';
        $this->smarty->caching = false;
        $this->smarty->cache_dir = APP_PATH . P . '/cache';
        $this->smarty->cache_lifetime = 120;
        $this->smarty->compile_dir = APP_PATH . P . '/template_c';

        // 後台權限驗證： 除了privilegeController裡面的方嘎不需要驗證是否登入以外，其他都要驗證
        if(P == 'admin'){
            // 後台，通過SESSION判定用戶是否登入
            @session_start();

            // 判定SESSION
            if(strtolower(C) != 'privilege' && !isset($_SESSION['user'])){
                // 判定用戶是否選擇七天免登入
                if(isset($_COOKIE['id'])){
                    // 幫助用戶登入
                    $u = new \admin\model\UserModel();
                    $user = $u->getById((int)$_COOKIE['id']);

                    // 判定用戶是否存在
                    if($user){
                        // 登入成功
                        $_SESSION['user'] = $user;
                        // 回到用戶訪問介面
                        $this->success("登入成功，歡迎回來！", A , C );
                    }
                }

                // 不是權限控制器也沒有session，表示沒有登入
                $this->error("請先登入!" , "index" , "privilege");
            }
        }
    }

    // 二次封裝smarty的assign和display方法
    protected function assign($key, $value){
        $this->smarty->assign($key, $value);
    }

    protected function display($file){
        $this->smarty->display($file);
    }

    //錯誤與成功的跳轉
    protected function error($msg, $a = A , $c = C, $p = P , $time = 3){
        $refresh = "refresh:{$time};url=index.php?a={$a}&c={$c}&p={$p}";
        header($refresh);
        echo $msg;
        exit;
    }

    protected function success($msg, $a = A , $c = C, $p = P , $time = 3){
        $refresh = "refresh:{$time};url=index.php?a={$a}&c={$c}&p={$p}";
        header($refresh);
        echo $msg;
        exit;
    }
}