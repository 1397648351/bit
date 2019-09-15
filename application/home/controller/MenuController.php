<?php
/**
 * MenuController.php
 * Desc:
 * Create on 2019/9/16 0:42
 * Create by WuZe
 */

namespace app\home\controller;


class MenuController extends PublicController
{
    public function index()
    {
        $this->getMenu();
        $this->show();
    }

    public function tableData()
    {
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');
        $menu = model('menu');
        $data = $menu->getTableData($page, $limit);
        $this->resTableJson($data);
    }

}