<?php
/**
 * Created by PhpStorm.
 * User: WUZE
 * Date: 2018/11/6
 * Time: 15:06
 */

namespace app\home\model;

class Menu extends Base
{
    public function getMenu()
    {
        return $this->order(['pid', 'id'])->select();
    }

    public function getTableData($page, $limit)
    {
        $res['data'] = $this->limit(($page - 1) * $limit, $limit)->select();
        $res['count'] = $this->count();
        return $res;
    }
}