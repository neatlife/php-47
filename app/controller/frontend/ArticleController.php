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
use app\model\CategoryModel;
use core\Controller;

class ArticleController extends Controller
{
    public function getList()
    {
        $articles = ArticleModel::create()->getAllWithJoin('2 > 1', '`id` ASC', 0, false);
        $categories = CategoryModel::create()
                        ->limitlessLevelCategory(
                            CategoryModel::create()->findAll()
                        );
        $this->s->assign(array(
            'articles' => $articles,
            'categories' => $categories,
        ));
        $this->s->display('frontend/article/getList.html');
    }

    public function detail()
    {
        $id = $_GET['id'];
        // 给id为$id的文章的阅读数+1
        ArticleModel::create()->increaseReadNumber($id);
        $article = ArticleModel::create()->getOneWithJoin($id);
        $this->s->assign(array(
            'article' => $article,
        ));
        $this->s->display('frontend/article/detail.html');
    }

    public function praise()
    {
        $this->denyAccess();

        $id = $_GET['id'];
        // if (id为$id的文章没有赞过) {
        if (!isset($_SESSION["praise_$id"]) || $_SESSION["praise_$id"] != true) {
            ArticleModel::create()->increasePraiseNumber($id);
        //    id为$id的文章已经赞过了
            $_SESSION["praise_$id"] = true;
            $this->redirect("index.php?p=frontend&c=Article&a=detail&id={$id}", "点赞成功。");
        } else {
            // 已经赞过
            $this->redirect("index.php?p=frontend&c=Article&a=detail&id={$id}", "已经赞过了，不能重复点赞。");
        }
    }
}














