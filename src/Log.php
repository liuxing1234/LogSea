<?php


namespace LogSea;


use LogSea\config\OptionShip;
use LogSea\log\driver\File;

class Log
{
    protected static $log = [];
    protected static $driver;
    public static function init()
    {
        self::$driver = new File(OptionShip::$logOpt);
    }

    public static function write($msg)
    {
        // 封装日志信息
        $log = $msg;
        is_null(self::$driver) && self::init();

        // 写入日志
        if ($result = self::$driver->save($log)) {
            self::$log = [];
        }

        return $result;
    }

}