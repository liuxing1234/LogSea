<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/3
 * Time: 17:53
 */

namespace LogSea\config;

use LogSea\Demo;
use LogSea\events\ship\CloseShip;
use LogSea\events\ship\MessageShip;
use LogSea\events\ship\OpenShip;
use LogSea\events\ship\WorkstartShip;


class OptionShip extends Option
{
    public static $host = "0.0.0.0";
    public static $port = 4000;
    public static $option=[
        "worker_num"=>1,
        "daemonize" => 0
    ];

    public static $events = [
        "open"=>OpenShip::class,
        "message"=>MessageShip::class,
        "WorkerStart"=>WorkstartShip::class,
        "close"=>CloseShip::class
    ];

    public static $logExtStatic = [  //用于扩展日志模块,使用


    ];
    public static $logExt = [  //用于扩展日志模块,配置静态方法

    ];

}