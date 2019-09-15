<?php
/**
 * Created by PhpStorm.
 * User: RENTAO
 * Date: 2018/11/9
 * Time: 15:27
 */

namespace app\home\model;


use think\Db;

class User extends Base
{
    public function checkuser($user, $psw)
    {
        $res = array();
        $where = array();
        $where['NAME'] = $user;
        $user_exist = $this->where($where)->count() > 0;
        if (!$user_exist) {
            $res['success'] = false;
            $res['msg'] = '用户名不存在';
            return $res;
        }
        $db_psw = $this->where($where)->column('PASSWORD');
        if (password_verify($psw, $db_psw[0])) {
            $res['success'] = true;
            $res['msg'] = '';
        } else {
            $res['success'] = false;
            $res['msg'] = '密码错误';
        }
        return $res;
    }

    public function getuser($page, $limit)
    {
        $res['data'] = $this->alias('a')->field('a.id,a.name,a.realname,a.sex,a.phone,b.name as role_name,a.role_id,a.pwd')->join('bs_role b', 'a.role_id = b.id')->limit(($page - 1) * $limit, $limit)->select();
        $res['count'] = $this->alias('a')->join('bs_role b', 'a.role_id = b.id')->count();
        return $res;
    }

    public function getrolelist()
    {
        $res = Db::table('bs_role')->field('id,name')->select();
        return $res;
    }

    public function saveChange($data, $type)
    {
        if ($type == 'add') {
            $this->insert($data);
        } elseif ($type == 'update') {
            $this->where('ID', $data['ID'])->update($data);
        } else {
            $this->where('ID', $data['ID'])->delete();
        }
        //$res = Db::table('bs_role')->field('id,name')->select();
        return true;
    }
}