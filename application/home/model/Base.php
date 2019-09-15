<?php
/**
 * Created by PhpStorm.
 * User: WUZE
 * Date: 2018/11/6
 * Time: 16:39
 */

namespace app\home\model;
use think\Model;


class Base extends Model
{
    public function getTableData($page, $limit, $filed = null, $order = 'ASC')
    {
        $res['data'] = $this->order($filed, $order)->limit(($page - 1) * $limit, $limit)->select();
        $res['count'] = $this->count();
        return $res;
    }
}