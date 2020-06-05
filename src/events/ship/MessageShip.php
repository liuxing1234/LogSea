<?php

namespace LogSea\events\ship;


use LogSea\Cache;
use LogSea\config\OptionShip;

class MessageShip extends BaseShip
{
    public function listen($server,$frame){
        self::tranferStation($frame,$server);
    }

    /**
     *批量发送数据信息
     */
    public static function batchSend($frame,$server){
        //获取所有的在线用户进行遍历
        $fds = Cache::get("fds",[]);
        if($fds){
            $msg = $frame->data;
            foreach($fds as $fd){
                $server->push($fd,$msg);
            }
        }
        //判断这个每一个是否是在权限列表
    }

    /**
     * 检测新连接的用户是否在
     */
    public static function tranferStation($frame,$server){
        $data = $frame->data;
        $dataArr = json_decode($data,true);
        if($dataArr){
           if(isset($dataArr["code"]) && isset($dataArr["data"]) && isset($dataArr["tag"])){
               //判断用户的身份
               //判断是否是后端传递的日志信息
               if($dataArr["code"]==OptionShip::$logCode){
                   self::checkCache($frame);
                    //日志写入磁盘
                   self::write($data);
                    //日志分发
                   self::batchSend($frame,$server);
                        //产看在线的fd列表
               }else if (in_array($dataArr["code"],OptionShip::$clientCode)){
                    self::checkCache($frame);
               }else{

               }
           }else{
               var_dump("参数不全");
           }
        }
        return false;

    }

    public static function checkCache($frame){
        $fdsArr = Cache::get("fds",[]);
        $fdsArr[$frame->fd] = $frame->fd;
        Cache::set("fds",$fdsArr);
    }

}