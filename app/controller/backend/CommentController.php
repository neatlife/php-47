<?php
/**
 * CommentController.php
 * Created by day11.
 * User: 苏小林
 * Date: 2016/6/3
 * Time: 11:51
 */

namespace app\controller\backend;


use app\model\CommentModel;
use core\Controller;

class CommentController extends Controller
{
    public function getList()
    {
        $comments = CommentModel::create()->getAllWithJoin();
        return $this->loadHtml('comment/getList', array(
            'comments' => $comments,
        ));
    }

    public function delete()
    {
        $id = $_GET['id'];
        if (CommentModel::create()->deleteById($id)) {
            return $this->redirect('index.php?p=backend&c=Comment&a=getList', '删除成功');
        } else {
            return $this->redirect('index.php?p=backend&c=Comment&a=getList', '删除失败。');
        }
    }
}