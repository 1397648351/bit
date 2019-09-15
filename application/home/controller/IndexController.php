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
        if (!$this->isLogin()) {
            $this->redirect(url('/user/login'));
        } else {
            $this->getMenu();
            $this->show();
        }
    }

    public function test()
    {
        $this->getMenu();
        $this->show();
    }
}
