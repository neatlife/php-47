<?php

namespace core;
use vendor\Smarty;

// 核心控制器
class Controller
{
    protected $s;

    protected function initSmarty()
    {
        $s = new Smarty();

        // smarty不认识< >怎么让它认识？
        // 1. 设置smarty左定界符
        $s->left_delimiter = '<{';
        // 2. 设置smarty右定界符
        $s->right_delimiter = '}>';

        // templates 目录改为 view 目录之后，Smarty找不到templates目录了怎么？
        // 将Smarty默认的模版目录从templates目录修改为view
        $s->setTemplateDir(VIEW_PATH);
        // 自定义编译文件目录,将文件放到系统的临时目录里
        // sys_get_temp_dir();
        $s->setCompileDir(sys_get_temp_dir() . DS . 'view_c');
        // 自定义缓存文件目录,将缓存文件放到系统的临时目录里
        $s->setCacheDir(sys_get_temp_dir() . DS . 'cache');
        // 自定义配置文件目录
        $s->setConfigDir(CONFIG_PATH);

        $this->s = $s;
    }

    public function __construct()
    {
        $this->initSmarty();
    }

    protected function denyAccess()
    {
        if (isset($_SESSION['loginFlag']) && ($_SESSION['loginFlag'] == true)) {

        } else {
            // 验证没通过
            $this->redirect('index.php?p=backend&c=User&a=login', '请登录。');
            exit(0);
        }
    }

    protected function loadHtml($name, $data = array())
    {
        foreach($data as $variableName => $variableValue) {
            $$variableName = $variableValue;
        }
        require VIEW_PATH . DS . PLATFORM . DS . $name . '.html';
    }

    public function redirect($url, $msg = '', $waitSeconds = 3, $type = 1)
    {
        if (is_array($url)) {
            if (!isset($url['p'])) {
                $url['p'] = PLATFORM;
            }
            if (!isset($url['c'])) {
                $url['c'] = CONTROLLER;
            }
            if (!isset($url['p'])) {
                $url['a'] = ACTION;
            }
            $url = '?' . http_build_query($url);
        }
        if ($type == 1) {
            require VIEW_PATH . DS . 'redirect.html';
        } else {
            header('Refresh: ' . $waitSeconds . '; url=' . $url);
            echo $msg;
        }
    }
}





















