<?php
/**
 * Created by PhpStorm.
 * User: WUZE
 * Date: 2018/11/5
 * Time: 10:57
 */

namespace app\home\controller;

class IndexController extends PublicController
{
    public function index()
    {
        session('user', 'wuze');
        if (!$this->isLogin()) {
            $this->redirect(url('/account/login'));
        } else {
            $this->getMenu();
            $this->show();
        }
    }

    public function tableData()
    {
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');
        $menu = model('menu');
        $data = $menu->getTableData($page, $limit);
        $this->resTableJson($data);
    }

    public function test()
    {
        $this->getMenu();
        $this->show();
    }
}
