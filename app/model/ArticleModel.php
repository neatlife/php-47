<?php
/**
 * ArticleModel.php
 * Created by day11.
 * User: 苏小林
 * Date: 2016/6/1
 * Time: 14:57
 */

namespace app\model;


class ArticleModel extends \core\Model
{
    protected $table = 'article';

    public function getAllWithJoin($where = '2 > 1', $sort = '`id` ASC', $start = 0, $pageSize = 10)
    {
        /*
        SELECT `article`.*, `user`.`username`, `category`.`name` AS category_name, count(`comment`.`id`) AS comment_count
            FROM `article`
            LEFT JOIN `user` ON `article`.`author_id` = `user`.`id`
            LEFT JOIN `category` ON `article`.`category_id` = `category`.`id`
            LEFT JOIN `comment` ON `comment`.`article_id`=`article`.`id`
            GROUP BY `article`.`id`
         */
        $sql = "SELECT `article`.*, `category`.`name` AS category_name, user.username, count(`comment`.`id`) AS comment_count
                  FROM `article`
                  LEFT JOIN `category` ON `article`.`category_id`=`category`.`id`
                  LEFT JOIN user ON `article`.`author_id`=`user`.`id`
                  LEFT JOIN `comment` ON `comment`.`article_id`=`article`.`id`
                  WHERE {$where}
                  GROUP BY `article`.`id`
                  ORDER BY {$sort}";
        if ($pageSize !== false) {
            $sql .= " LIMIT {$start}, {$pageSize}";
        }
        return $this->getAll($sql);
    }

    public function getOneWithJoin($id)
    {
        $sql = "SELECT
                  `article`.*,
                  `user`.`username`,
                  `category`.`name` AS category_name,
                  COUNT(`comment`.`id`) AS comment_count
                FROM
                  `article`
                LEFT JOIN
                  `user` ON `article`.`author_id` = `user`.`id`
                LEFT JOIN
                  `category` ON `article`.`category_id` = `category`.`id`
                LEFT JOIN
                  `comment` ON `comment`.`article_id` = `article`.`id`
                WHERE `article`.`id`={$id}
                GROUP BY
                  `article`.`id`;";
        return $this->getOne($sql);
    }

    public function increaseReadNumber($id)
    {
        $sql = "UPDATE `article` SET `read`=`read`+1 WHERE id={$id}";
        return $this->exec($sql);
    }

    public function increasePraiseNumber($id)
    {
        $sql = "UPDATE `article` SET `praise`=`praise`+1 WHERE id={$id}";
        return $this->exec($sql);
    }
}













