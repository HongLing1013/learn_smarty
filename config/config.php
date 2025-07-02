<?php
// 配置文件
return array(
    // 數據庫配置
    'database' => array(
        'type' => 'mysql', // 數據庫類型
        'host' => 'localhost',
        'port' => '3306',
        'user' => 'root',
        'pass' => 'root',
        'charset' => 'utf8',
        'dbname' => 'my_database',
        'prefix' => '' // 表前綴
    ),
    //驅動訊息
    'drivers' => array(),
    // 其他配置
    'system' => array(
        'error_reporting' => 'E_ALL', // 錯誤級別控制，默認顯示所有錯誤
        'display_errors' => 1, // 是否顯示錯誤信息，默認1顯示
    )
);
        