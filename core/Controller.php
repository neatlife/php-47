<?php

namespace core;

// 核心控制器
class Controller
{
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

    public function redirect($url, $msg = '', $waitSeconds = 3)
    {
        header('Refresh: ' . $waitSeconds . '; url=' . $url);
        echo $msg;
    }
}





















