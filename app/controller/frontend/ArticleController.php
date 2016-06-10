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
use app\model\CommentModel;

class ArticleController extends Controller
{
    public function getList()
    {
        $articles = ArticleModel::create()->getAllWithJoin('2 > 1', '`id` ASC', 0, false);
        $categories = CategoryModel::create()
                        ->limitlessLevelCategory(
                            CategoryModel::create()->findAll()
                        );
        $this->loadHtml('article/getList', array(
            'articles' => $articles,
            'categories' => $categories,
        ));
    }

    public function detail()
    {
        $id = $_GET['id'];
        // 给id为$id的文章的阅读数+1
        ArticleModel::create()->increaseReadNumber($id);
        $article = ArticleModel::create()->getOneWithJoin($id);
        // 将文章的所有评论查询出来
        $comments = CommentModel::create()->limitlessLevel(
            CommentModel::create()->getAllWithJoinUserByArticleId($id)
        );
        //print_r($comments);die;
        $this->loadHtml('article/detail', array(
            'article' => $article,
            'comments' => $comments,
        ));
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
            $this->redirect(array('a' => 'detail', 'id' => $id), "点赞成功。");
        } else {
            // 已经赞过
            $this->redirect(array('a' => 'detail', 'id' => $id), "已经赞过了，不能重复点赞。");
        }
    }
}














