<?php
/**
 * Movie.php
 * Time   : 2019/1/7 9:58
 * Author : WuZe
 * Desc   :
 */

namespace app\home\model;


class Movie extends Base
{
    public function getTableData($page, $limit, $filed, $order)
    {
        if (empty($filed)) $filed = 'score';
        if (empty($order)) $order = 'DESC';
        $res['data'] = $this->order($filed, $order)->limit(($page - 1) * $limit, $limit)->select();
        $res['count'] = $this->count();
        return $res;
    }
}