<?php
/**
 * CommentModel.php
 * Created by day11.
 * User: 苏小林
 * Date: 2016/6/3
 * Time: 11:55
 */

namespace app\model;

use core\Model;

class CommentModel extends Model
{
    protected $table = 'comment';

    public function getAllWithJoin()
    {
        $sql = "SELECT `comment`.*, `user`.`username`, `article`.`title`, a.`content` AS parent_content
                      FROM `comment`
                      LEFT JOIN `user` ON `comment`.`user_id`=`user`.`id`
                      LEFT JOIN `article` ON `comment`.`article_id`=`article`.`id`
                      LEFT JOIN `comment` AS a ON `comment`.`parent_id`=a.`id`";
        return $this->getAll($sql);
    }
}