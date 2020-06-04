<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/1
 * Time: 15:16
 */

namespace LogSea\events\ship;


class WorkstartShip extends BaseShip
{
    public function listen($server, $worker_id){
        if($worker_id==0){
//            $this->fdCheck($server);
        }

    }
    // 检车定时器,每个一段时间检测table里面的fd是否有效,没有的就进行清除操作
    private function fdCheck($server)
    {
        //获取table里面的一条fd,并看他是不是在活跃列表里,不在的话就删除
        //
    }


}