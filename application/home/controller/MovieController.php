<?php
/**
 * MovieController.php
 * Time   : 2019/1/7 9:45
 * Author : WuZe
 * Desc   :
 */

namespace app\home\controller;


class MovieController extends PublicController
{
    public function index()
    {
        if (!$this->isLogin()) {
            $this->redirect(url('user/login'));
        } else {
            $this->getMenu();
            $this->show();
        }
    }

    public function tableData()
    {
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');
        $field = $this->request->param('field');
        $order = $this->request->param('order');
        $movieModel = model('movie');
        $data = $movieModel->getTableData($page, $limit, $field, $order);
        $this->resTableJson($data);
    }
}