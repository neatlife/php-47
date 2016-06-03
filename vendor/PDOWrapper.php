<?php

namespace vendor;

use PDO;
use PDOException;

//封装PDO类
class PDOWrapper
{
    //属性是用来保存数据，保存需要跨方法使用的数据
    private $type;
    private $host;
    private $port;
    private $user;
    private $pass;
    private $dbname;
    private $charset;
    private $pdo;       //保存对象的

    //构造方法：初始化数据库连接等信息
    public function __construct($config = array())
    {
        //数据库基本信息初始化
        $this->type = isset($config['type']) ? $config['type'] : 'mysql';
        $this->host = isset($config['host']) ? $config['host'] : 'localhost';
        $this->port = isset($config['port']) ? $config['port'] : '3306';
        $this->user = isset($config['user']) ? $config['user'] : 'root';
        $this->pass = isset($config['pass']) ? $config['pass'] : '';
        $this->dbname = isset($config['dbname']) ? $config['dbname'] : 'project';
        $this->charset = isset($config['charset']) ? $config['charset'] : 'utf8';

        //连接认证
        $this->connect();

        //异常处理
        $this->exception();
    }

    //设定错误处理模式为异常模式
    private function exception()
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    //连接认证
    private function connect()
    {
        //PDO类对象需要在别的方法里使用
        try{
            //PDO中唯一自动走异常的
            $this->pdo = new PDO("{$this->type}:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}",$this->user,$this->pass);
        }catch(PDOException $e){
            echo '数据库连接认证失败！<br/>';
            echo '错误编号是：' . $e->getCode() . '<br/>';
            echo '错误行号是：' . $e->getLine() . '<br/>';
            echo '错误文件是：' . $e->getFile() . '<br/>';
            echo '错误信息是：' . $e->getMessage() . '<br/>';
            exit;
        }
    }

    //增删改方法
    //@param1 string $sql要执行的写操作SQL指令
    //@return int 受影响的行数
    public function exec($sql)
    {
        //利用PDO执行SQL指令
        try{
            //执行
            return $this->pdo->exec($sql);
        }catch(PDOException $e){
            //调用错误信息处理方法
            $this->error($e);
        }

    }

    //获取自增长ID
    public function insert_id()
    {
        //调用PDO对象的lastInsertID获取
        return $this->pdo->lastInsertID();
    }

    //查询一条数据
    //@param1 string $sql
    //@return 关联数组或者false
    public function getOne($sql)
    {
        //利用PDO执行SQL指令
        try{
            //执行
            $stmt = $this->pdo->query($sql);

            //解析
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            //调用错误信息处理方法
            $this->error($e);
        }
    }

    //查询多条数据
    //@param1 string $sql
    //@return 二位数组
    public function getAll($sql)
    {
        //利用PDO执行SQL指令
        try{
            //执行
            $stmt = $this->pdo->query($sql);

            //解析
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            //调用错误信息处理方法
            $this->error($e);
        }
    }

    //错误处理方法
    //@param1 object $e,异常对象
    //@return 理论上应该有返回，暴力终止
    private function error($e)
    {
        echo 'SQL指令出错！<br/>';
        echo '错误编号是：' . $e->getCode() . '<br/>';
        echo '错误行号是：' . $e->getLine() . '<br/>';
        echo '错误文件是：' . $e->getFile() . '<br/>';
        echo '错误信息是：' . $e->getMessage() . '<br/>';
        exit;
    }
}