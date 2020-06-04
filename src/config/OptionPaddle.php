<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/3
 * Time: 17:53
 */

namespace LogSea\config;


use LogSea\events\paddle\ClosePaddle;
use LogSea\events\paddle\ConnectPaddle;
use LogSea\events\paddle\ReceivePaddle;

class OptionPaddle extends Option
{
    public static $host = "127.0.0.1";
    public static $port = 4002;
    public static $option=[
        "worker_num"=>4,
        "daemonize" => 0
    ];
    public static $events = [
        "connect"=>ConnectPaddle::class,
        "receive"=>ReceivePaddle::class,
        "close"  =>ClosePaddle::class
    ];
}