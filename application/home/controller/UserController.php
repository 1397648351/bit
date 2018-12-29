<?php
/**
 * Created by PhpStorm.
 * User: WUZE
 * Date: 2018/11/5
 * Time: 10:57
 */

namespace app\home\controller;

use think\captcha\Captcha;


class UserController extends PublicController
{
    public function verify()
    {
        if ($this->request->isGet()) {
            $config = [
                // 验证码字体大小
                'fontSize' => 17,
                // 验证码位数
                'length' => 4,
                // 是否添加杂点
                'useNoise' => false,
                // 是否画混淆曲线
                'useCurve' => true,
                'imageH' => 36,
                'imageW' => 97,
                //'bg' => [255, 255, 255],
                'fontttf' => 'arial.ttf'
            ];
            $captcha = new Captcha($config);
            return $captcha->entry();
        } else {
            $code = $this->request->param('code');
            $captcha = new Captcha();
            return $captcha->check($code);
        }
    }

    public function login()
    {
        if ($this->request->isGet()) {
            session(null);
            $user = [
                'username' => '',
                'password' => '',
                'remember' => false
            ];
            if (cookie('?user')) {
                $user = cookie('user');
            }
            $this->assign('user', $user);
            $this->view->engine->layout(false);
            return $this->fetch();
        } else {
            $data = array();
            $data['username'] = $this->request->param('name');
            $data['password'] = $this->request->param('password');
            $data['remember'] = $this->request->param('remember');
            $user = model('user');
            $user_exist = $user->checkuser($data['username'], $data['password']);
            if ($user_exist['success']) {
                //记住我，保存cookie
                if ($data['remember'] && $data['remember'] == "on") {
                    $data['remember'] = true;
                    cookie('user', $data);
                } else {
                    cookie('user', null);
                }
                session('user', $data['username']);
            }
            session('user', $data['username']);
            $this->resJson($user_exist['success'], 200, $user_exist['msg']);
            //$this->redirect(url('/index/index'));
        }
    }

    public function logout()
    {
        session(null);
        $this->redirect(url('/user/login'));
    }

    public function index(){
        $this->getMenu();
        $this->show();
    }
}