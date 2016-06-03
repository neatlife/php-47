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
}