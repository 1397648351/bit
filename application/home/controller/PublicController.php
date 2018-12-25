<?php
/**
 * Created by PhpStorm.
 * User: WUZE
 * Date: 2018/11/6
 * Time: 16:06
 */

namespace app\home\controller;

use app\common\controller\BaseController;

class PublicController extends BaseController
{
    function recursion($data, $curitem = "", $id = -1)
    {
        $str = '';
        foreach ($data as $v) {
            if ($v['PID'] == $id) {
                if ($v['LEAF'] == 0) {
                    if ($v['PID'] == -1) {
                        if (!empty($curitem) && $curitem == strtolower($v['URL'])){
                            $str .= '<li class="layui-nav-item layui-this"><a data-pjax href="' . $v['URL'] . '">' . $v['NAME'] . '</a></li>';
                        }
                        else
                            $str .= '<li class="layui-nav-item"><a data-pjax href="' . $v['URL'] . '">' . $v['NAME'] . '</a></li>';
                    } else {
                        if (!empty($curitem) && $curitem == strtolower($v['URL'])){
                            $str .= '<li class="layui-this"><a data-pjax href="' . $v['URL'] . '">' . $v['NAME'] . '</a></li>';
                        }
                        else
                            $str .= '<li><a data-pjax href="' . $v['URL'] . '">' . $v['NAME'] . '</a></li>';
                    }
                } else {
                    $children = $this->recursion($data, $curitem, $v['ID']);
                    $str .= '<li class="layui-nav-item"><a href="javascript:;">' . $v['NAME'] . '</a><ul class="layui-nav-child">' . $children . '</ul></li>';
                }
            }
        }
        return $str;
    }

    public function getMenu()
    {
        $curitem = "";
        $curitem = strtolower($this->request->baseUrl());
        $menu = model('menu');
        $data = $menu->getMenu();
        $str = $this->recursion($data, $curitem);
        $this->assign('menu', $str);
    }

    public function resTableJson($data = array())
    {
        header('Content-Type:application/json; charset=utf-8');
        $res['data'] = $data['data'];
        $res['msg'] = '';
        $res['code'] = 0;
        $res['count'] = $data['count'];
        $str = json_encode($res, JSON_UNESCAPED_UNICODE);
        exit($str);
    }

    public function isLogin()
    {
        return session('?user');
    }

    public function show($template = '')
    {
        if ($this->request->isPjax()) {
            // 临时关闭当前模板的布局功能
            $this->view->config('tpl_cache', false);
            $this->view->engine->layout(false);
        }
        exit($this->fetch($template));
    }
}