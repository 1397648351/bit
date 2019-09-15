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
            if ($v['pid'] == $id) {
                if ($v['leaf'] == 1) {
                    if ($v['pid'] == -1) {
                        if (!empty($curitem) && $curitem == strtolower($v['url'])) {
                            $str .= '<li class="layui-nav-item layui-this"><a data-pjax href="' . $v['url'] . '">' . $v['name'] . '</a></li>';
                        } else
                            $str .= '<li class="layui-nav-item"><a data-pjax href="' . $v['url'] . '">' . $v['name'] . '</a></li>';
                    } else {
                        if (!empty($curitem) && $curitem == strtolower($v['url'])) {
                            $str .= '<li class="layui-this"><a data-pjax href="' . $v['url'] . '">' . $v['name'] . '</a></li>';
                        } else
                            $str .= '<li><a data-pjax href="' . $v['url'] . '">' . $v['name'] . '</a></li>';
                    }
                } else {
                    $children = $this->recursion($data, $curitem, $v['id']);
                    $str .= '<li class="layui-nav-item"><a href="javascript:;">' . $v['name'] . '</a><ul class="layui-nav-child">' . $children . '</ul></li>';
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
        $this->view->engine->layout(true);
        if ($this->request->isPjax()) {
            // 临时关闭当前模板的布局功能
            $this->view->config('tpl_cache', false);
            $this->view->engine->layout(false);
        }
        exit($this->fetch($template)->getContent());
    }
}