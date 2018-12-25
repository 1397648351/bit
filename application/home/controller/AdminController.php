<?php
/**
 * Created by PhpStorm.
 * User: RENTAO
 * Date: 2018/11/9
 * Time: 14:27
 */

namespace app\home\controller;


class AdminController extends PublicController
{
    public function user()
    {
        $this->getMenu();
        $user = model('user');
        $data = $user->getrolelist();
        $this->assign('roleList', $data);
        //dump($data);exit();
//        $user = model('user');
//        $data = $user->getuser();
//        dump($data);
//        exit(0);
        $this->show();
    }

    public function getuser()
    {
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');
        $user = model('user');
        $data = $user->getuser($page, $limit);
        //dump($data);
        //exit(0);
        $this->resTableJson($data);
    }

    public function getrolelist()
    {
        $user = model('user');
        $data = $user->getrolelist();
        //dump($data);
        //exit(0);
        $this->resTableJson($data);
    }

    public function saveChange()
    {
        $data = array();
        $type = $this->request->param('type');
        if ($type != 'del') {
            $data = $this->request->param('values');
//            $data['name'] = $this->request->param('name');
//            $data['realname'] = $this->request->param('realname');
//            $data['sex'] = $this->request->param('sex');
//            $data['phone'] = $this->request->param('phone');
//            $data['pwd'] = $this->request->param('pwd');
//            $data['pwd_hash'] = 'md5';
//            $data['role_id'] = $this->request->param('role_id');
        }else{
            $data['ID'] = $this->request->param('id');
        }
        if ($type == 'add') {
            $data['ID'] = $this->guid();
            $data['PWD_HASH'] = 'md5';
        }
        $user = model('user');
        $user->saveChange($data, $type);
        //dump($data);
        //exit(0);
        $this->resJson(true, 200);
    }

    public function formuser(){
        $user = model('user');
        $type = $this->request->param('type');
        $info = array();
        if($type == "add"){
            $info['id'] = '自动生成';
        }else{
            $id = $this->request->param('id');
            $info['id'] = "aaaaaaaaaaaaaaaaa";
        }
        $rolelist = $user->getrolelist();
        $this->assign('roleList',$rolelist);
        $this->assign('userinfo',$info);
        $this->view->config('tpl_cache', false);
        $this->view->engine->layout(false);
        return $this->fetch();
    }
}