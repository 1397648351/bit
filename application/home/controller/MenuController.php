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
        $field = $this->request->param('field');
        $order = $this->request->param('order');
        $movieModel = model('menu');
        $data = $movieModel->getTableData($page, $limit, $field, $order);
        $this->resTableJson($data);
    }
}