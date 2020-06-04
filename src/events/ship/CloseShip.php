<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/1
 * Time: 15:16
 */

namespace LogSea\events\ship;


use LogSea\Cache;

class CloseShip extends BaseShip
{
    public function listen($server,$fd){
        $fds = Cache::get("fds",[]);
        if($fds && in_array($fd,$fds)){
            unset($fds[$fd]);
            Cache::set("fds",$fds);
        }
    }

}