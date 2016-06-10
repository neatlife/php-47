<?php
/**
 * Created by PhpStorm.
 * User: suxiaolin
 * Date: 16/6/10
 * Time: 下午12:09
 */

namespace app\controller\frontend;


abstract class Controller extends \core\Controller
{
    public function loadHtml($name, $data = array())
    {
        $this->s->assign($data);
        $this->s->display(PLATFORM . DS . $name . '.html');
    }
}