<?php
// 公共模型
namespace core;

// 引入全局空間類,PDO三類
use PDO;
use PDOStatement;
use PDOException;

// 定義Dao類
class Dao {
    // 屬性
    private $pdo;
    private $fetch_mode;

    // 構造方法
    public function __construct($info = array(), $drivers = array()) {
        $type = $info['type'] ?? "mysql";
        $host = $info['host'] ?? "localhost";
        $port = $info['port'] ?? "3306";
        $user = $info['user'] ?? "root";
        $pass = $info['pass'] ?? "root";
        $dbname = $info['dbname'] ?? "my_database";
        $charset = $info['charset'] ?? "utf8";
        $this->fetch_mode = $info['fetch_mode'] ?? PDO::FETCH_ASSOC;

        // 驅動控制，異常模式處理
        $drivers[PDO::ATTR_ERRMODE] = $drivers[PDO::ATTR_ERRMODE] ?? PDO::ERRMODE_EXCEPTION;

       // 實例化PDO
        try {
            $this->pdo = new PDO("$type:host=$host;port=$port;dbname=$dbname;charset=$charset", $user, $pass, $drivers);
        } catch(PDOException $e) {
            echo "連接錯誤! <br>";
            echo "錯誤文件為： " . $e->getFile() . "<br>";
            echo "錯誤行號為： " . $e->getLine() . "<br>";
            echo "錯誤信息為： " . $e->getMessage() . "<br>";
            exit;
        }

        // 設定字符集
        try {
            $this->pdo->exec("set names $charset");
        } catch(PDOException $e) {
            $this->dao_exception($e);
        }
    }

    // SQL執行錯誤的異常處理
    private function dao_exception(PDOException $e) {
        echo "SQL執行錯誤! <br>";
        echo "錯誤文件為： " . $e->getFile() . "<br>";
        echo "錯誤行號為： " . $e->getLine() . "<br>";
        echo "錯誤描述為： " . $e->getMessage() . "<br>";
        die();
    }

    // 寫方法
    public function dao_exec($sql) {
        // 執行SQL
        try {
            // $res = $this->pdo->exec($sql);
            return $this->pdo->exec($sql);
        } catch(PDOException $e) {
            $this->dao_exception($e);
        }
    }

    // 獲取字增長ID
    public function dao_last_id() {
        return $this->pdo->lastInsertId();
    }

    // 讀取方法：二合一 （一條與多條，默認一條）
    public function dao_query($sql, $all = false) {
        try {
            $stmt = $this->pdo->query($sql);
            // 設置fetch_mode
            $stmt->setFetchMode($this->fetch_mode);

            // 解析數據
            if(!$all) {
                // 考慮到可能查不到有效結果，要進行異常處理
                return $stmt->fetch();
            } else {
                return $stmt->fetchAll();
            }
        } catch(PDOException $e) {
            $this->dao_exception($e);
        }
    }
}





//  ///////////////////









// namespace core;

// // 引入全局空間類,PDO三類
// // use \PDO, \PDOStatement, \PDOException;
// use PDO;
// use PDOStatement;
// use PDOException;

// // 定義Dao類
// class Dao{
//     // 屬性
//     private $pdo;
//     private $fetch_mode;

//     // 構造方法
//     public function __construct($info = array() , $drivers = array()){
//         $type = $info['type'] ?? 'mysql';
//         $host = $info['host'] ?? 'localhost';
//         $port = $info['port'] ?? '3306';
//         $user = $info['user'] ?? 'root';
//         $pass = $info['pass'] ?? 'root';
//         $dbname = $info['dbname'] ?? 'my_database';
//         $charset = $info['charset'] ?? 'utf8';
//         $this->fetch_mode = $info['fetch_mode'] ?? PDO::FETCH_ASSOC;

//         // 驅動控制，異常模式處理
//         $drivers[PDO::ATTR_ERRMODE] = $drivers[PDO::ATTR_ERRMODE] ?? PDO::ERRMODE_EXCEPTION;

//         // 實例化PDO
//         try{
//             $this->pdo = new PDO("$type:host=$host;port=$port;dbname=$dbname;charset=$charset" , $user , $pass , $drivers);
//         }catch(PDOException $e){
//             echo "連接錯誤! <br>";
//             echo "錯誤文件為： " . $e->getFile() . "<br>";
//             echo "錯誤行號為： " . $e->getLine() . "<br>";
//             echo "錯誤信息為： " . $e->getMessage() . "<br>";
//             exit;
//         }

//         // 設定字符集
//         try{
//             $this->pdo->exec("set names $charset");
//         }catch(PDOException $e){
//             // echo "設定字符集錯誤! <br>";
//             // echo "錯誤文件為： " . $e->getFile() . "<br>";
//             // echo "錯誤行號為： " . $e->getLine() . "<br>";
//             // echo "錯誤信息為： " . $e->getMessage() . "<br>";
//             // exit;
            
//             // 調用異常處理方法
//             $this->dao_exception($e);
//         }
//     }

//     // SQL執行錯誤的異常處理
//     private function dao_exception(PDOException $e){
//         echo "SQL執行錯誤! <br>";
//         echo "錯誤文件為： " . $e->getFile() . "<br>";
//         echo "錯誤行號為： " . $e->getLine() . "<br>";
//         echo "錯誤描述為： " . $e->getMessage() . "<br>";
//         die();
//     }

//     // 寫方法
//     public function dao_exec($sql){
//         // 執行SQL
//         try{
//             $res = $this->pdo->exec($sql);
//         }catch(PDOException $e){
//             $this->dao_exception($e);
//         }
//     }

//     // 獲取字增長ID
//     public function dao_last_id(){
//         return $this->pdo->lastInsertId();
//     }

//     // 讀取方法：二合一 （一條與多條，默認一條）
//     public function dao_query($sql , $all = false){
//         try{
//             $stmt = $this->pdo->query($sql);

//             // 設置fetch_mode
//             $stmt->setFetchMode($this->fetch_mode);

//             // 解析數據
//             if(!$all){
//                 // 考慮到可能查不到有效結果，要進行異常處理
//                 return $stmt->fetch();
//             }else{
//                 return $stmt->fetchAll();
//             }
//         }catch(PDOException $e){
//             $this->dao_exception($e);
//         }
//     }

// }