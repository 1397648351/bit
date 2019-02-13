<?php
/**
 * LoverController.php
 * Time   : 2019/2/13 16:08
 * Author : WuZe
 * Desc   :
 */

namespace app\home\controller;


use think\App;

class LoverController extends PublicController
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->view->engine->layout(false);
    }

    public function index()
    {
        return $this->fetch();
    }

    public function heart()
    {
        return $this->fetch();
    }
}