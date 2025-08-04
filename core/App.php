<?php
// 增加命名空間
namespace core;

// 安全判定
if (!defined('ACCESS')) {
    // 非法訪問
    header("location:../public/index.php");
    exit;
}

// 初始化類
class App{
    // 入口方法
    public static function start(){
        // 設置目錄常量
        self::set_path();
        // 配置文件
        self::set_config();
        // 錯誤處理
        self::set_error();
        // 解析URL
        self::set_url();
        // 自動加載
        self::set_autoload();
        // 分發控制器
        self::set_dispatch();   
    }

    // 設置目錄常量
    private static function set_path(){
        define("CORE_PATH", ROOT_PATH . 'core/');
        define("APP_PATH", ROOT_PATH . 'app/');
        define("HOME_PATH", APP_PATH . 'home/');
        define("ADMIN_PATH", APP_PATH . 'admin/');
        define("ADMIN_CONT", ADMIN_PATH . 'controller/');
        define("ADMIN_MODEL", ADMIN_PATH . 'model/');
        define("ADMIN_VIEW", ADMIN_PATH . 'view/');
        define("HOME_CONT", HOME_PATH . 'controller/');
        define("HOME_MODEL", HOME_PATH . 'model/');
        define("HOME_VIEW", HOME_PATH . 'view/');
        define("VENDOR_PATH", ROOT_PATH . 'vendor/');
        define("CONFIG_PATH", ROOT_PATH . 'config/');
        define("UPLOAD_PATH", ROOT_PATH . 'public/uploads/');
        define("URL" , 'http://' . $_SERVER['HTTP_HOST']);
    }

    // 增加錯誤控制方法
    private static function set_error(){
        // 拿配置文件讀取的全局變量
        global $config;

        // 錯誤類型和錯誤處理方式
        @ini_set("error_reporting" , $config['system']['error_reporting']); // E_ALL為系統常量 表示所有錯誤
        @ini_set("display_errors" , $config['system']['display_errors']); // 顯示錯誤訊息
    }

    // 增加配置文件
    private static function set_config(){
        // 設定全局變量保存配置文件
        global $config;
        // 包含配置文件
        $config = include CONFIG_PATH . 'config.php';
    }

    // 解析URL
    private static function set_url(){
        // 取出平台訊息（p）和控制器訊息（c）和方法訊息（a）
        $p = isset($_REQUEST['p']) ? $_REQUEST['p'] : 'home'; //默認訪問前台
        $c = isset($_REQUEST['c']) ? ucfirst($_REQUEST['c']) : 'Index'; //默認訪問IndexController，確保首字母大寫
        $a = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index';

        // 考慮到以上信息可能會在後台序用到（其他類中），所以將其設定為全局變量
        define('P', $p);
        define('C', $c);
        define('A', $a);
    }

    //自動加載方法（自定義方法）
    private static function set_autoload_function($class){
        // $class代表內存中不存在的類（如果項目有命名空間。那麼此時帶著空間路徑） \home\controller\IndexController
        
        // 將類路徑中的反斜線轉換為正斜線
        $class = str_replace('\\', '/', $class);
        
        // 取出類名（不含命名空間）
        $className = basename($class);

        // require_once ROOT_PATH . 'app/home/controller/IndexController.php';
        // 判斷core目錄中的類
        $core_file = CORE_PATH . $className . '.php';
        if (file_exists($core_file)) {
            include_once $core_file;
            return;
        }

        // 判斷app目錄中的類（按完整命名空間路徑）
        $app_file = APP_PATH . $class . '.php';
        if (file_exists($app_file)) {
            include_once $app_file;
            return;
        }

        // 判斷控制器是否存在
        $cont_file = APP_PATH . P . '/controller/' . $className . '.php';
        if (file_exists($cont_file)) {
            include_once $cont_file;
            return;
        }

        // 判斷模型是否存在
        $model_file = APP_PATH . P . '/model/' . $className . '.php';
        if (file_exists($model_file)) {
            include_once $model_file;
            return;
        }

        // 插件加載
        $vendor_file = VENDOR_PATH . $className . '.php';
        if (file_exists($vendor_file)) {
            include_once $vendor_file;
            return;
        }
    }

    // 註冊自動加載方法
    private static function set_autoload(){
        // 利用spl_autoload_register()函數註冊自動加載方法
        spl_autoload_register(array(__CLASS__, 'set_autoload_function'));
    }

    // 分發控制器
    public static function set_dispatch(){
        // 找打前後台 控制器 方法：home\controller\IndexController  
        $p = P;
        $c = C;
        $a = A;

        // 組織合適的空間路徑
        $controller = "\\{$p}\\controller\\{$c}Controller";
        $c = new $controller;
        //var_dump($c);
        //調用方法：最終分發
        $c->$a();
    }
}