<?php
/**
 * CommentController.php
 * Created by day11.
 * User: 苏小林
 * Date: 2016/6/7
 * Time: 14:53
 */

namespace app\controller\frontend;


use app\model\CommentModel;
use core\Controller;

class CommentController extends Controller
{
    public function add()
    {
        $this->denyAccess();
        $userId = $_SESSION['user']['id'];
        $articleId = $_GET['article_id'];
        $parentId = $_POST['inpRevID'];
        $content = $_POST['txaArticle'];
        $publishTime = time();

        if (CommentModel::create()->add(array(
            'user_id' => $userId,
            'article_id' => $articleId,
            'parent_id' => $parentId,
            'content' => $content,
            'publish_time' => $publishTime,
        ))) {
            // 添加评论成功
            // 返回p=frontend c=Article a=detail id=$articleId
            $this->redirect("index.php?p=frontend&c=Article&a=detail&id={$articleId}", "添加评论成功");
        } else {
            // 添加评论失败
            // 返回p=frontend c=Article a=detail id=$articleId
            $this->redirect("index.php?p=frontend&c=Article&a=detail&id={$articleId}", "添加评论失败");
        }
        // var_dump($articleId, $_POST);die;
    }
}