<?php
/**
 * ArticleController.php
 * Created by day11.
 * User: 苏小林
 * Date: 2016/6/6
 * Time: 16:11
 */

namespace app\controller\frontend;


use app\model\ArticleModel;
use core\Controller;

class ArticleController extends Controller
{
    public function getList()
    {
        $articles = ArticleModel::create()->getAllWithJoin();
        var_dump($articles);die;
    }
}