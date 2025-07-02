<?php
// 增加入口標記
define("ACCESS", true);

//定義上級目錄常量
define("ROOT_PATH", str_replace( '\\' , '/' , dirname(__DIR__)) . '/');

//加載初始化文件
include ROOT_PATH . 'core/App.php';

//激活初始化
\core\App::start();