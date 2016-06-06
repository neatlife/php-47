<?php
/**
 * TestController.php
 * Created by day11.
 * User: 苏小林
 * Date: 2016/6/6
 * Time: 11:32
 */

namespace app\controller\frontend;


use core\Controller;

class TestController extends Controller
{
    public function test()
    {
        var_dump($this->s);
    }
}