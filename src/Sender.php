<?php

namespace LogSea;


use LogSea\config\OptionPaddle;

class Sender
{
    public function __construct($data = null)
    {
        if($data){
           $this->send($data);
        }
    }

    public function send($data){
        if($data){
            $client = new \Swoole\Client(SWOOLE_SOCK_TCP);
            if (!$client->connect(OptionPaddle::$host, OptionPaddle::$port, -1)) {
                exit("connect failed. Error: {$client->errCode}\n");
            }
            $client->send($data);
        }
    }



}