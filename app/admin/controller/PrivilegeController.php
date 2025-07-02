<?php
// 權限管理
namespace admin\controller;

include_once '../core/Controller.php';
use \core\Controller;

class PrivilegeController extends Controller
{
    // 獲取登入表單頁面
    public function index()
    {
        // 加載登錄表單模板
        $this->display("login.html");
    }

    // 驗證使用者信息
    public function check(){
        // 引入Captcha類
        include_once '../vendor/Captcha.php';
        
        $username = trim($_POST['u_username']);
        $password = trim($_POST['u_password']);
        $captcha = trim($_POST['captcha']);

        // 驗證驗證碼的合法性
        if(empty($captcha)){
            $this->error("驗證碼不可為空" , 'index');
        }

        // 合法性驗證
        if(empty($username) || empty($password)){
            // 提醒用戶沒輸入訊息
        $this->error("帳號和密碼不可為空" , 'index');
        }

        // 驗證captcha
        if(!\vendor\Captcha::checkCaptcha($captcha)){
            // 提示驗證碼錯誤
            $this->error("驗證碼錯誤" , 'index');
        }

        // 驗證用戶名是否存在
        $u = new \admin\model\UserModel();
        $user = $u->getUserByUsername($username);

        // 判定使用者是否存在
        if(!$user){
            // 提示用戶不存在
            $this->error("使用者 : {$username} 不存在 ! " , 'index');
        }

        // 使用者密碼驗證
        if($user['password'] !== md5($password)){
            // 提示用戶密碼錯誤
            $this->error("使用者 : {$username} 密碼錯誤 ! " , 'index');
        }

        // 將使用者登入信息存入session
        @session_start(); // 前面加一個錯誤抑制符
        $_SESSION['user'] = $user;

        // 7天免登入
        if(isset($_POST['rememberMe'])){
            // 用戶選擇記住用戶信息
            setcookie( 'id' , $user['id'] , time() + 7 * 24 * 3600); // 7天
        }

        // 登入成功跳轉首頁
        $this->success("登入成功 ! " , 'index' , 'Index'); // 第三個參數是控制器
    }

    // 退出系統
    public function logout(){
        // 刪除session
        session_destroy();

        // 清除可能存在的cookie
        setcookie('id', '', 1);

        // 提示：退出成功
        $this->success("退出成功 ! " , 'index' );
    }

    // 獲取驗證碼圖片
    public function captcha()
    {
        @session_start();

        // 引入Captcha類
        include_once '../vendor/Captcha.php';

        // 獲取驗證碼圖片
        \vendor\Captcha::getCaptcha();
    }
}