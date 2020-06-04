<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/1
 * Time: 14:46
 */

namespace LogSea;

require "./Autoload.php";
$ship = new Server();
$ship->start();