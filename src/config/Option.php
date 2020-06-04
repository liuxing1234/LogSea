<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/1
 * Time: 13:52
 */

namespace LogSea\config;


class Option
{
    public static $logCode = "ojbk"; //用于判断后端写日志时身份验证的秘钥
    public static $clientCode = [
        "123456",
        "bbbb"
    ];

    public static $cacheOpt = [
        'type'          =>"File",
        'expire'        => 0,
        'cache_subdir'  => true,
        'prefix'        => '',
        'path'          => __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."runtime".DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR,
        'data_compress' => false
    ];
//    public static $cacheOpt = [
//        'type'          =>"Redis",
//        'host'       => '127.0.0.1',
//        'port'       => 6379,
//        'password'   => '',
//        'select'     => 0,
//        'timeout'    => 0,
//        'expire'     => 0,
//        'persistent' => false,
//        'prefix'     => '',
//    ];

    public static $logOpt =[
        'time_format' => ' c ',
        'single' => false,
        'file_size' => 2097152,
        'path' => __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."runtime".DIRECTORY_SEPARATOR."log".DIRECTORY_SEPARATOR,
        'apart_level' => [],
        'max_files' => 0,
        'json' => false
    ];





}