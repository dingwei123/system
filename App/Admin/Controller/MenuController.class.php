<?php
namespace Admin\Controller;

use Admin\Model\MenuModel;
use Think\Controller;

class MenuController extends CommonController
{
    public function index()
    {
        $rows = MenuModel::menus();
        $tree = tree($rows);
        $item = sort_tree($tree);
        $this->assign('rows',$item);
        $this->display();
    }

    public function create()
    {
        $this->display();
    }

    public function store()
    {
        $data = [
            'name' => I('name'),
            'mca'  => I('mca'),
            'sort' => I('sort'),
        ];
        if(MenuModel::store($data))
        {
            $this->dwz_success('添加顶级菜单成功','','menu_index');
        }else{
            $this->dwz_error('添加顶级菜单失败');
        }
    }

    public function create_sub($pid)
    {
        $row = MenuModel::get_menu_by_id($pid);
        $this->assign('row',$row);
        $this->display();
    }

    public function store_sub()
    {
        $data = [
            'pid'  => I('pid'),
            'name' => I('name'),
            'mca'  => I('mca'),
            'sort' => I('sort'),
        ];
        if(MenuModel::store($data))
        {
            $this->dwz_success('添加子级菜单成功','','menu_index');
        }else{
            $this->dwz_error('添加子级菜单失败');
        }
    }

    public function destory($mid)
    {
        if(MenuModel::destory($mid))
        {
            $this->dwz_success('删除菜单成功','1','menu_index');
        }else{
            $this->dwz_error('删除菜单失败');
        }
    }

    public function edit($mid)
    {
        $row = MenuModel::get_menu_by_id($mid);
        $this->assign('row',$row);
        $this->display();
    }

    public function update()
    {
        $data = [
            'id'    => I('id'),
            'name'  => I('name'),
            'mca'   => I('mca'),
            'sort'  => I('sort'),
        ];
        if(MenuModel::update($data) !== false)
        {
            $this->dwz_success('修改菜单成功','','menu_index');
        }else{
            $this->dwz_error('修改菜单失败');
        }
    }
}