<?php
/**
 * ArticleController.php
 * Created by day11.
 * User: 苏小林
 * Date: 2016/6/1
 * Time: 14:55
 */

namespace app\controller\backend;


use app\model\ArticleModel;
use app\model\CategoryModel;
use vendor\Pager;

class ArticleController extends \core\Controller
{
    public function add()
    {
        $this->denyAccess();
        if ($_POST) {
            $data = array(
                'title' => $_POST['Title'],
                'content' => $_POST['Content'],
                'category_id' => $_POST['CateID'],
                'status' => $_POST['Status'],
                'published_date' => strtotime($_POST['PostTime']),
                'top' => isset($_POST['isTop']) ? $_POST['isTop'] : 2,
                'author_id' => $_SESSION['user']['id'],
            );
            if (ArticleModel::create()->add($data)) {
                $this->redirect(array('a' => 'getList'), '添加成功');
            } else {
                $this->redirect(array(), '添加失败');
            }
        } else {
            $categorys = CategoryModel::create()
                            ->limitlessLevelCategory(
                                CategoryModel::create()->findAll()
                            );
            $this->loadHtml('article/add', array(
                'categorys' => $categorys,
            ));
        }
    }

    public function getList()
    {
        $this->denyAccess();
        $where = '2 > 1';
        $category = isset($_REQUEST['category']) ? $_REQUEST['category'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
        $istop = isset($_REQUEST['istop']) ? $_REQUEST['istop'] : '';
        $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';
        if ($category) {
            $where .= " AND category_id = '{$category}'";
        }
        if ($status) {
            $where .= " AND status = '{$status}'";
        }
        if ($istop) {
            $where .= " AND top = '{$istop}'";
        }
        if ($search) {
            $where .= " AND title LIKE '%{$search}%'";
        }
        /*
        $pager = new Pager(总的记录数, 每页记录数, 当前页数, 'php入口脚本index.php', array(参数
            'a' => 'index',
            'c' => 'product',
        ));

        $pagerHtml = $pager->showPage();
        */
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $pageSize = 1;
        $pager = new Pager(ArticleModel::create()->count($where), $pageSize, $page, 'index.php', array(
            'p' => 'backend',
            'c' => 'Article',
            'a' => 'getList',
            'category_id' => $category,
            "status" => $status,
            'top' => $istop,
            'search' => $search,
        ));
        // 获取分页按钮
        $pageButtons = $pager->showPage();

        $start = ($page - 1) * $pageSize;
        $articles = ArticleModel::create()->getAllWithJoin($where, 'id ASC', $start, $pageSize);
        $categories = CategoryModel::create()
                        ->limitlessLevelCategory(
                            CategoryModel::create()->findAll()
                        );
        $this->loadHtml('article/getList', array(
            'articles' => $articles,
            'categories' => $categories,
            'pageButtons' => $pageButtons,
            'search' => $search,
        ));
    }
}