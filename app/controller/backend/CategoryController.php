<?php
/**
 * CategoryController.php
 * Created by day11.
 * User: 苏小林
 * Date: 2016/5/31
 * Time: 15:07
 */

namespace app\controller\backend;


use app\model\CategoryModel;
use core\Controller;

class CategoryController extends Controller
{
    public function add()
    {
        $this->denyAccess();
        //if (用户提交了表单) {
        if ($_POST) {
            // var_dump($_POST);die;
            // 将分类数据插入数据库
            $data = array(
                'name' => $_POST['Name'],
                'nickname' => $_POST['Alias'],
                'sort' => $_POST['Order'],
                'parent_id' => $_POST['ParentID'],
            );
            if (CategoryModel::create()->add($data)) {
                // 创建成功， 跳转到分类的列表页getList?
                $this->redirect('index.php?p=backend&a=getList&c=Category', '创建成功');
            } else {
                // 创建失败，跳转到分类的添加页add?
                $this->redirect('index.php?p=backend&a=add&c=Category', '创建失败');
            }
        } else {
            // 显示添加表单
            $categorys = CategoryModel::create()->limitlessLevelCategory(CategoryModel::create()->findAll());
            //var_dump($categorys);die;
            $this->loadHtml('category/add', array(
                'categorys' => $categorys,
            ));
        }
    }

    public function getList()
    {
        $this->denyAccess();
        // 查询出所有的分类
        $categorys = CategoryModel::create()
                        ->limitlessLevelCategory(
                            CategoryModel::create()->getAllWithJoin()
                        );
        // 在html里显示
        $this->loadHtml('category/getList', array(
            'categorys' => $categorys,
        ));
    }

    public function update()
    {
        $this->denyAccess();
        $id = $_GET['id'];
        if ($_POST) {
//            if (修改成功) {
//                // 提示修改成功
//                // 2. 跳转到列表页
//            } else {
//                修改失败
//                跳转到修改页
//            }
            $data = array(
                'sort' => $_POST['Order'],
                'name' => $_POST['Name'],
                'nickname' => $_POST['Alias'],
                'parent_id' => $_POST['ParentID'],
            );
            if (CategoryModel::create()->updateById($id, $data)) {
                $this->redirect('index.php?p=backend&c=Category&a=getList', '修改成功');
            } else {
                $this->redirect('index.php?p=backend&c=Category&a=update&id=' . $id, '修改失败');
            }
        } else {
            // 查询出所有的分类
            $categorys = CategoryModel::create()
                ->limitlessLevelCategory(
                    CategoryModel::create()->findAll('2 > 1', 'sort DESC')
                );
            $category = CategoryModel::create()->findOneById($id);

            $this->loadHtml('category/update', array(
                'category' => $category,
                'categorys' => $categorys,
            ));
        }
    }

    public function delete()
    {
        $this->denyAccess();
        $id = $_GET['id'];

        //if (category.id为$id的分类子分类的数量大于0) {
        //    1.禁止删除
        //    2.跳转到分类的列表页
        //}
        if (CategoryModel::create()->count("parent_id='{$id}'") > 0) {
            return $this->redirect('index.php?p=backend&c=Category&a=getList', '禁止删除');
        }


        if (CategoryModel::create()->deleteById($id)) {
            $this->redirect('index.php?p=backend&c=Category&a=getList', '删除成功。');
        } else {
            $this->redirect('index.php?p=backend&c=Category&a=getList', '删除失败。');
        }
    }
}